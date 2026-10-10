# Deployment Plan — DigitalOcean Droplet (private test first, then public)

Written 2026-10-10. A step-by-step, copy-paste guide for putting this app on a DigitalOcean
Droplet for the first time. It assumes no prior DigitalOcean or Linux-server experience. It
replaces `digitalocean_laravel_mysql_deployment.pdf` in the repo root, which is outdated for this
app (it uses Ubuntu 22.04 → PHP 8.1, but this app is Laravel 12 and **needs PHP 8.2+**).

**Keep `docs/DEPLOYMENT_NOTES.md` open beside this file.** Every time you create a password, get
an IP address, hit an error, or finish a phase, write it there. That file is gitignored so it
never reaches the public GitHub repo.

---

## The big picture (read once)

```
 Your Windows PC                                   DigitalOcean Droplet (Ubuntu 24.04 Linux server)
 ───────────────                                   ────────────────────────────────────────────────
 code (master) ── release script ──▶ production branch ── git push ──▶ GitHub ── git clone ──▶ /var/www/yoga-app
 local MySQL ── mysqldump file ── scp upload ────▶ MySQL 8            (database: yoga_production)
 browser ──────────── http://DROPLET_IP ─────────▶ Nginx ─▶ PHP 8.3-FPM ─▶ Laravel
                                                   ▲
                       DigitalOcean Cloud Firewall: only YOUR home IP may connect (private test)
```

Words you'll see:

| Term | Meaning |
|---|---|
| **Droplet** | DigitalOcean's name for a virtual server (a Linux computer in their data center). |
| **SSH** | How you log into the server's terminal from your PC: `ssh user@IP`. |
| **SSH key** | A key pair replacing passwords for SSH. Private half stays on your PC (`id_ed25519`), public half (`id_ed25519.pub`) goes to DigitalOcean. |
| **Nginx** | The web server: receives browser requests, hands PHP ones to PHP-FPM. |
| **PHP-FPM** | The process that actually runs Laravel's PHP code. |
| **`.env`** | Per-machine settings file (DB password, debug on/off, URL). Different on your PC vs the server, never committed. |
| **Cloud Firewall** | A DigitalOcean setting deciding which IP addresses may reach the Droplet at all. |
| **`sudo`** | "Run this command as administrator" on Linux. |

### Branches: `master` vs `production`

| Branch | What's on it | Who changes it |
|---|---|---|
| `master` | Everything: app code **plus** docs, tests, linters, AI-assistant config, notes, unused images. | You (and Claude) — all development happens here. |
| `production` | Only what the server needs: `master` minus every path listed in `.production-exclude` (docs, tests, tooling, 13 unused images…). ~half the files. | **Only** `scripts/release-production.sh`. Never commit to it by hand. |

The server only ever clones/pulls `production`. To release:

```powershell
# on your PC, in Git Bash or PowerShell, on master with everything committed
bash scripts/release-production.sh   # merges master into production, strips excluded paths
git push origin master production
```

The script refuses to run with uncommitted changes, and refuses if code starts using an image
that `.production-exclude` strips — so a release can't silently break a page. To ship a file
that's currently excluded, delete its line from `.production-exclude` (on master) and release.

### Images

All images the site uses were compressed on 2026-10-10 (phone photos 3024×4032 / ~1.2 MB →
max 1600 px / ~300 KB; total ~45 MB → ~12 MB). **Every new photo must go through the same step
before it's committed:**

```powershell
python scripts/compress-images.py public/images/yogasana_pictures/new_pose_front_side.jpeg
```

(Requires Python + Pillow: `pip install pillow`.) It resizes to ≤ 1600 px, applies the phone's
rotation, re-saves as JPEG quality 82. Save photos as `.jpg`/`.jpeg`, not `.png`, unless they need a
transparent background (logos).

### Why the database is copied, not rebuilt

The first ~40 asanas in your local database were created through the Postman write routes, not
by a migration — but later migrations insert steps/images that point at those rows by id. So
`php artisan migrate` on an empty server database would **not** reproduce your content. Instead,
we export your local `yoga_project` database to a file and import it on the server (step 6).
Future schema changes still go through normal migrations.

### How the environment files work

