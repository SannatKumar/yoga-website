# Unified Practice Schema — Sukshma/Sthula Vyayama, Tibetan Rites, Surya Namaskara

> **For current overall status, see [RESUME_HERE.md](RESUME_HERE.md) and
> [PROJECT_PROGRESS.md](PROJECT_PROGRESS.md).**

Written 2026-09-19. Follow-up to [DATABASE_SCHEMA_ASANAS.md](DATABASE_SCHEMA_ASANAS.md) and
[CONTENT_EXTRACTION_STATUS.md](CONTENT_EXTRACTION_STATUS.md). Answers: where do Sukshma Vyayama,
Sthula Vyayama, Tibetan Rites, and Surya Namaskara content live now that real text for all of them
exists in `D:\Yoga_Asanas`?

## The decision

Discussed before building: Sukshma Vyayama, Sthula Vyayama, and Tibetan Rites are structurally
identical to an asana — a name plus ordered steps, benefits, and contraindications. Rather than
building three more copies of `asana_steps`/`asana_benefits`/`asana_contraindications`, they now
live as **rows in the same `asanas` table**, distinguished by a new `practice_type_id` column, and
reuse every existing child table as-is.

Surya Namaskara does **not** fit that shape — it's a 12-step *sequence* that references other
postures (several of which are just poses that already exist, e.g. Bhujanga Asana, Padahastasana),
each repeated at different points with a different mantra/chakra/breath. It got its own small
schema instead.

## What changed

### `practice_types` (new table)

| id | type_name | Covers |
|---|---|---|
| 1 | Asana | Every original asana, plus the 5 Surya Namaskara postures added below |
| 2 | Sukshma Vyayama | Pawanamuktasana series + Shakti Vikasaka group (24 practices) |
| 3 | Sthula Vyayama | Sarvanga Pushti, Hrid Gati (2 practices) |
| 4 | Tibetan Rite | The 5 Tibetan Rites |

`asanas.practice_type_id` (new `unsignedBigInteger`, FK → `practice_types.id`) was added and
backfilled to `1` for all 40 pre-existing rows.

### `asana_steps.asana_steps` widened

Hit a real bug while inserting this batch: the original migration set this column to
`varchar(100)` — too small for a full instruction sentence. Widened to `varchar(500)` (matching
`asana_benefits`/`asana_contraindications`). This was caught mid-migration (MySQL doesn't roll
back committed DML the way you'd hope on a later statement's failure within the same script, so
23 partially-inserted rows had to be cleaned up by hand before re-running) — worth knowing if you
see this pattern again: **wrap large multi-insert migrations' risk by testing the largest few
strings first**, or just use `text()` instead of a capped `string()` for freeform content columns
going forward.

### 36 new `asanas` rows

- **24 Sukshma Vyayama**: Griva/Bhuja Balli/Purna Bhuja/Kati/Jangha/Pada-Mula/Gulpha-Pada-Pristha
  Shakti Vikasaka practices, plus Ardha Titli Asana, Poorna Titli Asana, Skanda Chakra,
  Padachakrasana, Supta Pawanmuktasana, Supta Udarakarshanasana, Gatyatmak Meru Vakrasana,
  Kashtha Takshanasana.
- **2 Sthula Vyayama**: Sarvanga Pushti, Hrid Gati.
- **5 Tibetan Rites**: Tibetan Rite 1–5.
- **5 Asana-type**: Pranamasana, Hasta Uttanasana, Ashwa Sanchalanasana, Parvatasana, Ashtanga
  Pranama — added purely so every step of the Surya Namaskara sequence below can point at a real
  `asanas` row. **These 5 have no steps/benefits/contraindications** — `surya-namaskara.md` gives
  only breath/chakra/mantra per posture, not body instructions, so nothing was fabricated. They
  render with the normal empty-state fallbacks, same as any other asana without content yet.

All inserted via `database/migrations/2026_09_19_160002_seed_sukshma_sthula_tibetan_and_surya_postures.php`.
Where the source gave one "generic benefits/contraindications" block for a whole sub-group (e.g.
all 5 Kati Shakti Vikasaka variations share one benefits list in the notes), that same list was
applied to each member — not a transcription error, that's what the source does. Where nothing was
given at all (all 4 Griva Shakti Vikasaka entries, Jangha Shakti Vikasaka I, all 5 Tibetan Rites),
benefits/contraindications were left empty rather than invented.

