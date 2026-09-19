# Project Plan — Path to 70% and DigitalOcean Launch

> **Superseded — written 2026-07-20, describes an early plan.** Most of what's below has since
> happened or changed shape. For current status and next steps, read
> [RESUME_HERE.md](RESUME_HERE.md), [PROJECT_PROGRESS.md](PROJECT_PROGRESS.md), and
> [DEPLOYMENT_TODO.md](DEPLOYMENT_TODO.md) instead. Kept here as historical record.

Builds on [PROJECT_FINDINGS.md](PROJECT_FINDINGS.md). Read that first if you haven't — every task
below points back to a specific finding.

## What "70% complete" means for this launch

Not 70% of some abstract feature list — a concrete bar visitors will actually judge:

1. Every asana that has a photo in `public/images/` has **real, correct, non-placeholder** content:
   name, category, difficulty, one correctly-matched image, a description, ordered practice steps,
   benefits, and contraindications.
2. Content lives in the **database**, not in scattered PHP array literals — so updating a
   description is a data edit, not a code change.
3. The known bugs in [PROJECT_FINDINGS.md](PROJECT_FINDINGS.md) (wrong image/description pairs,
   the `show()` id bug, the unauthenticated write routes) are fixed.
4. The site is reachable at a public URL on DigitalOcean over HTTPS, with the production `.env`
   pointed at a real (not root/root) database.
5. Auth, admin CRUD UI, file uploads, and the non-yoga utility tools are explicitly **out of scope**
   for this milestone — they're the remaining 30%, not blockers.

## Phase 1 — Fix known bugs (0.5–1 day)

- `GalleryController::show()`: delete the hardcoded `$id = 1;` line so the route param is actually
  used (`routes/web.php:67`, `/showgallerycard/{id}`).
- Correct the three mismatched gallery entries (Sun Salutation/Sarvangasana, Balasana/Padmasana
  description, Halasana/Adho-Mukha-Svanasana description) — this is fixed properly as part of
  Phase 2's data migration, not patched in place, since the array is being replaced anyway.
- Remove or auth-gate `/get-asanas`, `/add-asanas`, `/update-asanas`, `/delete-asanas` and the
  duplicate `GalleryController::addAsanas()`. If Postman testing is still needed, restrict with
  `APP_ENV=local` checks or a signed token, not a public unauthenticated route.
- Decide and act on the unrelated utility controllers (CV generator, cover letter, currency
  converter, Nepali calendar, Customer/Excel-XML routes): keep them on unlinked routes, move them
  to a separate app, or remove — see the owner README for the decision this needs.

## Phase 2 — Make content data-driven (2–4 days, the core of this plan)

This is "how to quickly update the descriptions and steps for all the asanas," made concrete.
Full mechanics in [CONTENT_PIPELINE.md](CONTENT_PIPELINE.md); summary here:

1. Add the missing migrations so the schema matches what content actually needs:
   `asana_benefits`, `asana_contraindications` (already designed in `create_table.sql`, just not
   migrated), and fix `images` to have `path` + `asana_id` instead of being an empty shell.
2. Add Eloquent models: `Asana` (rename/replace the misleadingly-named `Gallery` model),
   `AsanaStep`, `Tag`, `AsanaBenefit`, `AsanaContraindication`, `Image`, with the obvious
   `hasMany`/`belongsTo` relationships.
3. Build **one** master content file (`database/data/asanas.json`, extending the schema already
   started in `yogasana.json`) covering every asana that has a photo in
   `public/images/yogasana_pictures/` (Vajrasana, Padmasana, Virasana, Vrikshasana, Bhadrasana,
   Gomukhasana, Mandukasana, Trikonasana, Uttanamandukasana, Yogamudrasana, plus the standalone
   images: Tadasana, Halasana, Matsyasana, Sarvangasana, Vajroli, Vipareetakarani, duipadahastasana).
   Pull real text from `data.md` and `new_data.md` where it already exists (Tadasana, Griva Shakti
   Vikasaka 1–3) instead of rewriting from scratch.
4. Write a seeder that reads that JSON and populates the tables. Re-running the seeder becomes
   the "update all descriptions" workflow — no PHP/Blade edits needed for a content change.
5. Refactor `GalleryController`, `ShowAsanaController`, `SukshmaVyayamaController`,
   `SthulaVyayamaController` to query the `Asana` model instead of hardcoded arrays. This also
   deletes the duplicated filter-by-category/difficulty/search logic currently copy-pasted across
   four controllers.

## Phase 3 — Content authoring & yoga-accuracy pass (parallel with Phase 2, 2–5 days depending on asana count)

- A practitioner (or the project owner wearing that hat) fills in the JSON from step 3 above:
  correct Sanskrit name, category, difficulty, steps with breath cues, benefits,
  contraindications. Use the Tadasana entry in `data.md` as the quality bar — it already has the
  right structure (steps → benefits → contraindications).
- See [README_YOGA_PRACTITIONER.md](README_YOGA_PRACTITIONER.md) for the review checklist and the
  specific content gaps found.
- Contraindications are the highest-priority gap — most current entries have none at all, which
  matters for visitor safety/liability once this is public.

## Phase 4 — Polish (1–2 days)

- Replace remaining hardcoded English strings with `__('messages.key')` (partially done already;
  `ToDoList.md` Week 1 tracked this).
- Basic SEO metadata (title/description/OG tags) on the asana and gallery pages.
- Sanity-check mobile layout on the pages touched in Phase 2 (the inline per-view `<style>` blocks
  already have breakpoints copy-pasted across files — verify they didn't drift).

## Phase 5 — DigitalOcean deployment (0.5–1 day, mostly following the existing PDF guide)

`digitalocean_laravel_mysql_deployment.pdf` is already in the repo root — use it as the primary
runbook. Checklist to layer on top of it for this app specifically:

- Choose Droplet (full control, cheapest for a low-traffic site) vs. App Platform (less ops, a bit
  more expensive) — see the owner README for the tradeoff framing.
- Provision MySQL (managed DB or same-Droplet MySQL) and update `.env`: real `DB_PASSWORD`
  (not `root`), `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL` set to the real domain.
- `composer install --optimize-autoloader --no-dev`, `npm run build`, `php artisan migrate --force`,
  then run the Phase 2 seeder once to populate content.
- `php artisan storage:link`, `php artisan config:cache`, `php artisan route:cache`.
- HTTPS via Let's Encrypt/Certbot if on a Droplet.
- Point DNS, smoke-test every route in `routes/web.php` on the live URL before calling it done.

## Sequencing at a glance

```
Phase 1 (bugs)  ──┐
                  ├─▶ Phase 2 (data-driven content) ──▶ Phase 4 (polish) ──▶ Phase 5 (DO deploy)
Phase 3 (content authoring, runs alongside Phase 2) ──┘
```

Phase 2 and 3 are the long poles and should start the same day — Phase 3 (writing real
descriptions/steps/benefits) doesn't need Phase 2's code to be finished, it just needs the JSON
schema agreed, which Phase 2 defines on day one.

## Open decisions that need the project owner, not more code archaeology

1. Keep, hide, or delete the non-yoga utility tools before launch?
2. Droplet vs. App Platform for hosting?
3. How many asanas must have full content to call this "70%" — all ~17 with existing photos, or a
   smaller launch set with the rest following post-launch?

See [README_PROJECT_OWNER.md](README_PROJECT_OWNER.md) and
[README_PROJECT_MANAGER.md](README_PROJECT_MANAGER.md) for how these decisions should be framed
and tracked.
