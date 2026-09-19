# Deployment To-Do — Path to a Test Deploy, Then Public Launch

Written 2026-09-19. Synthesizes [PROJECT_PLAN.md](PROJECT_PLAN.md),
[PROJECT_FINDINGS.md](PROJECT_FINDINGS.md), and [README_DEVELOPER.md](README_DEVELOPER.md) —
those were written 2026-07-20 and describe an earlier state of the codebase. A lot of Phase 2's
schema work has happened since (see "What's already done" below); this doc corrects the picture
and gives you an actual next-steps list, plus a private-testing path before you go public.

## TL;DR

- Yes — you can deploy to a real server **without making it public**. See
  [Testing privately before launch](#testing-privately-before-launch) below. Recommended: a
  DigitalOcean Droplet with its firewall locked to your own IP, or HTTP Basic Auth in front of the
  whole site. Both let you test on real infrastructure with a real URL, visible only to you.
- The database/schema work (Phase 2 of the old plan) is substantially done. `/gallery` is now
  DB-driven too (fixed 2026-09-19, see below). What's **still not** done, and blocks a real public
  launch: (1) the write routes are still unauthenticated, (2) only 3 of 40 asanas have real content
  (steps/benefits/tags/image), (3) `.env` is still pointed at local dev values.

## What's already done (the old docs don't know about this)

Since the 2026-07-20 audit, this session did the following — don't redo it:

- Migrated `asana_steps`, `asana_benefits`, `asana_contraindications` (all one-to-many off
  `asanas`), fixed `images` to have real `path`/`name` columns, and added `categories`,
  `difficulty_levels`, `time_of_the_day`, `sources`, `asana_references`, plus an `asana_tag`
  many-to-many pivot. Full detail in [DATABASE_SCHEMA_ASANAS.md](DATABASE_SCHEMA_ASANAS.md).
- Added Eloquent models for all of the above, with relationships wired onto `Gallery` (the
  `asanas` model — still named `Gallery`, see [Small cleanups](#small-cleanups-not-blockers)).
- Added `GalleryController::getAsanaWithDetails()`, which actually queries the database (not a
  hardcoded array) and builds the pose/steps/benefits/contraindications/tags data the detail page
  needs. `/showgallerycard/{id}` now routes here instead of the old broken `show()` — **the
  `$id = 1;` bug from `PROJECT_FINDINGS.md` no longer affects the live route** (though the old
  `show()` method with that bug is still sitting in the file, unused — see cleanups below).
  See [ADD_ASANA_STEPS_FEATURE.md](ADD_ASANA_STEPS_FEATURE.md).
- `gallery-detail.blade.php` now renders real category/difficulty/time-of-day/tags/benefits/
  contraindications/image from the database instead of hardcoded placeholder text, with graceful
  empty states for asanas that don't have content yet.
- 3 asanas (Tadasana `id 1`, Padahastasana `id 2`, Vajrasana `id 8`) have full dummy content
  seeded end-to-end, as a working example of the shape every asana eventually needs.
- **2026-09-19**: `GalleryController::index()` (the `/gallery` listing page) now queries
  `Gallery::with(['category', 'difficultyLevel', 'tags', 'images'])` instead of returning the old
  9-item hardcoded array — it shows all 40 real asanas, each linking to its own correct
  `/showgallerycard/{id}`, with real image/category/difficulty/tags where seeded and graceful
  fallbacks (`/lotus-images/blank_image.png`, "Uncategorized", "All Levels") where not. Category
  filter, difficulty filter, and search all verified working against real data.
  `gallery.blade.php` itself needed no changes — the controller maps DB rows into the same array
  shape the view already expected.

## What's not done yet

### Must fix before any public deploy (security)

1. **Five unauthenticated, CSRF-exempt write routes** in `routes/web.php`:
   `/get-asanas`, `/add-asanas`, `/update-asanas`, `/delete-asanas` (existing), plus
   `/add-asana-steps` (added this session for Postman testing). Anyone with the URL can
   currently create/edit/delete asana rows on a public deploy. Before going public: either
   delete these, or gate them behind `Route::middleware('auth')` / an `APP_ENV=local` check.
2. `.env` still has `APP_ENV=local`, `APP_DEBUG=true`, `DB_USERNAME=root`/`DB_PASSWORD=root`,
   and `APP_URL=http://192.168.1.4:8000` (a LAN address). All four must change for production —
   `APP_DEBUG=true` on a public site leaks stack traces with file paths and config values.
3. The duplicate `GalleryController::addAsanas()` (there's also one in `TestController`) —
   decide whether to keep both or delete the redundant one.

### ~~`/gallery` listing was hardcoded~~ — fixed 2026-09-19

`GalleryController::index()` now queries the database (see "What's already done" above). No
longer an open item.

### Content completeness (the actual "70%" bar from PROJECT_PLAN.md)

4. Only 3 of 40 real asanas (in the `asanas` table) have steps/benefits/contraindications/tags/an
   image row. The other 37 render with the empty-state fallbacks ("No benefits listed yet", no
   image, "Uncategorized"/"All Levels" on the gallery grid). `category_id`/`source_id`/
   `time_of_the_day_id`/`reference_id` are still the placeholder `1` for every asana except the 3
   seeded ones — real values haven't been assigned per-asana.
5. No seeder/content-pipeline exists yet to populate the other 37 from a single source file —
   `CONTENT_PIPELINE.md` describes the intended JSON → seeder approach; it hasn't been built. Right
   now, populating an asana means writing one-off `DB::table()->insert()` calls (as this session
   did for the 3 demo asanas), which doesn't scale to 37 more.
6. `data.md` (modified, uncommitted) and `new_data.md`/`yogasana.json` (untracked) sitting in the
   repo root have real, usable content (per `PROJECT_FINDINGS.md`) that was never pulled into the
   database — worth using as source material for item 5 rather than writing content from scratch.

### Small cleanups (not blockers, but worth doing before or shortly after launch)

7. `GalleryController::show()` still has the `$id = 1;` bug — it's dead code now (nothing routes
   to it), but leaving a known-buggy unused method in the controller is confusing for the next
   person. Either delete it or fix the one-line bug.
8. The `Gallery` model name still doesn't match what it holds (`asanas` table) — a rename to
   `Asana` was suggested in the old plan; purely cosmetic, do it whenever it's convenient, not
   urgent.
9. Decide on the non-yoga utility tools (CV generator, cover letter, currency converter, Nepali
   calendar) — already unlinked from nav, but still live at their routes. Confirm keep/hide/delete
   before calling the site "launched."

## Testing privately before launch

You don't have to choose between "stays on localhost" and "fully public." Three real options,
cheapest/fastest first:

**1. Local tunnel (ngrok or similar) — zero infrastructure, minutes to set up.**
Run `php artisan serve` locally, point a tunnel tool at it, get a temporary public-ish URL to
share with yourself or a tester on another device. Good for a quick look on a phone or a second
person's browser. Not a real deploy — doesn't test production `.env`, MySQL on a real server, or
Vite production build — but it's the fastest way to see the site outside your own machine before
committing to anything else.

**2. DigitalOcean Droplet with the firewall locked to your IP (recommended).**
Follow `digitalocean_laravel_mysql_deployment.pdf` (already in the repo root) to provision the
Droplet, MySQL, and the Laravel app exactly as you would for production — but in DigitalOcean's
Networking → Firewalls, restrict inbound HTTP/HTTPS to your own IP address (or a small allowlist
of testers' IPs) instead of `0.0.0.0/0`. This is a genuine production-equivalent test: real
server, real MySQL, real `.env` with `APP_ENV=production`, real domain/subdomain if you want one
— just not reachable by anyone outside the allowlist. When you're satisfied, open the firewall to
the world and that's your launch — no re-deploy needed.

**3. HTTP Basic Auth in front of the whole site.**
If you'd rather not manage a firewall (or want to share access with someone whose IP changes),
add HTTP Basic Auth at the nginx/Apache level (a few lines in the server config, `.htpasswd` file)
so the whole site prompts for a username/password before showing anything. Works on any host,
including DigitalOcean App Platform where you don't control firewall rules directly. Slightly less
airtight than an IP allowlist (a leaked password/URL is enough), but simple and portable.

**Recommendation**: use option 2 for the actual pre-launch test — it's the same infrastructure
you'll launch on, so nothing changes when you flip it public. Use option 1 first if you just want
a quick look at the current state on your phone before setting anything up.

## Suggested order of work

```
1. Security fixes (items 1-3)          ─────▶ 2. Deploy privately (Droplet + IP allowlist)
                                                          │
3. Populate remaining 37 asanas          ────────────────┴─▶ 4. Review privately, fix what looks wrong
   (items 4-6, can happen after                                  │
   the private deploy is up)                                      ▼
                                                            5. Open the firewall — you're live
```

The security fixes are small and mechanical — do those first (`/gallery` is already fixed).
Content population (items 4-6) is the long pole and doesn't have to finish before you deploy
privately; you can deploy with partial content, look at it on real infrastructure, and keep
filling in asanas while it sits behind the IP allowlist.

## Deployment steps (once ready to actually deploy, public or private)

From `README_DEVELOPER.md`, layered on top of `digitalocean_laravel_mysql_deployment.pdf`:

1. Provision the Droplet + MySQL per the PDF.
2. Update production `.env`: `APP_ENV=production`, `APP_DEBUG=false`, real `DB_PASSWORD` (not
   `root`), `APP_URL` set to the real domain or Droplet IP.
3. `composer install --optimize-autoloader --no-dev`
4. `npm run build` (confirm this actually runs in whatever deploy script/steps you use — nothing
   in the repo automates it yet)
5. `php artisan migrate --force` (this runs all the migrations from this session too — categories,
   difficulty_levels, asana_benefits, etc. — nothing extra needed there)
6. `php artisan storage:link`, `php artisan config:cache`, `php artisan route:cache`
7. HTTPS via Let's Encrypt/Certbot if self-managing nginx.
8. If testing privately first: lock the DigitalOcean firewall to your IP now, before DNS/public
   exposure.
9. Smoke-test every route in `routes/web.php` on the live URL, including `/asana-details/{id}`
   and `/showgallerycard/{id}` for a few different ids (1, 2, 8 have full content to check against;
   try one without content too, to confirm the empty states render cleanly).
10. Once satisfied: open the firewall (or point DNS) to go public.

## Open decisions only you can make

Carried over from `PROJECT_PLAN.md`, still unresolved:

1. Keep, hide, or delete the non-yoga utility tools before launch?
2. Droplet vs. App Platform for hosting? (Droplet gives you the IP-allowlist private-testing path
   above directly; App Platform would need the Basic Auth approach instead since you don't get
   direct firewall control.)
3. How many of the 40 asanas need full content to call this launched — all of them, or a smaller
   set with the rest following post-launch?