| File | Where it lives | Committed? | Purpose |
|---|---|---|---|
| `.env.example` | repo | yes | Laravel's default template (local dev). |
| `.env.production.example` | repo | yes | **Production template** — safe values, `CHANGE_ME` placeholders, no secrets. |
| `.env` (on your PC) | your PC | **no** (gitignored) | Your local dev settings: `APP_ENV=local`, `APP_DEBUG=true`, DB `yoga_project`. Leave as-is. |
| `.env` (on the server) | `/var/www/yoga-app/.env` | **no** (gitignored) | Created on the server from `.env.production.example`, real passwords filled in there. |

Laravel always reads the file called `.env` on the machine it runs on — so "separate
environments" just means each machine has its own `.env`. Never copy your local `.env` to the
server, and never put real passwords into the `.example` files.

### Time and cost

- First time through: about **2–3 hours** (most of it reading, not waiting).
- Cost: Droplet Basic 1 GB = **$6/month**, billed hourly. Optional automatic Backups +$1.20/month.
  A powered-off Droplet still bills — **Destroy** it to stop billing.

---

## Phase 0 — Prepare on your PC (≈20 min)

All commands in this phase run in **PowerShell** on your Windows PC (Start menu → "Terminal" or
"PowerShell"), unless the block says otherwise.

### 0.1 Release and push the latest code to GitHub

The server downloads the `production` branch from GitHub, so it must contain your latest commits.
Use **Git Bash** for the release script (Start menu → "Git Bash"):

```bash
cd /c/Projects/yoga01/yoga-app
git status                            # should say "nothing to commit"
bash scripts/release-production.sh    # updates the production branch from master
git push origin master production
```

> The GitHub repo `SannatKumar/yoga-website` is **public**. Anything you commit is visible to
> everyone — this is why passwords only ever go in `.env` on the server and in
> `DEPLOYMENT_NOTES.md` (gitignored).

### 0.2 Create an SSH key (one-time)

```powershell
ssh-keygen -t ed25519 -C "raj-windows-pc"
```

- "Enter file in which to save the key" → just press **Enter** (default `C:\Users\chitr\.ssh\id_ed25519`).
- "Enter passphrase" → type a passphrase (recommended; write it in the notes file) or press Enter for none.

Show the **public** key — you'll paste this into DigitalOcean in step 1.3:

```powershell
Get-Content $HOME\.ssh\id_ed25519.pub
```

It's one line starting `ssh-ed25519 AAAA...`. The file **without** `.pub` is your private key:
never share it, never paste it anywhere.

### 0.3 Find your home IP address

```powershell
curl.exe ifconfig.me
```

Write it in the notes ("My IP"). The firewall will only let this IP in. Home IPs can change (router
restart, ISP) — if the site or SSH suddenly stops answering, check this first (see Troubleshooting).

### 0.4 Export the local database

Two files: the whole database **except** the bulky/personal log tables, plus the **empty**
structure of those tables (the app needs them to exist — e.g. `TrackVisits` writes to `visits` on
every page view, and sessions/cache live in the DB).

Save dumps **outside the repo** so they can never be committed:

```powershell
mkdir C:\Projects\yoga01\db-dumps -Force
$dump = "C:\Program Files\MySQL\MySQL Server 8.0\bin\mysqldump.exe"
$skip = "visits","sessions","cache","cache_locks","jobs","job_batches","failed_jobs"

# 1) everything except the log/runtime tables (asks for your local MySQL root password)
& $dump -u root -p --single-transaction --no-tablespaces --set-gtid-purged=OFF `
  --default-character-set=utf8mb4 `
  ($skip | ForEach-Object { "--ignore-table=yoga_project.$_" }) `
  --result-file=C:\Projects\yoga01\db-dumps\yoga_data.sql yoga_project

# 2) just the empty structure of those tables
& $dump -u root -p --no-data --no-tablespaces --set-gtid-purged=OFF `
  --default-character-set=utf8mb4 `
  --result-file=C:\Projects\yoga01\db-dumps\yoga_empty_tables.sql yoga_project $skip
