# Asana Schema — Categories, Difficulty, Time of Day, Tags, Source, Reference, Benefits, Contraindications, Images

Written 2026-08-29, updated same day with a follow-up (benefits,
contraindications, images). Follows on from
[ADD_ASANA_STEPS_FEATURE.md](ADD_ASANA_STEPS_FEATURE.md), which split
`asana_steps` out of `asanas` so a pose could have many ordered steps
instead of a single `steps_id` int. This change applies the same fix to the
other loosely-typed `*_id` columns on `asanas`, and gives them real tables
and real foreign keys.

## Why

The original `asanas` table (`database/migrations/2025_10_07_084635_create_asanas_table.php`)
had six plain, unconstrained integer columns: `source_id`, `steps_id`,
`category_id`, `tag_id`, `time_of_the_day_id`, `reference_id`. None of them
pointed at an actual table — in the real data every one of them is just `1`
(a placeholder), and the only place category-like information actually lived
was as free text in `asana_description` ("Standing Asana", "Sitting Asana").
`steps_id` had already been shown to be the wrong shape (an asana has *many*
steps, not one) and was replaced with `asana_steps.asanas_id`. This change:

1. Gives `category_id`, `source_id`, `time_of_the_day_id`, `reference_id` real
   lookup tables and real FK constraints.
2. Adds a new `difficulty_id` column + `difficulty_levels` table — a distinct
   axis from category (see below).
3. Replaces `tag_id` with a many-to-many `asana_tag` pivot table, for the
   same reason `steps_id` was replaced: `GalleryController::index()`'s
   hardcoded sample data gives every asana **multiple** tags
   (`['spinal strength', 'Robust digestion', 'energizing']`), which a single
   `tag_id` column can never represent.
4. Drops `steps_id` and `tag_id` from `asanas` now that both are superseded.

### Category vs. difficulty — why two tables, not one

You mentioned category should cover things like "hard, beginner" — but the
existing real data uses `category_id` alongside a description field that
already holds posture-type text ("Standing Asana" / "Sitting Asana"), while
`GalleryController::index()`'s sample data has **both** a `category` field
(Meditation / Hatha / Vinyasa / Restorative) and a separate `difficulty`
field (Beginner / Intermediate / Advanced / All Levels) on the same record.
Those are two independent dimensions — a pose's difficulty doesn't imply its
posture type or vice versa — so mixing "Beginner" and "Standing Asana" into
one `categories` table would let you tag a pose as literally both,
ambiguously, in the same column. This design keeps them as two lookup
tables (`categories` and the new `difficulty_levels`) and two FK columns on
`asanas`. If you actually want `category_id` to mean difficulty only,
say so and I'll swap `categories`' seed data for the difficulty values and
drop `difficulty_levels` instead — flagging this in case my read of your
intent is wrong.

## New tables

| Table | Purpose | Key columns |
|---|---|---|
| `categories` | Posture type of an asana | `id`, `category_name`, `category_description` |
| `difficulty_levels` | Skill level required | `id`, `level_name`, `sort_order` |
| `time_of_the_day` | Best time to practice | `id`, `time_name`, `time_description` |
| `sources` | Where the asana content came from | `id`, `source_name`, `source_url`, `source_description` |
| `asana_references` | Citation/reference link for the content | `id`, `reference_title`, `reference_url`, `reference_description` |
| `tags` | Free-form descriptors (already existed, was missing FK/pivot) | `id`, `tag_name`, `tag_description` |
| `asana_tag` | Pivot: many tags per asana, many asanas per tag | `id`, `asanas_id` → `asanas.id`, `tag_id` → `tags.id` (unique pair) |

`asana_references` (not `references`) because `REFERENCES` is a reserved SQL
keyword.

## `asanas` table — before and after

| Column | Before | After |
|---|---|---|
| `source_id` | plain `integer`, no FK | `unsignedBigInteger`, FK → `sources.id` |
| `steps_id` | plain `integer`, no FK | **dropped** — use `asana_steps.asanas_id` |
| `category_id` | plain `integer`, no FK | `unsignedBigInteger`, FK → `categories.id` |
| `tag_id` | plain `integer`, no FK | **dropped** — use `asana_tag` pivot |
| `difficulty_id` | *(did not exist)* | new `unsignedBigInteger`, FK → `difficulty_levels.id` |
| `time_of_the_day_id` | plain `integer`, no FK | `unsignedBigInteger`, FK → `time_of_the_day.id` |
| `reference_id` | plain `integer`, no FK | `unsignedBigInteger`, FK → `asana_references.id` |

