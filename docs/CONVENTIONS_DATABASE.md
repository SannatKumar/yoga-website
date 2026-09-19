# Database Conventions

Written 2026-09-19. Describes the conventions actually followed while building this schema
(inferred from `database/migrations/` and `app/Models/` as they exist today), so future work
stays consistent. This is a description of practice, not a prescriptive style guide imposed from
outside — where the codebase is inconsistent, that's called out rather than glossed over.

## Migration files

- **Timestamp prefix, descriptive snake_case name**: `2026_08_29_130000_create_asana_benefits_table.php`.
  Laravel's default `php artisan make:migration` naming — nothing custom here.
- **One migration = one purpose.** A migration either creates/alters schema, or seeds data — not
  both. Schema migrations are named `create_x_table` / `add_x_to_y_table` / `remove_x_from_y_table`.
  Data-only migrations (no `Schema::` calls, only `DB::table(...)->insert()`) are named
  `seed_<what>` — e.g. `seed_tags_for_demo_asanas.php`, `seed_real_asana_content_from_notes.php`.
  Every data-only migration in this repo says so in its own docblock (`"Data-only migration (no
  schema change): ..."`) — keep doing that; it's the fastest way for a reader to know whether a
  migration is safe to re-run conceptually or whether it changes the table shape.
- **Never edit an already-run migration.** If `migrate:status` shows a migration as "Ran," don't
  go back and change its `up()`/`down()` — write a new migration instead, even for something as
  small as widening one column (see `2026_09_19_155900_widen_asana_steps_column.php`) or adding
  one row that was wrongly excluded (see `2026_09_19_171000_seed_bhujanga_asana_image.php`,
  which corrects a call made in `2026_09_19_170000_...` rather than editing that file). This keeps
  `migrate:status` an honest, replayable history — anyone running `php artisan migrate` from
  scratch gets the exact same end state as production, in the exact order it was actually built.
- **Every migration has a real `down()`.** Even data-only ones — `DB::table(...)->where(...)->
  delete()` targeting exactly the rows that `up()` inserted (by id or by a `whereIn` on the ids
  touched), not a blanket truncate.
- **A failed multi-insert migration does not roll back already-executed statements** in this
  MySQL setup — a lesson learned the hard way once (see `UNIFIED_PRACTICE_SCHEMA.md`). If a data
  migration inserts many rows in one script and a later row fails (e.g. a column too narrow for
  one particular string), the earlier inserts in that same `up()` call are already committed and
  need manual cleanup before re-running. Test the longest/riskiest values first, or use `text()`
  instead of a capped `string()` for any freeform content column.

## Table naming

- **Plural, snake_case**: `asanas`, `categories`, `difficulty_levels`, `asana_benefits`.
- **Pivot tables**: `{singular_a}_{singular_b}` in alphabetical-ish/logical reading order —
  `asana_tag` (not `tag_asana` or `asanas_tags`). One pivot table exists so far; keep the same
  `{owner}_{owned}` singular pattern if more are added.
- **Lookup/reference tables** (`categories`, `difficulty_levels`, `time_of_the_day`, `sources`,
  `practice_types`) are small, mostly-static tables that a main row points *at* via a foreign key
  — not lookup-by-string. `time_of_the_day` is the one irregular plural in the set (should
  arguably be `times_of_the_day`, but it was named once and every FK/relationship references it
  consistently, so it was left alone rather than churned for cosmetics).

## Column naming

- **snake_case**, e.g. `asana_name`, `asana_description`, `is_primary`, `sort_order`.
- **Foreign keys**: almost always `{singular_table}_id` — `category_id`, `difficulty_id` (short
  for `difficulty_level_id`, an established exception), `source_id`, `reference_id`,
  `time_of_the_day_id`, `practice_type_id`.
- **One deliberate, load-bearing exception**: every child table that belongs to an asana
  (`asana_steps`, `asana_benefits`, `asana_contraindications`, `images`, `surya_namaskara_steps`)
  uses `asanas_id` (plural stem) rather than `asana_id`. This was set by the very first migration
  in the project and every later table matched it for consistency — it reads a little oddly next
  to `category_id`/`difficulty_id`, but changing it now would mean touching every child table,
  every model's `belongsTo(Asana::class, 'asanas_id')` call, and every insert across ~15
  migrations. **Match the existing `asanas_id` spelling on any new asana-child table — don't
  "fix" it to `asana_id` on just the new table, which would make it inconsistent with the rest.**
- **Booleans**: `is_` prefix (`is_primary`).
- **Ordering columns**: `sort_order` (images) / `steps_order_number` (asana_steps) / `step_order`
  (surya_namaskara_steps) — not fully consistent in name across tables (see "Known
  inconsistencies" below), but always an integer, always ascending, always what the model's
  relationship orders by.

## Relationships & the "practice type" pattern

- `asanas.practice_type_id` is a discriminator column: Sukshma Vyayama, Sthula Vyayama, Tibetan
  Rites, and plain Asana rows all live in the same `asanas` table, distinguished by this FK to
  `practice_types`, rather than four near-identical copies of the steps/benefits/
  contraindications/images schema. Use this pattern again for a new practice type that is
  *structurally* identical to an asana (name + ordered steps + benefits + contraindications).
- Don't use this pattern for something structurally different. Surya Namaskara is a *sequence*
  that references other postures rather than owning its own steps, so it got its own
  `surya_namaskara` + 3 child tables instead of a 5th `practice_type_id` value. If a future
  practice type doesn't fit the "name + steps + benefits + contraindications" shape, it probably
  deserves its own tables the same way.
- Real foreign-key constraints are used throughout (added retroactively for `asanas` via
  `2026_08_29_120008_add_foreign_keys_to_asanas_table.php` after the lookup tables existed) — not
  just app-level convention. New relationships should get an actual `foreign()->references()` too.

## Seeding / data population

- There is **no repeatable seeder pipeline yet** — every content batch so far (demo tags, the 29
  asanas transcribed from `D:\Yoga_Asanas`, the 36 Sukshma/Sthula/Tibetan/Surya postures, images)
  was inserted via a one-off data-only migration with the content hand-written into a PHP array
  in that file. This is documented as a known gap in `CONTENT_PIPELINE.md` (a JSON → seeder
  approach is proposed but not built). It's workable for occasional big batches; it is **not** a
  place to build an admin content-editing UI against — use `TestController`'s CRUD routes (or a
  future proper admin) for anything that isn't a one-time historical import.
- Laravel's standard `database/seeders/DatabaseSeeder.php` is **not** used for any of this
  project's yoga content — don't add content there; follow the data-only-migration pattern
  instead so it stays in the same reviewable history as schema changes.

## Known inconsistencies (real, not hidden)

- Ordering-column names differ across tables (`sort_order` vs `steps_order_number` vs
  `step_order`) — cosmetic, not worth a migration to unify on its own, but pick `sort_order` if
  you're adding a new orderable child table, since two of three existing ones already lean that
  direction in spirit.
- `time_of_the_day` (singular-ish) sits next to `difficulty_levels`/`categories` (plural) —
  historical, not a pattern to copy deliberately, but also not worth breaking working code to fix.
