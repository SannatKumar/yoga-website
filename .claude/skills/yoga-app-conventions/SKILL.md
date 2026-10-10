---
name: yoga-app-conventions
description: Project-specific conventions for this Laravel yoga-practice app — database/migration rules, controller/model naming, route naming, Blade/CSS structure, variable naming, and the lint commands to run before calling anything done. Use this whenever writing, reviewing, or refactoring code anywhere in this repository (yoga-app).
---

# Yoga App Conventions

Condensed, actionable version of `docs/CONVENTIONS_DATABASE.md`, `CONVENTIONS_FUNCTIONS.md`,
`CONVENTIONS_ROUTES.md`, `CONVENTIONS_FRONTEND.md`, `CONVENTIONS_VARIABLES.md`, and
`CONVENTIONS_CSS.md` — read those for the full reasoning and evidence; this file is the checklist
to actually work from. Also read `docs/RESUME_HERE.md` for current project status before starting
work in a new session.

## Before you write any code

1. Read `docs/RESUME_HERE.md` for current status and open items.
2. Check `docs/DEPLOYMENT_TODO.md` for known open issues — don't re-fix something already listed
   as done, and don't duplicate an item already tracked as open.

## Database

- Migration filenames: `YYYY_MM_DD_HHMMSS_snake_case_description.php` (standard Laravel).
  Schema migrations: `create_x_table` / `add_x_to_y_table` / `remove_x_from_y_table`.
  Data-only migrations: `seed_<what>`.
- **A migration either changes schema OR seeds data — never both.** Data-only migrations (no
  `Schema::` calls) must say so in their docblock: `"Data-only migration (no schema change): ..."`.
- **Never edit an already-run migration.** Write a new migration instead, even for a one-line fix
  or a single extra row — see `2026_09_19_171000_seed_bhujanga_asana_image.php` for the pattern
  (a follow-up migration correcting an earlier one, not editing it).
- Every migration needs a real, targeted `down()` — not a blanket truncate.
- Test the largest/riskiest string values first in a multi-insert migration — a failed statement
  does not roll back earlier inserts already committed in that same `up()` call on this MySQL setup.
- Table names: plural snake_case. Pivot tables: `{owner}_{owned}` singular (`asana_tag`).
  (`time_of_the_day` is a historical irregular — don't copy it, don't rename it.)
- Columns: snake_case. Booleans: `is_` prefix (`is_primary`). New orderable child table: use
  `sort_order` (integer, ascending). Freeform content columns: `text()`, not a capped `string()`.
- Foreign keys: `{singular}_id` (`difficulty_id` is an established short form) — **except** every asana-child table uses
  `asanas_id` (plural stem), an established exception from the very first migration. Match it on
  any new asana-child table; don't "fix" it to `asana_id` on just the new one.
- New content type that's structurally "name + steps + benefits + contraindications"? Add it to
  `asanas` via `practice_type_id`, don't build a parallel schema. Structurally different (like
  Surya Namaskara, a sequence referencing other postures)? Give it its own tables.
- Real FK constraints (`foreign()->references()`), not just app-level convention.
- No repeatable seeder pipeline exists yet — content batches go in as one-off data-only migrations
  with the content hand-written into a PHP array. Don't add yoga content to
  `database/seeders/DatabaseSeeder.php`.

## Controllers & functions

- New listing page → `index()`. New single-item detail page → `show($id)` (or the closest
  existing analog, `getAsanaWithDetails`, if extending that specific detail flow). A single
  rendered page that isn't a plain resource `show` → `get{Noun}()` (`getGuide`, `getTeacher`).
  Don't copy the older thing-named style (`SukhsmaVyayamaController::sukhsmaVyayama()`) and don't
  rename it either.
- New API/write endpoint meant for direct URL/Postman use (not a rendered page) →
  `{verb}{Noun}()`: `getAsanas`, `addAsanas`, `updateAsanas`, `deleteAsanas`-style, matching
  `TestController`. Don't mix this with plain Laravel resource verbs on the same controller.
- `GalleryController::addAsanas()` and `TestController::addAsanas()` are a known duplicate — don't
  add a third copy; see `DEPLOYMENT_TODO.md` item 3.
- Model relationships: **singular method name (`asana()`) = `belongsTo`; plural (`asanas()`) =
  `hasMany`/`belongsToMany`.** This mapping is exact and load-bearing — keep it on every new
  relationship, not just asana ones.
- Put ordering (`->orderBy(...)`) on the relationship definition itself, not in the
  controller/view.
