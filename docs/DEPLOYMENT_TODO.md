# Deployment To-Do — Path to a Test Deploy, Then Public Launch

Written 2026-09-19. Synthesizes [PROJECT_PLAN.md](PROJECT_PLAN.md),
[PROJECT_FINDINGS.md](PROJECT_FINDINGS.md), and [README_DEVELOPER.md](README_DEVELOPER.md) —
those were written 2026-07-20 and describe an earlier state of the codebase. A lot of Phase 2's
schema work has happened since (see "What's already done" below); this doc corrects the picture
and gives you an actual next-steps list, plus a private-testing path before you go public.

**New to this doc, or coming back after a break?** Start with
[RESUME_HERE.md](RESUME_HERE.md) instead — it's the short version with a "what to do first"
pointer. [PROJECT_PROGRESS.md](PROJECT_PROGRESS.md) has the full percentage breakdown behind the
TL;DR below. The `CONVENTIONS_*.md` docs (database, functions, routes, frontend, variables, css)
describe how this codebase is actually written, for keeping new code consistent.

## TL;DR

- Yes — you can deploy to a real server **without making it public**. See
  [Testing privately before launch](#testing-privately-before-launch) below. Recommended: a
  DigitalOcean Droplet with its firewall locked to your own IP, or HTTP Basic Auth in front of the
  whole site. Both let you test on real infrastructure with a real URL, visible only to you.
- The database/schema work (Phase 2 of the old plan) is substantially done. `/gallery` is now
  DB-driven too (fixed 2026-09-19, see below), and **31 of the 40 original asanas now have real
  steps/benefits/contraindications** (up from 3, also 2026-09-19 — see
  [CONTENT_EXTRACTION_STATUS.md](CONTENT_EXTRACTION_STATUS.md)). The `asanas` table now also holds
  Sukshma Vyayama, Sthula Vyayama, and Tibetan Rites practices (36 more rows), plus a whole
  separate Surya Namaskara sequence schema — see
  [UNIFIED_PRACTICE_SCHEMA.md](UNIFIED_PRACTICE_SCHEMA.md). **Every practice type now has a real
  page** (fixed 2026-09-19, see below) — Sukshma/Sthula Vyayama, Tibetan Rites listing pages,
  a dedicated Surya Namaskara sequence page, and a friendly "coming soon" page for Yoga Nidra
  (no data exists for it yet, by design — not a bug). What's **still not** done, and blocks a
  real public launch: (1) the write routes are still unauthenticated, (2) most asanas still have
  no image or tags, (3) `.env` is still pointed at local dev values.
- **Overall progress**: roughly 53% of the way to a public launch, ~80% of the way to a private
  test deploy (security + hosting are the gap between those two numbers, not content). Full
  breakdown with the reasoning behind those numbers in
  [PROJECT_PROGRESS.md](PROJECT_PROGRESS.md).
- **Note**: `/gallery`'s `practice_type_id` filter was deliberately removed by the project owner —
  `/gallery` is meant to be a single library-style listing of everything (asanas *and* Sukshma/
  Sthula Vyayama/Tibetan Rites), searchable by as many keywords as possible, not scoped to just
  "Asana" rows. If you're reading this and wondering why `GalleryController::index()` doesn't
  filter by type: that's intentional, don't reintroduce the filter.

## What's already done (the old docs don't know about this)

Since the 2026-07-20 audit, this session did the following — don't redo it:

- Migrated `asana_steps`, `asana_benefits`, `asana_contraindications` (all one-to-many off
  `asanas`), fixed `images` to have real `path`/`name` columns, and added `categories`,
  `difficulty_levels`, `time_of_the_day`, `sources`, `asana_references`, plus an `asana_tag`
  many-to-many pivot. Full detail in [DATABASE_SCHEMA_ASANAS.md](DATABASE_SCHEMA_ASANAS.md).
- Added Eloquent models for all of the above, with relationships wired onto the `asanas` model
  (originally named `Gallery`; renamed to `Asana` — see [Small cleanups](#small-cleanups-not-blockers)).
- Added `GalleryController::getAsanaWithDetails()`, which actually queries the database (not a
  hardcoded array) and builds the pose/steps/benefits/contraindications/tags data the detail page
  needs. `/showgallerycard/{id}` now routes here instead of the old broken `show()` — **the
  `$id = 1;` bug from `PROJECT_FINDINGS.md` no longer affects the live route** (though the old
  `show()` method with that bug is still sitting in the file, unused — see cleanups below).
  See [ADD_ASANA_STEPS_FEATURE.md](ADD_ASANA_STEPS_FEATURE.md).
- `gallery-detail.blade.php` now renders real category/difficulty/time-of-day/tags/benefits/
  contraindications/image from the database instead of hardcoded placeholder text, with graceful
  empty states for asanas that don't have content yet.
- 3 asanas (Tadasana `id 1`, Padahastasana `id 2`, Vajrasana `id 8`) originally had dummy/partial
  content seeded end-to-end, as a working example of the shape every asana eventually needs —
  **superseded 2026-09-19**, see below (Vajrasana's dummy content was replaced with its real
  content; Tadasana/Padahastasana's dummy benefits/contraindications are still dummy, since no
  real source text for those two was found — see `CONTENT_EXTRACTION_STATUS.md`).
- **2026-09-19**: `GalleryController::index()` (the `/gallery` listing page) now queries
  `Gallery::with(['category', 'difficultyLevel', 'tags', 'images'])` instead of returning the old
  9-item hardcoded array — each row links to its own correct `/showgallerycard/{id}`, with real
  image/category/difficulty/tags where seeded and graceful fallbacks
  (`/lotus-images/blank_image.png`, "Uncategorized", "All Levels") where not. Category filter,
  difficulty filter, and search all verified working against real data. `gallery.blade.php` itself
  needed no changes — the controller maps DB rows into the same array shape the view already
  expected. (Originally scoped to `practice_type_id = 1`; the project owner intentionally removed
  that filter afterward so `/gallery` is one searchable library across every practice type — see
  the note in the TL;DR above.)
- **2026-09-19**: Found `D:\Yoga_Asanas` — a folder of ~90 scanned note images plus 10
  hand-cleaned `.md` transcriptions covering ~29 poses' full steps/benefits/contraindications.
  Cross-referenced against the `asanas` table by name and inserted all 29 matches via
  `database/migrations/2026_09_19_150000_seed_real_asana_content_from_notes.php`. Full source
  mapping, what's still missing (Ardha Chakrasana, Ardhakatichakrasanaa, Balasana have no source
  text anywhere yet), and a data-quality flag (a duplicate Vajrasana row, `id 30`, plus several
  `Trysana*` test rows that should probably be deleted) are in
  [CONTENT_EXTRACTION_STATUS.md](CONTENT_EXTRACTION_STATUS.md).
- **2026-09-19**: Unified Sukshma Vyayama, Sthula Vyayama, and Tibetan Rites into the `asanas`
  table (new `practice_type_id` column + `practice_types` lookup) rather than building 3 more
  copies of the steps/benefits/contraindications schema — added 31 new practice rows this way, all
  with real content. Built a separate `surya_namaskara` + 3 child tables for the Surya Namaskara
  sequence (it references other postures rather than having its own steps) and seeded its full
  12-step sequence, verified resolving correctly end to end. `GalleryController::index()` was
  briefly scoped to `practice_type_id = 1` at this point, later removed per the project owner (see
  above). Full detail in [UNIFIED_PRACTICE_SCHEMA.md](UNIFIED_PRACTICE_SCHEMA.md) — including a
  real bug hit and fixed along the way (`asana_steps.asana_steps` was `varchar(100)`, too small
  for real sentences, widened to `varchar(500)`).
- **2026-09-19**: Connected the frontend to all of the above. `/show-asana` already had 5 practice
  cards (Sukshma Vyayama, Sthula Vyayama, Tibetan Rites, Surya Namaskara, Yoga Nidra), but only the
  first two linked anywhere real — the other three pointed at `tibetan.html`/`surya.html`/
  `nidra.html`, static files that don't exist. Built out the rest:
  - `SukhsmaVyayamaController`/`SthulaVyayamaController` now query the database (`practice_type_id`
    2/3) instead of their own separate hardcoded arrays — same fix as `/gallery` got earlier.
  - New `TibetanRitesController` + `/tibetan-rites` route + view, same listing-grid pattern,
    querying `practice_type_id = 4`.
  - New `SuryaNamaskaraController` + `/surya-namaskara` route + a dedicated sequence view (not the
    filterable grid — it renders the 12-step sequence with breath/chakra/mantra per step, each
    linking to its underlying posture's own detail page).
  - New `/yoga-nidra` route + a friendly "coming soon" view — there's no data or table for Yoga
    Nidra yet (intentionally deferred), so this is a real page with an honest message instead of a
    dead link.
  - Fixed a real bug found while doing this: the Sukshma/Sthula Vyayama (and now Tibetan Rites)
    listing views hardcoded every card's link to asana `id => 1` — every single card, regardless of
    which practice it displayed, linked to the same detail page. Now uses each row's actual id.
    Also fixed `sthula-vyayama.blade.php`'s "no results" link, which pointed at a route name
    (`gallery-asana-detail`) that doesn't exist and would have thrown if a search ever matched
    nothing.
  - Fixed a `stripos(): Passing null` deprecation warning in the search filter of all four listing
    controllers (Gallery/Sukshma/Sthula/Tibetan) — several new practices have a `null`
    `asana_description`, which `stripos()` doesn't accept.
- **2026-09-19 (later same session)**: Reworked the asana detail page's "Practice Steps" card
  (`<x-asana-step-card>`, used on `/showgallerycard/{id}` and `/asana-details/{id}`) — it used to
  render 4 hardcoded, unrelated lotus-icon placeholders in a 2×2 grid on the image side. Now shows
  one real photo (the asana's own primary image, `object-fit: cover`, filling the space), and that
  side's header changed from repeating "Practice Steps" to "Final {{ Asana Name }} Pose" — steps
  vs. final result are now visually distinct. The same photo was also added beside the pose
  description near the top of the page (that section existed in the markup, commented out, from
  earlier in the project — re-enabled with a proper side-by-side layout instead of the stacked
  layout its old CSS would have produced). **Reverted by the project owner right after**: showing
  the same photo in both spots read as a repeated/duplicated image on the page, so the top
  "beside the description" block is commented out again (back to how it was before this session,
  intentionally — don't re-enable it without a different image or a design reason to show it
  twice). **Final state: the asana's photo appears in exactly one place — beside the steps, inside
  the practice-steps card** (`<x-asana-step-card>`'s image side). Along the way, fixed a real bug: both spots previously
  fell back to a specific, real photo (`virasana.jpeg`) for any asana with no image of its own —
  meaning an asana with no photo yet would silently display someone else's pose as if it were its
  own. Now falls back to the generic `/lotus-images/blank_image.png` placeholder, matching what
  `/gallery` already does. Verified by rendering an asana with an image (Tadasana), one without
  (Ardha Chakrasana), and the newly-added Bhujanga Asana, confirming the right header text, no
  leftover `virasana` references, and the correct fallback/real image in each case.

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

4. **31 of 40 real asanas now have real steps/benefits/contraindications** (as of 2026-09-19 — see
   `CONTENT_EXTRACTION_STATUS.md`). 3 of those 40 (Ardha Chakrasana, Ardhakatichakrasanaa, Balasana)
   have **no source text anywhere yet** — a genuine content gap, not a data-entry backlog. The
   remaining 6 (a duplicate Vajrasana row, `id 30`, plus 5 `Trysana*` test rows) aren't real asanas
   and should probably be deleted rather than filled in — see the data-quality note in
   `CONTENT_EXTRACTION_STATUS.md`.
5. **Images: substantially improved (2026-09-19), tags still open.** Was: only Tadasana,
   Padahastasana, Vajrasana had an image. Now 17 of 76 asanas do. Sourced from (in priority order
   given): `D:\Yoga_certificates\YogaMaterials\Haukkaniemi_yoga_pose_pictures` (already copied into
   `public/images/yogasana_pictures` by an earlier session, just never linked in the database —
   covers Vrikshasana, Trikonasanaa, Bhadrasana, Uttana Mandukasana, Manduka Asana, Gomukhasana,
   Yoga Mudrasana, Padmasana), existing but unlinked top-level files in `public/images`
   (Halasana, Sarvanga Asana, Vipareeta Karani), and
   `C:\Users\chitr\OneDrive\Pictures\EditedOnes\cuttedones` (Simha Garjasana, Vakrasana, Bhujanga
   Asana — copied in after visually checking each photo against its filename). Every candidate
   image was opened and visually compared to the named pose before use, not just matched by
   filename — this caught one real mislabel in the `cuttedones` folder (`HalasanaProper.jpeg` is a
   prone backbend holding the feet, not Plow Pose), excluded rather than inserted wrong.
   `Bhujanga.png` was initially excluded on the same visual-mismatch reasoning (looked like a
   hands-and-knees stretch rather than the classic prone Cobra Pose), but the project owner
   confirmed it's their own practiced variation of the pose — added back in via
   `2026_09_19_171000_seed_bhujanga_asana_image.php` rather than editing the already-run migration.
   `D:\...\Forest_August_Suryanamaskara` was checked too but not used — generic camera filenames
   (`P1010xxx`) with mostly repeated/indistinguishable standing frames, not reliably attributable
   to one specific step of the 12-pose sequence without a dedicated frame-by-frame session; left
   for later rather than guessed. Full row-by-row list and reasoning in migration
   `2026_09_19_170000_seed_images_for_newly_photographed_asanas.php`. Verified by
   rendering `/gallery` and all affected `/asana-details/{id}` pages and confirming every
   referenced file exists on disk.
   **Still open:** 59 asanas still have no image (fallback placeholder still applies to them); tags
   are unchanged (still only Tadasana/Padahastasana) — this round was scoped to images only.
6. No seeder/content-pipeline exists yet to populate content from a single structured source file —
   `CONTENT_PIPELINE.md` describes the intended JSON → seeder approach; it hasn't been built. The 29
   asanas populated 2026-09-19 were inserted via one large data-only migration (a PHP array,
   transcribed by hand from the `.md` notes) — workable for a one-time batch like this, but not a
   repeatable "update content" workflow. Worth building the real pipeline before the *next* content
   batch (images/tags, or whatever surfaces to fill the 3 missing asanas).
7. ~~The 6 remaining `.md` files have no database table~~ / ~~no page renders any of it~~ —
   **both done 2026-09-19**, see `UNIFIED_PRACTICE_SCHEMA.md`. `/sukhsma-vyayama`,
   `/sthula-vyayama`, and the new `/tibetan-rites` all query the database now; `/surya-namaskara`
   has its own dedicated sequence page; `/yoga-nidra` has an honest "coming soon" page rather than
   the dead `nidra.html` link it used to be. No longer an open item.
8. ~~`data.md`/`new_data.md`/`yogasana.json` at the repo root have real, usable content that was
   never pulled into the database~~ — **Done/deleted (2026-09-19).** Per the project owner: this
   has been handled with more data than these files held at the time this item was written, and
   the files have since been deleted from the repo root. No longer an open item.

### Small cleanups (not blockers, but worth doing before or shortly after launch)

9. ~~`GalleryController::show()` still has the `$id = 1;` bug~~ — **Done (2026-09-19).** Confirmed
   nothing in `routes/web.php` referenced it (`/gallery` uses `index()`, `/showgallerycard/{id}` and
   `/asana-details/{id}` use `getAsanaWithDetails()`), so the whole dead method was deleted along
   with its now-unused `Log` facade import, instead of fixing a bug in code nothing calls.
10. ~~The `Gallery` model name still doesn't match what it holds (`asanas` table)~~ — **Done
    (2026-09-19).** Renamed `app/Models/Gallery.php` to `app/Models/Asana.php` (class `Gallery` →
    `Asana`, same `asanas` table/columns/relationships, nothing else changed). Updated every
    reference: `GalleryController`, `TestController`, `TibetanRitesController`,
    `SukhsmaVyayamaController`, `SthulaVyayamaController`, and the `belongsTo`/`hasMany`/
    `belongsToMany` relationships in `Category`, `DifficultyLevel`, `TimeOfTheDay`, `Source`,
    `AsanaReference`, `Tag`, `AsanaStep`, `AsanaBenefit`, `AsanaContraindication`, `Image`,
    `PracticeType`, and `SuryaNamaskaraStep`. `GalleryController` itself keeps its name — it's the
    controller for the `/gallery` page, a real concept, not a mismatch. Verified via `php -l` on
    every touched file and by rendering `/gallery`, `/asana-details/{id}`, `/sukhsma-vyayama`,
    `/sthula-vyayama`, and `/tibetan-rites` through Tinker post-rename.
11. ~~Decide on the non-yoga utility tools (CV generator, cover letter, currency converter, Nepali
    calendar)~~ — **Done (2026-09-19).** Decision: keep, not delete — planned for a later version.
    For this launch they're hidden, not live: the nav links were already commented out in
    `resources/views/layouts/header.blade.php`; their four routes in `routes/web.php` (and the
    now-unused controller `use` imports) are commented out too, so `/cv-generator`,
    `/cover-letter`, `/currency-converter`, `/nepali-calendar` return 404 instead of a working
    page. Controllers, views, and language keys are untouched — re-enabling later is just
    uncommenting both blocks in `routes/web.php`. Verified via `php artisan route:list` that none
    of the four routes are registered.
12. **Done (2026-10-10)** — `philosophy.blade.php`'s Bootstrap grid replaced with plain CSS;
    `info.blade.php`'s hits were only inside a Blade comment (linter now ignores comments).
    Original note: found while building the conventions linter:
    `philosophy.blade.php` and `info.blade.php` use Bootstrap-style grid classes (`row`, `col-12`,
    `col-md-6`, `d-flex`, `g-4`, `align-items-stretch`) — but this project has no Bootstrap CSS
    anywhere (not in `package.json`, no CDN link in any layout file, and neither page defines
    those class names itself in its own `<style>` block). These classes are very likely
    completely inert right now — whatever layout is visible is happening despite them, not
    because of them. Worth a proper look: either actually load Bootstrap (inconsistent with the
    rest of the app, which is Tailwind v4 + hand-rolled CSS — see `CONVENTIONS_CSS.md`) or rewrite
    these two pages' grids in real CSS/Tailwind.
13. **New (2026-09-19)**: `cover-letter.blade.php` and `cv-generator.blade.php` each still contain
    a live `route('cover-letter')` / `route('cv-generator')` self-reference (their own form
    `action` attribute) even though those routes are now commented out (see item 11). Currently
    harmless — nothing routes to these views either, so the broken self-reference never executes
    — but if either page is ever reached another way without first restoring its route, it will
    throw `RouteNotFoundException`. Worth fixing at the same time item 11 is ever revisited.
    Caught by `scripts/lint-conventions.php`'s route-name check — see `RESUME_HERE.md`.

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
3. Images/tags + the 3 missing asanas    ────────────────┴─▶ 4. Review privately, fix what looks wrong
   + decide Sukshma Vyayama schema                                │
   (items 4-7, can happen after                                    ▼
   the private deploy is up)                                5. Open the firewall — you're live
```

The security fixes are small and mechanical — do those first (`/gallery` is fixed, and steps/
benefits/contraindications are now populated for 31/40 asanas). What's left in content (items 4-7)
is the long pole and doesn't have to finish before you deploy privately; you can deploy with
partial content, look at it on real infrastructure, and keep filling in images/tags/the remaining
3 asanas while it sits behind the IP allowlist.

## Deployment steps (once ready to actually deploy, public or private)

**Superseded 2026-10-10 by [DEPLOYMENT_PLAN.md](DEPLOYMENT_PLAN.md)** — the full, beginner-level
step-by-step (Ubuntu 24.04 / PHP 8.3, DB copied via dump rather than rebuilt by migrations).
The summary below is kept for reference.


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