```

Use the MySQL **8.0** `mysqldump` above, not the XAMPP one (XAMPP's is MariaDB 10.4; your app's
database is MySQL 8.0.43). Use `--result-file` rather than `>`: in Windows PowerShell 5.1, `>`
writes UTF-16, which MySQL on Linux can't import.

Check both files exist and the first isn't tiny:

```powershell
Get-ChildItem C:\Projects\yoga01\db-dumps
```

> **Decide before uploading:** the `customers` table has 100 rows and `users` has 1. If those are
> fake/test rows, fine. If any are real people's details, add `"customers"` (and/or `"users"`) to
> `$skip` and re-run both commands. Write the decision in the notes.

---

## Phase 1 — Create the Droplet in DigitalOcean (≈15 min)

### 1.1 Open DigitalOcean and sign up / log in

1. Browser → **https://cloud.digitalocean.com** → Sign up (or Log in).
2. Add a payment method when asked (card or PayPal). New accounts often get trial credit.
3. Turn on **two-factor authentication**: top-right avatar → *My Account* → *Security*. This
   account controls your server; protect it.

### 1.2 Create a Project (optional, tidier)

Left sidebar → **+ New Project** → name `yoga-app` → purpose "Website or blog" → skip "move
resources". Everything below goes into this project.

### 1.3 Add your SSH key to DigitalOcean

Left sidebar → **Settings** → **Security** tab → **Add SSH Key** → paste the `ssh-ed25519 ...`
line from step 0.2 → name it `raj-windows-pc` → **Add SSH Key**.

### 1.4 Create the Droplet

Top-right green **Create** button → **Droplets**. Choose:

| Setting | Pick | Why |
|---|---|---|
| Region | **Amsterdam (AMS3)** or **Frankfurt (FRA1)** | Closest to Finland → fastest. |
| Image | **Ubuntu 24.04 (LTS) x64** | Ships PHP 8.3 (Laravel 12 needs ≥ 8.2). *Not* 22.04. |
| Size | **Basic** → **Regular** → **$6/mo (1 GB / 1 CPU / 25 GB SSD)** | Plenty for a test deploy. |
| Authentication | **SSH Key** → tick `raj-windows-pc` | No root password to leak. |
| Monitoring | ✅ "Add improved metrics monitoring and alerting" | Free CPU/RAM graphs. |
| Backups | Optional (+20%) | Weekly snapshots; you'll also take your own DB dumps. |
| Hostname | `yoga-app-prod` | |

Click **Create Droplet**. After ~1 minute it shows an **IPv4 address** (e.g. `164.92.xx.xx`).
Copy it into the notes as **Droplet IP**. Below, `DROPLET_IP` always means that address.

### 1.5 Lock the Droplet to your IP (Cloud Firewall) — do this now

Left sidebar → **Networking** → **Firewalls** tab → **Create Firewall**:

- Name: `yoga-private`
- **Inbound Rules** (delete any defaults, then add):

  | Type | Protocol | Port | Sources |
  |---|---|---|---|
  | SSH | TCP | 22 | *your IP from 0.3* |
  | HTTP | TCP | 80 | *your IP* |
  | HTTPS | TCP | 443 | *your IP* |

- **Outbound Rules**: leave the defaults (all allowed — the server needs to download packages).
- **Apply to Droplets**: type `yoga-app-prod` → select it → **Create Firewall**.

Now only your home connection can reach the server. This is what makes it safe to deploy before
the open write routes are fixed (see Phase 10).

---

## Phase 2 — First login and basic security (≈15 min)

### 2.1 Log in as root

```powershell
ssh root@DROPLET_IP
```

First time it asks *"Are you sure you want to continue connecting (yes/no)?"* → type `yes`.
Your prompt changes to `root@yoga-app-prod:~#` — you are now typing **on the server**.
(`exit` logs you out back to Windows.)

### 2.2 Update the system, set timezone, add swap

All of Phase 2 runs **on the server**:

```bash
apt update && apt -y upgrade          # if a purple screen asks about services/config: press Enter (keep defaults)
timedatectl set-timezone Europe/Helsinki

# 1 GB of swap so composer/npm don't run out of memory on a 1 GB Droplet
fallocate -l 1G /swapfile && chmod 600 /swapfile && mkswap /swapfile && swapon /swapfile
echo '/swapfile none swap sw 0 0' >> /etc/fstab
free -h                               # "Swap: 1.0Gi" = done
```

### 2.3 Create a normal user `deploy` (don't run the app as root)

```bash
adduser deploy                        # set a password (→ notes: "deploy user password"); press Enter through the name questions
usermod -aG sudo deploy               # allow it to use sudo
rsync --archive --chown=deploy:deploy ~/.ssh /home/deploy   # let your SSH key log in as deploy too
```

