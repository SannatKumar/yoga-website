# For the Developer

Technical reference for actually doing the work in [PROJECT_PLAN.md](PROJECT_PLAN.md). Assumes
you've read [PROJECT_FINDINGS.md](PROJECT_FINDINGS.md) for the "why."

## Stack

- Laravel 12, PHP ^8.2, Blade (no frontend framework).
- Tailwind v4 via `@tailwindcss/vite` — installed but not actually used in most views; expect
  hand-rolled `<style>` blocks per Blade file instead of utility classes. Don't assume Tailwind
  conventions apply when editing existing views.
- MySQL, database `yoga_project`. Local `.env` currently has `DB_USERNAME=root` /
  `DB_PASSWORD=root` — fine for local, must not ship to production as-is.
- Vite dev server on 5173, `php artisan serve` on 8000 — see `SERVE_PROJECT.md` (already accurate,
  no changes needed there).

## Real project structure (the root `README.md`'s version is stale)

```
app/
  Http/Controllers/
    HomeController, GuideController, GuruStutiController, ShowAsanaController,
    GalleryController, SukshmaVyayamaController, SthulaVyayamaController,
    MantraShlokaBhajanController, TeacherController, TestController (CRUD test routes),
    CVGeneratorController, CoverLetterController, CurrencyConverterController,
    NepaliCalendarController, CustomerController, LotusPageController, UserController
  Http/Middleware/
    SetLocale, SetDefaultLocaleForUrls, TrackVisits
  Models/
    User, Visit, Gallery (maps to `asanas` table — misleadingly named), Test, Customer, YogaPost (unused by any controller)
database/migrations/
  users, cache, jobs (defaults) + test, visits, asanas, tags, asana_steps, images,
  personal_access_tokens (Sanctum), customers
resources/views/
  layouts/{app,header,footer}.blade.php
  components/{asana-step-card,pose-steps,page-header,philosophy-card,guide-block,locale-switcher}.blade.php
  welcome, gallery, gallery-detail, show-asana, guide, guru-stuti, philosophy, videos,
  info, teacher-profile, contact, terms, mantra-shloka-bhajan(-content),
  sthula-vyayama, sukhsma-vyayama, lotus-page, template
  + cv-generator, cover-letter, currency-converter, nepali-calendar (utility tools, unlinked from nav)
resources/lang/{en,fi,np}/messages.php
```

## The actual schema vs. the intended schema

`create_table.sql` (a design doc, never fully migrated) describes: `asanas`, `practice_steps`,
`asana_benefits`, `asana_contraindications`, `mudras`, `bandhas`. What's actually migrated:
`asanas`, `tags`, `asana_steps`, `images` (empty shell — no `path` column). No models exist for
any of `Tag`, `AsanaStep`, `Image`. This gap is exactly what
[CONTENT_PIPELINE.md](CONTENT_PIPELINE.md) closes — read it before starting Phase 2 of the plan,
it has the migration/model/seeder code to write.

## Known bugs to fix (Plan Phase 1)

1. **`GalleryController::show()`** (`app/Http/Controllers/GalleryController.php:211`):
   ```php
   $id = $request->id;
   Log::info($id);
   $id = 1;   // <- delete this line, it discards the route param every time
   ```
   `routes/web.php:67` correctly passes `/showgallerycard/{id}`, but this line throws the value
   away, so every gallery card links to the same detail page.

2. **Mismatched image/description pairs** in `GalleryController::index()` — ids 5, 6, 9 (see
   [PROJECT_FINDINGS.md](PROJECT_FINDINGS.md) for the specifics). Fix these by replacing the
   array with the DB-backed version in Phase 2 rather than patching the literal in place.

3. **Unauthenticated write routes**: `routes/web.php:44-47` (`/get-asanas`, `/add-asanas`,
   `/update-asanas`, `/delete-asanas`) explicitly disable CSRF and have no auth middleware. There's
   also a duplicate `addAsanas()` in `GalleryController` that nothing calls (the commented-out
   route at `routes/web.php:85`). Remove the dead duplicate; for the live ones, either delete them
   before deploying or gate behind `Route::middleware('auth')` / an environment check.

4. `App\Models\YogaPost` and its migration reference (`create_yoga_posts_table.php` — mentioned in
   root README but doesn't actually exist in `database/migrations/`) appear to be leftover from an
   earlier design direction. Confirm with the owner whether to delete it or it's meant for a future
   feature; don't build against it without checking, it's currently orphaned.

## Refactor target for Phase 2

Four controllers (`GalleryController`, `SukshmaVyayamaController`, `SthulaVyayamaController`,
`ShowAsanaController`) each independently implement the same category/difficulty/search
`array_filter` pattern over a hardcoded list. Once `Asana::with(['steps','benefits',
'contraindications'])->get()` replaces the arrays, this filter logic collapses to one place —
either a shared trait, a query scope on the `Asana` model, or a small `AsanaRepository` — your
call on which, but don't leave it duplicated four times once it's touching real Eloquent queries.

## Deployment (Plan Phase 5)

`digitalocean_laravel_mysql_deployment.pdf` in the repo root is the primary runbook — follow it.
App-specific additions:

- Production `.env`: `APP_ENV=production`, `APP_DEBUG=false`, real `DB_PASSWORD`, `APP_URL` set to
  the live domain (currently `http://192.168.1.4:8000`, a LAN address — must change).
- `composer install --optimize-autoloader --no-dev`
- `npm run build` (Vite production build — check it actually gets invoked in whatever deploy
  script you write; nothing in the repo currently automates this)
- `php artisan migrate --force`, then run the Phase 2 seeder to populate content
- `php artisan storage:link`, `php artisan config:cache`, `php artisan route:cache`
- Confirm `resources/lang` files ship (they're plain PHP files, no build step needed, just don't
  get excluded by a deploy ignore-list)

## Things to leave alone unless the owner says otherwise

- The commented-out utility tool routes and nav links (CV generator, cover letter, currency
  converter, Nepali calendar) — see [README_PROJECT_OWNER.md](README_PROJECT_OWNER.md), this is a
  product decision, not a cleanup task to do unilaterally.
- `resources/views/components/asana-step-card.blade.php` and `pose-steps.blade.php` look like they
  may be two attempts at the same thing (both render an ordered step list with images) — worth a
  question to whoever wrote them before consolidating, in case one is mid-migration to the other.
