# For the Practicing Yoga Person

This is the content-quality and safety review — the lens the developer/PM docs don't cover. If
you're the one filling in [CONTENT_PIPELINE.md](CONTENT_PIPELINE.md)'s master JSON, this is your
checklist and the specific problems found in what's live today.

## What's actually wrong with the content right now

- **Sun Salutation is illustrated with a Shoulderstand photo** (`Sarvangasana.jpeg` labeled
  "Sun Salutation" in the gallery). Anyone who practices will notice immediately — this is the
  kind of error that undermines trust in the whole site.
- **Balasana's card shows Virasana's photo and Padmasana's description** ("Traditional lotus
  meditation pose") — three different poses tangled into one card.
- **Halasana's card is described as "Classic downward facing dog pose"** — Adho Mukha Svanasana's
  description, not Halasana's. Halasana (Plow) is a supine inversion; Downward Dog is a standing
  forward-fold-adjacent pose. Not a small mix-up.
- **The Sukshma Vyayama (subtle warm-up) list has placeholder text instead of real instructions**
  — entries literally say `griva-shakti-bikasaka-desc` where real practice steps should be. The
  good news: `new_data.md` in the project root already has correct, well-written steps for Griva
  Shakti Vikasaka variations 1–3 (neck up/down, twist right/left, tilt right/left), including
  breath cues. That content just needs to be moved into the real content pipeline instead of
  sitting in an unused markdown file.
- **Contraindications are missing almost everywhere.** Right now only Tadasana (in `data.md`) and
  the Sun Salutation gallery entry have any caution notes at all. Before this is public, every
  published pose should have at least one — this is the single highest-priority content gap from
  a practitioner standpoint, more important than polishing descriptions.

## What's already good and worth keeping as the template

- `data.md`'s Tadasana entry: steps written with clear inhale/exhale cues, a real benefits
  paragraph, and a real contraindication ("people with vertigo must take care or avoid it... those
  with ankle injury need not stand on toes"). This is the quality bar for every other pose.
- `data.md`'s five-spinal-movements framework (Flexion, Extension, Lateral Flexion, Axial
  Rotation, Axial Extension) with a named example asana for each is genuinely solid educational
  content — worth surfacing as its own short "philosophy of asana" section rather than leaving it
  buried in a markdown file no visitor will ever see.
- `new_data.md`'s Griva Shakti Vikasaka steps — correct structure, real breath cues, and already
  includes a generic benefits/contraindications note for the whole neck-movement group (useful
  precedent: some content is naturally shared across a group of variations rather than repeated
  per-variation).

## Checklist per asana (mirrors the PM's Definition of Done, practitioner lens)

- [ ] **Name**: Sanskrit + common English name both present and correctly spelled
- [ ] **Image matches the name** — sounds obvious, but 3 of ~9 gallery entries fail this today
- [ ] **Category** is accurate (Standing / Seated / Backbend / Supine / Inversion / Twist /
      Restorative / Meditation) — helps beginners self-select appropriately
- [ ] **Difficulty** reflects real accessibility, not guesswork — e.g. inversions like Halasana or
      Sarvangasana should not default to "Beginner"
- [ ] **Steps** are sequenced and include breath cues (inhale/exhale at the right moment), not just
      a static end-pose description
- [ ] **Benefits**: 2+, specific rather than generic ("improves digestion" beats "good for health")
- [ ] **Contraindications**: at least 1 — who should avoid or modify this pose (pregnancy, neck/
      spine injury, high/low blood pressure, recent surgery, vertigo, knee/ankle issues, as
      relevant to that specific pose)
- [ ] If the pose has multiple named variations (like Griva Shakti Vikasaka's 3 neck movements),
      decide whether contraindications live once at the group level or need per-variation notes —
      the existing `new_data.md` content already models the group-level approach reasonably well

## Suggested pass order

Prioritize poses with existing correct photography first (see the list in
[CONTENT_PIPELINE.md](CONTENT_PIPELINE.md)) — no point writing content for a pose with no image
yet. Within that set, do the ones already flagged as *wrong* (Sun Salutation, Balasana, Halasana
entries above) before the ones merely *missing* — fixing a visible error matters more for trust
than filling a blank.

## One framing note for the launch conversation

Publishing yoga instruction publicly, even informational, carries a duty of care — the
contraindications gap isn't just a content nicety, it's the part of this project closest to
"someone could get hurt following this." Worth being the one voice in the room that treats that
as a launch blocker for the *published* poses, even if the full ~17-pose library takes longer.