- PHP methods/variables: camelCase. Pull request input into a camelCase local at the top of the
  method (`$asanaName = $request->asana_name;`) rather than reading `$request->...` inline.
  (`$timeOftheDayId` in the `addAsanas()` methods is a known typo — don't copy it into new code.)
- Array keys that mirror a DB row or feed a view: snake_case, matching
  the column name unless it's a deliberately generic UI term (`title` instead of `asana_name`).
  Never camelCase an array key that exists to mirror a raw DB row. Follow the `$pose` array in
  `GalleryController::getAsanaWithDetails()` as the reference shape.
- Model `$fillable`/properties: literal snake_case column names. No `$appends` or
  `get*Attribute()` renaming. Friendlier names belong in the controller's view array.
- Blade variables: exactly what the controller passed, no renaming in the view. Keep
  singular/plural deliberate (`$categories` = list, `$category` = selected value).

## Routes

- Paths: kebab-case, no camelCase or underscores. Params: `{id}` (numeric PK); no slugs yet.
  One URL, one name; don't add alias names.
- Controller references: `[ControllerClass::class, 'method']`, never `'Controller@method'`. Add a
  new controller's `use` line near its route block, don't re-sort the import list.
- Route `name()` should match the kebab-case path with `{params}` dropped
  (`/tibetan-rites` → `'tibetan-rites'`). A few older routes (`teacher-profile`,
  `mantra-shloka-bhajan`, `mantra-shloka-bhajan-content`) are intentional exceptions predating this
  rule — don't "fix" those, but do follow the rule for anything new.
- **Before adding any `route('some-name')` call in a Blade file or controller, confirm that name
  is actually defined in `routes/web.php`.** A mismatch here is a real, previously-shipped bug
  class (`RouteNotFoundException` at runtime) — `php scripts/lint-conventions.php` checks this
  automatically now.
- User-facing page routes go inside the shared `[SetLocale, SetDefaultLocaleForUrls,
  TrackVisits]` middleware group.
- A new write endpoint should NOT be added to the unauthenticated `withoutMiddleware([...
  VerifyCsrfToken])` list at the top of `routes/web.php` — that list is a known, tracked security
  gap (`DEPLOYMENT_TODO.md` item 1), not a pattern to extend. Put new write endpoints behind real
  auth from the start.
- A no-logic static page → `Route::view('/path', 'view-name')->name(...)`, not a controller.
- Disabling a route without deleting it (e.g. a feature parked for later)? Comment out the route
  line *and* its now-unused controller `use` import, with a short comment saying why — see the
  non-yoga utility tools block in `routes/web.php` for the pattern.

## Frontend (Blade / CSS)

Two coexisting page styles — pick one per page, don't mix on the same page:

- **Tailwind utility-class pages** (listing/grid pages): `gallery.blade.php`,
  `sukhsma-vyayama.blade.php`, `sthula-vyayama.blade.php`, `tibetan-rites.blade.php`. Utility
  classes inline, no `<style>` block. Copy `tibetan-rites.blade.php`'s structure for a new one.
- **Hand-rolled `<style>`-block pages** (detail/single-purpose pages): `gallery-detail.blade.php`,
  `surya-namaskara.blade.php`, `show-asana.blade.php`, `yoga-nidra.blade.php`. `<style>` block at
  the bottom of the same file, kebab-case class names, the green/red/blue semantic palette
  (`#25c55d`/`#e74c3c`/`#3498db`) for benefits/warnings/metadata blocks, `border-radius: 12px`
  content blocks / `20px` pills, `object-fit: cover` for any photo in a fixed box.
- Every page: `@extends('layouts.app')` + `@section('content') ... @endsection`; don't create a
  second layout.
- Pages built on the `part-N-div` scaffold (`show-asana`, `gallery-detail`): fill the existing empty
  `part-N-div` that fits instead of adding divs outside the sequence.
- Tailwind pages: plain utilities only. No `@apply`, no custom component layer, no `dark:`
  variants (light theme only), default `sm:/md:/lg:` breakpoints.
- `<style>`-block pages: the block goes after `@endsection` in the same file (no per-page .css file).
  Use specific class names (`.asana-thumb`, not `.thumb`) since nothing scopes them. Use colored
  `1px solid` borders, not box-shadows. Use light tints `#e6f7ed`/`#fff3f3`/`#eff6ff` with the
  palette. `@media` breakpoints are `575.98px`/`767.98px`/`991.98px`/`1199.98px`. CSS class names
  never double as PHP variable names.
- Every top-level page opens with `<x-page-header>`. Reusable prop-driven fragments use `@props`
  + `<x-component-name>`, with sane defaults for every prop (new props on existing components
  too). Use `@include('components.x')` only to stay consistent with an existing caller.
- Every asana photo falls back to **`/lotus-images/blank_image.jpg`** when missing — never to a
  specific real pose's photo file. (This exact bug shipped twice already — an asana with no image
  of its own silently showing a different, real asana's photo. Don't reintroduce it.)
- **The asana's photo appears in exactly one place on the detail page** — beside the steps, inside
  `<x-asana-step-card>`'s image side. An attempt to also show it beside the top description was
  tried and reverted (it read as a duplicated image) — that block stays commented out in
  `gallery-detail.blade.php`; don't re-enable it without a different image or a real design reason.
- All user-facing copy through `__('messages.key')` with a literal fallback: `{{
  __('messages.key') ?? 'Fallback' }}`. Keys are kebab-case (`'tibetan-rites-desc'`), defined in
  `resources/lang/en/messages.php` and its per-locale siblings.

## Before calling anything "done"

Run both linters — neither is optional for anything more than a one-line text tweak:

```bash
composer lint              # Pint style check (--test, doesn't modify files) + conventions linter
composer lint:fix          # Pint auto-fix
composer lint:conventions  # Just the project-specific conventions script
```

`scripts/lint-conventions.php` checks things Pint/PHPStan can't know about: route name/path
consistency, every `route('x')` call actually resolving, the `asana()`/`asanas()` singular/plural
relationship rule, migration filename/docblock conventions, the real-photo-as-fallback
anti-pattern, and a couple of known open cleanup items. It exits non-zero only on real ERROR-level
findings; WARN-level findings are informational and point at the relevant `DEPLOYMENT_TODO.md`
item. Full detail on what each check does and why: see the docblock at the top of the script
itself, and `docs/CONVENTIONS_*.md` for the reasoning behind each rule.

Also verify by actually rendering the page(s) you touched — this project's established workflow is
`php artisan view:clear` then `php artisan tinker --execute="..."` to instantiate the controller
and `->render()` the view directly, rather than assuming a Blade change works from reading it.