### `surya_namaskara` + 3 child tables (new)

| Table | Shape |
|---|---|
| `surya_namaskara` | One header row: `title`, `introduction` (the purpose/background text) |
| `surya_namaskara_benefits` | One-to-many off the header, same shape as `asana_benefits` |
| `surya_namaskara_contraindications` | One-to-many off the header, same shape as `asana_contraindications` (the source's "Note of Caution" paragraph, split into individual items) |
| `surya_namaskara_steps` | The 12 ordered steps: `step_order`, `asanas_id` (FK → `asanas.id`, **not nullable** — every step resolves to a real posture), `breathing`, `chakra`, `mantra` |

Verified the full 12-step sequence resolves correctly end to end (Pranamasana → Hasta Uttanasana →
Padahastasana → ... → Pranamasana), each step correctly pointing at its `asanas` row (reusing the
existing Padahastasana(2) and Bhujanga Asana(19) rows where the posture already existed).

## What this means for existing pages

`getAsanaWithDetails()` needed no change; it queries by a specific `id` regardless of type, so it
already renders Sukshma Vyayama/Sthula Vyayama/Tibetan Rite detail pages correctly through the
exact same code path as any asana. Verified by rendering a Griva Shakti Vikasaka entry, Tibetan
Rite 1, and Hrid Gati through `getAsanaWithDetails()`.

`GalleryController::index()` (the `/gallery` listing) was briefly scoped to `practice_type_id = 1`
right after this migration, then the project owner deliberately removed that filter — `/gallery` is
meant to be one searchable library across every practice type, not just "Asana" rows. That's
intentional; don't reintroduce the filter.

## Frontend wiring (2026-09-19, follow-up)

All four practice types now have a real page, connected to this schema:

- `/sukhsma-vyayama` and `/sthula-vyayama` — `SukhsmaVyayamaController`/`SthulaVyayamaController`
  now query `practice_type_id` 2/3 instead of their own separate hardcoded arrays (same fix
  `/gallery` got earlier, applied to the two controllers that already existed for these types).
- `/tibetan-rites` — new `TibetanRitesController` + view, same listing-grid pattern, `practice_type_id = 4`.
- `/surya-namaskara` — new `SuryaNamaskaraController` + a dedicated sequence view (not the
  filterable grid the other types use — it renders the 12 ordered steps with breath/chakra/mantra,
  each linking to its underlying posture's own `/asana-details/{id}` page).
- `/yoga-nidra` — a friendly "coming soon" page. No table, no data, by design (not started yet) —
  the point was to replace the dead `nidra.html` link on `/show-asana` with something honest rather
  than fabricate content.

Two real bugs were caught and fixed while doing this:
1. The Sukshma/Sthula Vyayama listing views hardcoded **every** card's "view details" link to
   asana `id => 1`, regardless of which practice the card actually displayed — every card on both
   pages linked to the same detail page. Fixed to use each row's real id; verified the first card
   on each listing now links to its own actual database id.
2. `sthula-vyayama.blade.php`'s "no results" empty state linked to a route name
   (`gallery-asana-detail`) that doesn't exist anywhere in `routes/web.php` — would have thrown a
   `RouteNotFoundException` the first time a search matched nothing. Fixed to point at
   `sthula-vyayama` itself.

Also fixed a `stripos(): Passing null to parameter #1` deprecation warning in all four listing
controllers' search filter — several new practices have `asana_description = null`, and `stripos()`
doesn't accept `null` since PHP 8.1. Coalesced to `''` in each.

## Not done

- **The Vajrasana duplicate (`asanas.id 30`) and the `Trysana*` test rows** — explicitly left alone
  per instruction, to be cleaned up later.
- `data.md`/`new_data.md` at the repo root still haven't been pulled in — separately from
  `D:\Yoga_Asanas`, per `CONTENT_EXTRACTION_STATUS.md`.
- Yoga Nidra has a page but no content, schema, or data source yet — deferred by design until
  source material exists.
