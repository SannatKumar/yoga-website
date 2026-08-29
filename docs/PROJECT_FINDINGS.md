# Codebase Findings — Yoga Practice Website

Audit date: 2026-07-20. This is a factual snapshot of what exists in the repo today, used as the
basis for [PROJECT_PLAN.md](PROJECT_PLAN.md) and the role-based READMEs in this folder.

## Stack (actual, not what the root README claims)

- Laravel 12, PHP ^8.2, Blade templates (no SPA/API-driven frontend).
- Tailwind v4 is installed (`vite.config.js`, `package.json`) but barely used — almost every
  view ships its own `<style>` block with hand-written CSS instead of Tailwind utility classes.
- DB: MySQL (`yoga_project` database, `.env` points at `127.0.0.1:3306`, root/root locally).
- No auth, no admin panel, no file upload UI yet, despite the root README listing these as
  "planned features" — still accurate as a gap, just not "in progress" anywhere in code.
- 3 locales wired up: `resources/lang/{en,fi,np}/messages.php`, a `SetLocale` middleware, and a
  language switcher in the header — this part is genuinely further along than the docs suggest.
- A `Visit` model + `TrackVisits` middleware already records visits/unique IPs and several
  controllers already display `Visit::count()` — analytics-lite is done, no need to add GA/Plausible
  urgently for a 70% milestone.

## Content is hardcoded, not database-driven

This is the central finding and the reason "only one description" exists for many asanas.

- Migrations exist for `asanas`, `tags`, `asana_steps`, and `images` — but:
  - There are **no Eloquent models** for `Tag`, `AsanaStep`, or `Image`.
  - The one model that touches the asanas table, `App\Models\Gallery`, is named after a page,
    not the data it holds (`protected $table = 'asanas'`) — confusing for anyone new to the code.
  - The `images` migration only defines `id()` and `timestamps()` — no `path`, no `asana_id`
    foreign key. The table exists but cannot store anything useful yet.
  - `create_table.sql` additionally documents `practice_steps`, `asana_benefits`,
    `asana_contraindications`, `mudras`, `bandhas` tables that were **never turned into Laravel
    migrations** — the SQL doc and the actual schema have drifted apart.
- Every content page (`GalleryController`, `SukshmaVyayamaController`, `ShowAsanaController`,
  `SthulaVyayamaController`, `MantraShlokaBhajanController`, `TeacherController`) defines its
  list of poses/items as a **PHP array literal inside the controller method**, not a query.
  Updating one asana's description means opening a controller file and editing an array — there
  is no single place to change content, which is exactly the pain point described.
- Some of those arrays contain literal placeholder text, not real content —
  e.g. `SukshmaVyayamaController::sukhsmaVyayama()` has entries like
  `'description' => 'griva-shakti-bikasaka-desc'`. Meanwhile `new_data.md` in the project root
  already has well-written, real steps for exactly this pose (Griva Shakti Vikasaka 1–3) — the
  good content exists, it's just sitting in a markdown file instead of being wired into the app.
- `data.md` similarly has solid real content (the five spinal movements, a full Tadasana writeup
  with benefits/contraindications) that never made it into any controller or view.

## Image ↔ description mismatches (the "fix image" issue)

`public/images/` and `public/images/yogasana_pictures/` actually contain a decent library of real
asana photos (Vajrasana, Padmasana, Virasana, Vrikshasana, Bhadrasana, Gomukhasana, Mandukasana,
Trikonasana, Uttanamandukasana, Yogamudrasana — many with front/back/left/right angle shots). The
problem isn't a lack of images, it's that the hardcoded arrays pair the wrong image with the wrong
name/description in several places:

- `GalleryController::index()` — id 9 is labeled **"Sun Salutation"** but points at
  `/images/Sarvangasana.jpeg` (Shoulderstand, a completely different pose).
- Same controller — id 6 is labeled **"Balasana"** but the description reads *"Traditional lotus
  meditation pose"* (that's Padmasana's description, copy-pasted) and the image is
  `/images/virasana.jpeg` (Hero pose, also not Balasana).
- Same controller — id 5 is labeled **"Halasana"** but described as *"Classic downward facing dog
  pose"* — that's Adho Mukha Svanasana's description.
- `GalleryController::show()` has a hard bug, not just a content mismatch: line
  `$id = 1;` **overwrites** `$id = $request->id;` right above it, so every gallery detail page
  shows the Sun Salutation card no matter which card the visitor clicked
  (`resources/views/gallery.blade.php` links to `/showgallerycard/{id}`, but the id is discarded).

These are the concrete "fix image in one of the files" items — see Phase 1 of the project plan.

## Duplicate / unauthenticated write endpoints

`routes/web.php` exposes `/get-asanas`, `/add-asanas`, `/update-asanas`, `/delete-asanas` via
`TestController`, all with CSRF verification explicitly disabled and no auth guard. There's a
second, near-identical `addAsanas()` method duplicated in `GalleryController`. `Issues_Documentation.md`
confirms these were added to make Postman testing easier during development. They must not go to
DigitalOcean as-is — anyone could POST/PUT/DELETE asana rows on the public internet.

## Scope creep beyond "yoga website"

The app also contains a CV generator, cover letter generator, currency converter, and Nepali
calendar (`CVGeneratorController`, `CoverLetterController`, `CurrencyConverterController`,
`NepaliCalendarController`), plus a `Customer` model/controller and Excel/XML import routes in
`routes/api.php` that look like they belong to an unrelated personal-tools project sharing this
codebase. All of their nav links are already commented out in `header.blade.php`, suggesting this
was a conscious "not for this launch" decision — worth confirming explicitly with the project
owner (see [README_PROJECT_OWNER.md](README_PROJECT_OWNER.md)) rather than leaving them live but
unlinked.

## What's genuinely in good shape

- Routing, middleware pipeline (locale + visit tracking), and the Blade layout/header/footer
  structure are consistent and working.
- `resources/views/components/` already has reusable Blade components
  (`asana-step-card`, `pose-steps`, `page-header`, `philosophy-card`, `guide-block`,
  `locale-switcher`) — the componentization work from `ToDoList.md` Week 2 is largely done.
- A real asset library of yoga pose photography already exists in `public/images/yogasana_pictures/`.
- `yogasana.json` already models a clean target schema (id, name, slug, description, category,
  difficulty, image, steps[]) — this is the right shape to standardize on, it just only has 2
  sample entries and needs benefits/contraindications fields added.
- Localization scaffolding (3 languages, middleware, switcher UI) is real, working infrastructure.