### 2.4 Server firewall (second layer, inside the server)

```bash
ufw allow OpenSSH
ufw allow 80,443/tcp                  # web traffic (http + https)
ufw --force enable
ufw status
```

### 2.5 Switch to the deploy user

Open a **new** PowerShell window (keep the root one open as a safety net) and test:

```powershell
ssh deploy@DROPLET_IP
```

If that works, close the root window. **From here on, always log in as `deploy`** and use `sudo`
when a command needs admin rights (it asks for the deploy password).

Optional hardening once `deploy` login works: `sudo nano /etc/ssh/sshd_config`, set
`PermitRootLogin no` and `PasswordAuthentication no`, save, then `sudo systemctl restart ssh`.

> **nano basics** (the text editor used below): arrow keys to move, type to edit,
> **Ctrl+O** then **Enter** = save, **Ctrl+X** = exit, **Ctrl+K** = cut a line,
> **Ctrl+Shift+V** (or right-click) = paste into the terminal.

---

## Phase 3 — Install the software (≈10 min)

On the server as `deploy`:

```bash
sudo apt install -y nginx mysql-server unzip git curl \
  php8.3-fpm php8.3-cli php8.3-mysql php8.3-xml php8.3-mbstring php8.3-curl \
  php8.3-zip php8.3-gd php8.3-bcmath php8.3-intl composer

# Node.js 22 (needed once per deploy to build CSS/JS with Vite; Ubuntu's own Node is too old for Tailwind v4)
curl -fsSL https://deb.nodesource.com/setup_22.x | sudo -E bash -
sudo apt install -y nodejs
```

Verify:

```bash
php -v          # PHP 8.3.x
composer -V     # Composer 2.x
node -v         # v22.x
mysql --version # 8.0.x
```

Visit `http://DROPLET_IP` in your browser → "Welcome to nginx!" means the web server and firewall
both work.

---

## Phase 4 — Database (≈10 min)

### 4.1 Secure MySQL

```bash
sudo mysql_secure_installation
```

