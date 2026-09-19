# Content Extraction Status — D:\Yoga_Asanas Notes → Database

> **For current overall status, see [RESUME_HERE.md](RESUME_HERE.md) and
> [PROJECT_PROGRESS.md](PROJECT_PROGRESS.md).** This doc stays focused on the `D:\Yoga_Asanas`
> extraction specifically.

Written 2026-09-19. State of converting the scanned notes in `D:\Yoga_Asanas` into database
content for this project. Read this before doing any more extraction work — it tells you what's
already inserted, what source text exists but isn't inserted yet, and what has no usable text yet
at all.

## What's in the source folder

`D:\Yoga_Asanas\` contains ~90 scanned/photographed note-page images (`10NeckupandDown.jpg`,
`39Vajrasana.jpg`, etc. — numbered roughly in page order) plus an `extracttext.py` script that runs
every image through Tesseract OCR into one raw dump, `Asanasdata\output.txt` (145 KB, unstructured
— has every page's text back-to-back with no cleanup, not directly usable).

From that raw OCR, 10 topic files under `D:\Yoga_Asanas\Asanasdata\` have already been
hand-cleaned into proper Markdown, each covering a group of poses/practices with headings, numbered
practice steps, and bullet-point benefits/contraindications:

| File | Covers |
|---|---|
| `normal-standing-asanas.md` | Trikonasana, Vrikshasana |
| `normal-sitting-asanas.md` | Dandasana, Vajrasana, Bhadrasana, Uttana Mandukasana, Mandukasana, Gomukhasana, Ushtrasana, Janushirsasana, Paschimottanasana, Vakrasana, Simha Garjasana, Yoga Mudrasana |
| `prone-asana.md` | Bhujangasana, Shalabhasana, Makarasana, Uttanapadasana, Setu Bandhasana, Sarvangasana, Halasana, Vipareeta Karani, Sarala Matsyasana, Shavasana |
| `meditative-asanas.md` | Sukhasana, Vajrasana (alt version), Siddhasana/Siddha Yoni Asana, Ardha Padmasana, Padmasana |
| `PawanaMukatanasana.md` | Pawanamuktasana series (anti-rheumatic + digestive/abdominal groups) — Ardha/Poorna Titli Asana, Skanda Chakra, Padachakrasana, Supta Pawanmuktasana, Supta Udarakarshanasana |
| `shakti-vikasaka.md` | Griva/Bhuja Balli/Kati/Jangha/Pada-Mula Shakti Vikasaka (neck/arm/waist/hip/ankle loosening series) |
| `shakti-bandha-asanas.md` | Gatyatmak Meru Vakrasana, Kashtha Takshanasana |
| `Sthula-vyayama.md` | Sarvanga Pushti, Hrid Gati |
| `Tibetan-rites.md` | 5 Tibetan Rites |
| `surya-namaskara.md` | Sun Salutation — background/purpose text and the 12-posture breath/chakra/mantra sequence (**no per-posture body instructions** — those aren't written down anywhere yet) |

`ShaktiVikasaka.md` (no hyphen) is a plain-text duplicate/earlier draft of `shakti-vikasaka.md` —
same content, superseded. `AlltheasanasData.txt`, `AsanasData.txt`, and `Rough.txt` are earlier
drafts of the same material (`AsanasData.txt` is an early draft of `shakti-vikasaka.md`;
`AlltheasanasData.txt` has one garbled, unusable OCR fragment of Padahastasana).

## What's now in the database (done today)

This project's `asanas` table only models **individual poses** (via `asana_steps`,
`asana_benefits`, `asana_contraindications` — see [DATABASE_SCHEMA_ASANAS.md](DATABASE_SCHEMA_ASANAS.md)),
not the warm-up/breathing/rite series. Cross-referencing the `asanas` table's 40 real rows against
the two files that cover individual poses (`normal-standing-asanas.md`, `normal-sitting-asanas.md`,
`prone-asana.md`, `meditative-asanas.md`) found **29 direct name matches**. All 29 have been
inserted — steps, benefits, and contraindications — via
`database/migrations/2026_09_19_150000_seed_real_asana_content_from_notes.php`:

Trikonasana(5), Vrikshasana(6), Dandasana(7), Vajrasana(8), Bhadrasana(9), Uttana Mandukasana(10),
Manduka Asana(11), Gomukhasana(12), Ushtrasana(13), Janushirsasana(14), Paschimottanasana(15),
Vakrasana(16), Simha Garjasana(17), Yoga Mudrasana(18), Bhujanga Asana(19), Shalabhasana(20),
Makarasana(21), Uttana Pada Asana(22), Setu Bandhasana(23), Sarvanga Asana(24), Halasana(25),
Vipareeta Karani(26), Sarala Matsyasana(27), Shavasana(28), Sukhasana(29), Siddhasana(31),
Siddha Yoni Asana(32), Ardha Padmasana(33), Padmasana(34).

Combined with the pre-existing Tadasana(1) and Padahastasana(2), the `asanas` table now has real
content for **31 of 40 rows** — up from 3 (Tadasana, Padahastasana, Vajrasana-image-only) before
today. Verified: every migrated id renders correctly through
`GalleryController::getAsanaWithDetails()`.

Notes on a few specific transcriptions:
- **Paschimottanasana**: the source says its benefits/contraindications are "same as
  Janushirsasana" — inserted Janushirsasana's actual text rather than a literal "same as" placeholder.
- **Siddha Yoni Asana(32)**: the source describes this as the same physical technique as
  Siddhasana(31), just the name used when a woman practices it — both got identical steps/benefits/
  contraindications, since the notes don't describe a distinct technique.
- **Shavasana(28)**: the source lists no contraindications at all — left as an empty array (not a
  gap, that's what the notes say).
- **Vajrasana**: used the more detailed `normal-sitting-asanas.md` version (has "how to come out of
  the pose" instructions) over the shorter `meditative-asanas.md` version, for asana id 8 — the
  `asanas` table's *other* Vajrasana row (id 30, a duplicate) was left untouched, see below.

## Not inserted yet — and why

**No usable source text at all** (not a task-tracking gap, an actual content gap — nothing in
`D:\Yoga_Asanas` covers these):
- Ardha Chakrasana (id 3), Ardhakatichakrasanaa (id 4), Balasana (id 35) — not mentioned in any of
  the 10 cleaned `.md` files. Balasana is referenced only as a rest position inside other poses'
  instructions ("Rest in Balasana"), never given its own steps/benefits/contraindications.

**Data-quality issue, not a content gap** — flagging rather than silently deciding:
- `asanas` has **two** Vajrasana rows: id 8 (now has content, has an image, has `category_id` set)
  and id 30 (still empty, no content, likely a duplicate insert from earlier testing). Worth
  deciding whether to delete id 30 or merge/redirect it before this data goes live — didn't
  delete it myself since it's a data decision, not obviously safe to assume.
- ids 36, 37 ("Trysana4" appears twice — both 37 and 41), 38, 39, 41 ("Trysana", "Trysana2",
  "Trysana3", "Trysana4" x2) are clearly test/placeholder rows from earlier development, not real
  asanas. No content exists or should be sourced for these — recommend deleting them.

**Real content exists but wasn't inserted (out of scope for this pass, not lost)**:
- `data.md` and `new_data.md` at the project repo root (per `PROJECT_FINDINGS.md`) — separately
  from the `D:\Yoga_Asanas` folder, these already have real Tadasana and Griva Shakti Vikasaka
  content. Not touched in this pass; still relevant for whatever populates Sukshma Vyayama content
  (see below).
- ~~The 6 `.md` files covering series/sequences~~ — **done 2026-09-19**, see
  [UNIFIED_PRACTICE_SCHEMA.md](UNIFIED_PRACTICE_SCHEMA.md). `PawanaMukatanasana.md`,
  `shakti-vikasaka.md`, and `shakti-bandha-asanas.md` (Sukshma Vyayama), `Sthula-vyayama.md`
  (Sthula Vyayama), and `Tibetan-rites.md` (Tibetan Rites) are all now inserted as `asanas` rows
  distinguished by a new `practice_type_id` column, reusing the existing steps/benefits/
  contraindications tables. `surya-namaskara.md` got its own small schema
  (`surya_namaskara` + 3 child tables) instead, since it's a sequence referencing other postures
  rather than a standalone practice — its 12-posture breath/chakra/mantra sequence (with no
  per-posture body instructions, exactly as flagged below) is fully captured there.
- No controller/route/view renders any of this new content yet (no Surya Namaskara page, no
  Sukshma/Sthula Vyayama listing) — still open, see `UNIFIED_PRACTICE_SCHEMA.md`'s "Not done".

## Suggested next step

All source content in `D:\Yoga_Asanas` is now in the database (see
[UNIFIED_PRACTICE_SCHEMA.md](UNIFIED_PRACTICE_SCHEMA.md)). What's left: build a page/route for
Surya Namaskara and a listing page for Sukshma/Sthula Vyayama and Tibetan Rites (currently reachable
only by direct `id`), and separately, whenever convenient, the Vajrasana-duplicate and
Trysana-junk-row cleanup (cheap, unblocks nothing else, just removes noise).