## Migrations added (run in this order)

1. `2026_08_29_120000_create_categories_table.php` — seeds 7 posture types (Standing, Sitting, Supine, Prone, Balancing, Inverted, Twisting Asana), `id 1`/`2` matching the posture types already implied by real `asana_description` text.
2. `2026_08_29_120001_create_difficulty_levels_table.php` — seeds Beginner/Intermediate/Advanced/All Levels.
3. `2026_08_29_120002_create_time_of_the_day_table.php` — seeds Morning/Afternoon/Evening/Anytime.
4. `2026_08_29_120003_create_sources_table.php` — seeds one placeholder row (`id 1`) so existing `source_id = 1` data stays valid once the FK is added.
5. `2026_08_29_120004_create_asana_references_table.php` — same placeholder pattern for `reference_id`.
6. `2026_08_29_120005_create_asana_tag_table.php` — pivot table, `unique(asanas_id, tag_id)`, cascade delete.
7. `2026_08_29_120006_add_difficulty_id_to_asanas_table.php` — adds the new FK column.
8. `2026_08_29_120007_remove_steps_id_and_tag_id_from_asanas_table.php` — drops the two superseded columns.
9. `2026_08_29_120008_add_foreign_keys_to_asanas_table.php` — converts `category_id`/`source_id`/`time_of_the_day_id`/`reference_id` to `unsignedBigInteger` and adds real FK constraints (they had to match the referenced tables' `id` type before a constraint could be added).

All 9 have been run (`php artisan migrate`) against the `yoga_project` database.

### Pre-existing issue found and fixed along the way

The `tags` table's migration (`2025_10_22_151625_create_tags_table.php`) was
marked as "Ran" in the `migrations` table, but the table itself did not
actually exist in the database (it had been dropped or never survived a
prior migration run, outside of this change). This broke the `asana_tag`
FK on first attempt. It's been repaired by recreating `tags` with the exact
schema its migration defines, before `asana_tag` was created — no
migration files were changed to do this, so `migrate:status` stays
consistent. Worth knowing if you see other `*_id` columns pointing at
tables that seem to be missing.

## Models added/updated

- **New**: `Category`, `DifficultyLevel`, `TimeOfTheDay`, `Source`, `AsanaReference`, `Tag` — each a thin model with `$table`, `$fillable`, and a `hasMany`/`belongsToMany` back to `Gallery` (the `asanas` model).
- **Updated `Gallery`** (`app/Models/Gallery.php`): `$fillable` now excludes `steps_id`/`tag_id` and includes `difficulty_id`; added relationships — `steps()`, `tags()`, `category()`, `difficultyLevel()`, `timeOfTheDay()`, `source()`, `reference()`.
- **Updated `AsanaStep`**: added `asana()` (`belongsTo(Gallery::class, 'asanas_id')`).

## Controllers fixed to match the new columns

Dropping `steps_id`/`tag_id` and adding `difficulty_id` left three existing
methods out of sync with the real table — `GalleryController::addAsanas`,
`TestController::addAsanas`, and `TestController::updateAsanas` all still
read/wrote `steps_id`/`tag_id`. Mass assignment silently drops unknown keys
(no `preventSilentlyDiscardingAttributes()` is enabled in this app), so
none of these would have thrown — they'd have just quietly ignored those
two fields forever. Updated all three to drop `steps_id`/`tag_id` and read
`category_id`/`difficulty_id` from the request instead, so creating/updating
an asana can now actually set its category and difficulty.

## Follow-up (same day): Benefits, Contraindications, and Images

You asked where "Benefits" and "Contraindications" (both visible per-pose in
`GalleryController::show()`'s hardcoded sample data, as arrays — e.g.
`'benefits' => ['Improves flexibility and strength', 'Boosts cardiovascular
health', ...]`) should live, and to fix the `images` table, which had been
created with no real columns at all (`id` + timestamps only).

### Why new tables, not columns on `asanas`

Same reasoning as `asana_steps` and `asana_tag`: the sample data shows
**multiple** benefits and **multiple** contraindications per asana, so
neither can be a single column on `asanas` — each gets its own one-to-many
table, keyed by `asanas_id`, same shape as `asana_steps`.

| Table | Purpose | Key columns |
|---|---|---|
| `asana_benefits` | Ordered list of benefits per asana | `id`, `asanas_id` → `asanas.id`, `benefit`, `sort_order` |
| `asana_contraindications` | Ordered list of "avoid if..." per asana | `id`, `asanas_id` → `asanas.id`, `contraindication`, `sort_order` |

Both use `foreignId('asanas_id')->constrained('asanas')->cascadeOnDelete()`
— a real FK with cascade delete, so removing an asana cleans up its
benefits/contraindications automatically (unlike `asana_steps`, which used
a plain unconstrained integer; worth tightening `asana_steps` to match at
some point, but that wasn't asked for here).

### Images — fixed to store file references, not blobs

Since files live on disk under `public/images/...` (confirmed from what's
already in the repo, e.g. `public/images/yogasana_pictures/vajrasana_front_side.jpg`),
`images` only needs to store *where* the file is and some metadata, not the
file itself. New columns added:

| Column | Type | Purpose |
|---|---|---|
| `asanas_id` | `unsignedBigInteger`, nullable, FK → `asanas.id`, cascade delete | which asana this image belongs to (nullable so the table can still hold non-asana site images later) |
| `image_path` | `string(255)` | path relative to `public/`, e.g. `images/yogasana_pictures/vajrasana_front_side.jpg` |
| `image_name` | `string(150)` | human-readable title |
| `alt_text` | `string(255)`, nullable | accessibility text |
| `is_primary` | `boolean`, default `false` | marks the main/cover image when an asana has several |
| `sort_order` | `integer`, nullable | display order among an asana's images |
| `mime_type` | `string(50)`, nullable | e.g. `image/jpeg` |
| `file_size` | `unsignedInteger`, nullable | bytes, if you want to track it |

**This was done as a new migration (`add_columns_to_images_table`), not by
editing the original `create_images_table` migration** — that migration
already ran, and editing an already-applied migration file leaves
`migrate:status` reporting something that doesn't match what actually
happened in the database. If you'd rather squash the two into one clean
`create_images_table`, that's a call for you to make (it'd mean resetting
that table), not something to do silently.

### Migrations added (run in this order)

10. `2026_08_29_130000_create_asana_benefits_table.php`
11. `2026_08_29_130001_create_asana_contraindications_table.php`
12. `2026_08_29_130002_add_columns_to_images_table.php`

All three have been run.

### Dummy data inserted

Using real existing asanas (Tadasana `id 1`, Padahastasana `id 2`, Vajrasana `id 8`):

- 3 benefits for Tadasana, 3 for Padahastasana (`asana_benefits`).
- 2 contraindications for Tadasana, 3 for Padahastasana (`asana_contraindications`).
- 1 primary image each for Tadasana, Padahastasana, and Vajrasana, pointing
  at files that already exist in `public/images/` (`tadasana.jpeg`,
  `duipadahastasana.jpeg`, `yogasana_pictures/vajrasana_front_side.jpg`).

### Models added

- `AsanaBenefit` (`asana_benefits`), `AsanaContraindication`
  (`asana_contraindications`), `Image` (`images`) — each with `belongsTo(Gallery::class, 'asanas_id')`.
- `Gallery` gained `benefits()`, `contraindications()`, and `images()`
  (`hasMany`, ordered by `sort_order`).

## Not done (flagging, not deciding for you)

- No controller endpoints or routes were added for any of the new tables
  (no `addCategory`, `addTag`, `addAsanaTags`, `addAsanaBenefits`,
  `addAsanaContraindications`, `addImage`, etc.) — every change in this doc
  was scoped to schema only. The pivots/one-to-manys can be populated today
  via Tinker (e.g. `Gallery::find($id)->tags()->attach($tagId)`,
  `AsanaBenefit::create([...])`), or I can build endpoints next, mirroring
  `addAsanaSteps`.
- Existing `asanas` rows all have `category_id = 1`/`source_id = 1`/
  `time_of_the_day_id = 1`/`reference_id = 1` (placeholder values from
  before). The new lookup tables' `id 1` rows were chosen so those existing
  rows stay valid, but the actual real category/source/time-of-day per pose
  hasn't been re-entered — that's a data cleanup task, not a schema one.
- `asana_description` still holds free-text posture type ("Standing Asana",
  etc.) even though `categories` now covers the same concept properly — the
  column wasn't touched, so nothing reads/writes from `categories` yet
  automatically.
- Only 3 of the 42 real asanas have a dummy image row; the rest have none
  yet — `image_path`/`image_name` need populating per asana as real photos
  get assigned.
- No actual file upload handling exists yet (the `images` table now has
  somewhere to point, but nothing writes to `public/images/` or validates
  uploaded files) — that'd be a controller/route addition, not schema.