Answers: VALIDATE PASSWORD component → `y`, level `1` (MEDIUM). "Remove anonymous users" → `y`.
"Disallow root login remotely" → `y`. "Remove test database" → `y`. "Reload privilege tables" →
`y`. (On Ubuntu, MySQL `root` logs in via `sudo mysql` with no password — that's expected.)

### 4.2 Create the app's database and user

Make up a strong password (16+ chars, letters+numbers+a symbol; **avoid `'` `"` `$` `#`** — they
cause quoting trouble in `.env`). Put it in the notes as **DB password**.

```bash
sudo mysql
```

At the `mysql>` prompt (replace the password):

```sql
CREATE DATABASE yoga_production CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'yoga_user'@'localhost' IDENTIFIED BY 'YOUR_STRONG_DB_PASSWORD';
GRANT ALL PRIVILEGES ON yoga_production.* TO 'yoga_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

---

## Phase 5 — Put the app on the server (≈15 min)

### 5.1 Download the code

```bash
sudo mkdir -p /var/www/yoga-app
sudo chown deploy:www-data /var/www/yoga-app
git clone --branch production --depth 1 https://github.com/SannatKumar/yoga-website.git /var/www/yoga-app
cd /var/www/yoga-app
git branch --show-current     # must say: production
git log --oneline -1          # should match `git log --oneline -1 production` on your PC
ls docs tests 2>/dev/null || echo "good: no dev files on the server"
```

`--depth 1` downloads only the latest snapshot, not the full history (which still contains the
large original photos).

### 5.2 Install PHP and JS dependencies, build CSS/JS

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build                 # creates public/build/ (the compiled Tailwind CSS + JS)
```

### 5.3 Create the server's `.env` from the production template

```bash
cp .env.production.example .env
nano .env
```

Change:
- `APP_URL=http://DROPLET_IP` (your real IP)
- `DB_PASSWORD=` the password from step 4.2

Save (Ctrl+O, Enter, Ctrl+X). Then:

```bash
php artisan key:generate      # fills APP_KEY
chmod 640 .env                # only deploy + www-data can read it
grep APP_KEY .env             # copy this value into the notes (needed to restore backups)
```

### 5.4 File permissions

Laravel must be able to write logs, cache and compiled views:

```bash
sudo chown -R deploy:www-data /var/www/yoga-app
sudo find /var/www/yoga-app -type d -exec chmod 755 {} \;
sudo find /var/www/yoga-app -type f -exec chmod 644 {} \;
sudo chmod -R ug+rwX storage bootstrap/cache
sudo chmod 640 .env
```

---

## Phase 6 — Import your database (≈10 min)

### 6.1 Upload the dumps (on your PC, PowerShell)

```powershell
scp C:\Projects\yoga01\db-dumps\yoga_data.sql C:\Projects\yoga01\db-dumps\yoga_empty_tables.sql deploy@DROPLET_IP:/tmp/
```

### 6.2 Import (on the server)

```bash
mysql -u yoga_user -p yoga_production < /tmp/yoga_data.sql
mysql -u yoga_user -p yoga_production < /tmp/yoga_empty_tables.sql
```

(Each asks for the DB password.) Check:

```bash
cd /var/www/yoga-app
php artisan migrate:status | tail -5                     # every row should say "Ran"
php artisan tinker --execute="echo DB::table('asanas')->count();"   # expect 76
php artisan migrate --force                              # should say "Nothing to migrate"
rm /tmp/yoga_data.sql /tmp/yoga_empty_tables.sql         # don't leave data dumps lying around
```

---

## Phase 7 — Configure Nginx (≈10 min)

```bash
sudo nano /etc/nginx/sites-available/yoga-app
```

Paste (replace `DROPLET_IP`):

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name DROPLET_IP;            # later: yourdomain.com www.yourdomain.com
    root /var/www/yoga-app/public;
    index index.php;
    charset utf-8;
    client_max_body_size 20M;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ ^/index\.php(/|$) {
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    # block .env, .git and other dotfiles
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable it and remove the default "Welcome to nginx" site:

```bash
sudo ln -s /etc/nginx/sites-available/yoga-app /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default
sudo nginx -t                  # must say "syntax is ok" and "test is successful"
sudo systemctl reload nginx
```

---

## Phase 8 — Launch and smoke-test (≈15 min)

### 8.1 Cache config/routes/views for speed

```bash
cd /var/www/yoga-app
php artisan storage:link
php artisan optimize           # caches config, routes, views, events
sudo systemctl reload php8.3-fpm
```

> After **any** `.env` edit you must run `php artisan optimize` again — the cached config ignores
> `.env` changes until re-cached.

### 8.2 Open it

Browser → `http://DROPLET_IP` — you should see the yoga site.

### 8.3 Smoke-test checklist (tick these in the notes)

- [ ] `/` home page, styled (if it's unstyled: see Troubleshooting "no CSS")
- [ ] `/gallery` — list loads, search + category + difficulty filters work
- [ ] `/asana-details/1`, `/asana-details/2`, `/asana-details/8` — full content + photo
- [ ] an asana with no content/photo (e.g. Ardha Chakrasana) — empty states + blank placeholder image
- [ ] `/sukhsma-vyayama`, `/sthula-vyayama`, `/tibetan-rites`, `/surya-namaskara`, `/yoga-nidra`
- [ ] `/philosophy` — quote cards: 4 per row on a laptop, 1 per row on your phone
- [ ] Language switcher (en / fi / np) changes text
- [ ] Phone on **home Wi-Fi** works (same IP); phone on **mobile data** does *not* (proves the firewall)
- [ ] `http://DROPLET_IP/.env` → 403 Forbidden (must NOT show the file)
- [ ] No errors in `tail -n 50 storage/logs/laravel-*.log`

**Phase 8 done = private test deploy live.** Record it in the notes with the date.

---

## Phase 9 — Domain + HTTPS (optional now, required before going public)

Let's Encrypt certificates need a domain name; they can't be issued for a bare IP.

1. Buy a domain anywhere (Namecheap, Cloudflare, etc.).
2. At the registrar, set an **A record**: `@` → `DROPLET_IP`, and another: `www` → `DROPLET_IP`.
   (Or move DNS to DigitalOcean: Networking → Domains.) Wait 5–60 min; check with
   `nslookup yourdomain.com` in PowerShell.
3. On the server: change `server_name DROPLET_IP;` to `server_name yourdomain.com www.yourdomain.com;`
   in `/etc/nginx/sites-available/yoga-app`, then `sudo nginx -t && sudo systemctl reload nginx`.
4. Certbot needs to reach port 80 from Let's Encrypt's servers, which the private firewall blocks.
   Temporarily add `HTTP 80 — All IPv4/All IPv6` to the `yoga-private` firewall, then:
   ```bash
   sudo apt install -y certbot python3-certbot-nginx
   sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com   # choose "redirect" when asked
   ```
   Remove the temporary rule afterwards if you're still testing privately. (Renewal every ~60
   days needs port 80 reachable again — easiest is to go public before then.)
5. In `.env`: `APP_URL=https://yourdomain.com`, `SESSION_SECURE_COOKIE=true`, then
   `php artisan optimize`.

---

## Phase 10 — Going public (only after these are done)

**Hard gate — do not open the firewall until item 1 is fixed:**

1. **Fix the 5 unauthenticated, CSRF-exempt write routes** (`/get-asanas`, `/add-asanas`,
   `/update-asanas`, `/delete-asanas`, `/add-asana-steps`) — `DEPLOYMENT_TODO.md` item 1. Right
   now anyone who finds them can edit or delete your content. While the firewall only allows your
   IP this is safe; on the open internet it isn't.
2. Domain + HTTPS working (Phase 9).
3. Decide on `DEPLOYMENT_TODO.md` item 3 (duplicate `addAsanas()`) — not a blocker, just tidy.

Then: Networking → Firewalls → `yoga-private` → change the **HTTP** and **HTTPS** sources to
**All IPv4 + All IPv6**. **Keep SSH limited to your IP.** That's launch — no redeploy needed.

---

## Updating the site later (every future deploy)

On your PC (Git Bash), with everything committed on master:

```bash
bash scripts/release-production.sh
git push origin master production
```

Then on the server:

```bash
cd /var/www/yoga-app
php artisan down                         # shows a maintenance page during the update
git pull origin production
composer install --no-dev --optimize-autoloader
npm ci && npm run build
php artisan migrate --force              # runs only new migrations
php artisan optimize
sudo systemctl reload php8.3-fpm
php artisan up
```

**Content added locally (new asanas/images) only reaches the server through a migration or the
admin/write routes — not through a new dump.** Re-importing a full dump would overwrite anything
created on the server. Follow the data-only-migration convention (`CONVENTIONS_DATABASE.md`).

## Backups

```bash
# on the server — a dated DB backup in the deploy user's home folder
mysqldump -u yoga_user -p --single-transaction --no-tablespaces yoga_production > ~/yoga_$(date +%F).sql
```

Download it to your PC with `scp deploy@DROPLET_IP:~/yoga_2026-10-10.sql C:\Projects\yoga01\db-dumps\`.
Also keep `APP_KEY` safe (notes file) — encrypted data/sessions can't be read without it.

---

## Troubleshooting

| Symptom | Likely cause → fix |
|---|---|
| `ssh` times out / site won't load at all | Your home IP changed → `curl.exe ifconfig.me`, update the `yoga-private` firewall sources. Locked out completely? Droplet page → **Access** → **Launch Recovery Console** works regardless of firewall. |
| `Permission denied (publickey)` | Wrong user/key → use `ssh deploy@IP`; check the key was added in step 1.3 *before* creating the Droplet. |
| **502 Bad Gateway** | PHP-FPM not running or wrong socket → `sudo systemctl status php8.3-fpm`; socket path in nginx must be `/run/php/php8.3-fpm.sock`. |
| **500 Server Error** | Check `tail -n 50 storage/logs/laravel-*.log`. Usually permissions (redo 5.4), missing `APP_KEY`, or DB login. |
| `SQLSTATE[HY000] [1045] Access denied` | `.env` DB password ≠ step 4.2 → fix `.env`, then `php artisan optimize`. |
| `.env` changes do nothing | Config is cached → `php artisan optimize` (or `php artisan config:clear`). |
| Page has no styling / "Vite manifest not found" | `npm run build` didn't run or failed → run it in `/var/www/yoga-app`. |
| Images missing | Check `APP_URL`; check the file exists under `public/images/...` on the server (`git pull` up to date?). |
| `composer install` / `npm` killed or "out of memory" | Swap missing → redo step 2.2. |
| `No such table: visits` (or sessions/cache) | `yoga_empty_tables.sql` wasn't imported → step 6.2. |
| Nginx error log | `sudo tail -n 50 /var/log/nginx/error.log` |
