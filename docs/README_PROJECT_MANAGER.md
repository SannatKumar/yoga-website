# For the Project Manager

This turns [PROJECT_PLAN.md](PROJECT_PLAN.md) into something trackable. It replaces
`ToDoList.md`'s August plan, which was written before the current gaps (hardcoded content,
mismatched images, unauthenticated routes) were fully mapped — keep `ToDoList.md`'s localization
and component tasks, most are already done, but plan against this doc for content and launch.

## Definition of Done — per asana

Use this as a literal checklist per pose, not a vague "add content" task:

- [ ] Correct Sanskrit + English name
- [ ] Category (Standing / Seated / Backbend / Supine / Inversion / Meditation / Restorative)
- [ ] Difficulty (Beginner / Intermediate / Advanced / All Levels)
- [ ] One image, correctly matched to the name (not copy-pasted from another pose)
- [ ] One accurate description (2–3 sentences)
- [ ] Ordered practice steps with breath cues (inhale/exhale), 3+ steps
- [ ] At least 2 benefits
- [ ] At least 1 contraindication (this field is empty for almost everything today — see
      [README_YOGA_PRACTITIONER.md](README_YOGA_PRACTITIONER.md))

## Milestone breakdown

| Milestone | Maps to | Owner | Blocks |
|---|---|---|---|
| M1 — Bugs fixed | Plan Phase 1 | Developer | Nothing, can start immediately |
| M2 — Schema + seeder pipeline built | Plan Phase 2 | Developer | M2 needs the JSON schema agreed with whoever writes content (same day, not sequential) |
| M3 — Content authored for launch pose set | Plan Phase 3 | Content author / practitioner | Needs M2's schema decided, not M2 finished |
| M4 — Views wired to DB, controllers refactored | Plan Phase 2 (cont.) | Developer | Needs M2 + M3 both landed |
| M5 — Polish (i18n strings, SEO, mobile check) | Plan Phase 4 | Developer | Needs M4 |
| M6 — Deployed to DigitalOcean | Plan Phase 5 | Developer / Owner | Needs M5, and the owner's scope decisions from [README_PROJECT_OWNER.md](README_PROJECT_OWNER.md) |

M2 and M3 should start the same day — the biggest schedule risk here is treating content writing
as something that waits for the database work to finish, when it only actually depends on the
JSON shape being agreed (which is a 30-minute conversation, not a multi-day build).

## Tracking the asana content backlog

Build a simple spreadsheet with one row per pose found in `public/images/` (list is in
[PROJECT_FINDINGS.md](PROJECT_FINDINGS.md) and [CONTENT_PIPELINE.md](CONTENT_PIPELINE.md)) and
one column per checklist item above. That spreadsheet *is* the M3 tracker — when every row is
green, M3 is done. This also makes "how many poses are launch-ready" a number you can report
without asking the developer to go check the code.

## Risks to flag now, not at launch review

- **Content accuracy is a practitioner review, not a developer task.** Don't let M3 get marked
  done by someone just filling in the JSON template without a practice background double-checking
  it — see the safety framing in [README_YOGA_PRACTITIONER.md](README_YOGA_PRACTITIONER.md).
- **The unauthenticated `/add-asanas` etc. routes are a launch blocker, not a nice-to-have fix.**
  If M1 gets deprioritized under schedule pressure, this specific item should not be the one that
  slips — it's a live write endpoint with no auth, and it stays live once deployed unless removed.
- **Scope decision on the non-yoga utility tools is a dependency for M6, not an M6 task itself.**
  It needs the owner's input (flagged in their README) before deployment config is finalized,
  since it affects which routes exist in the production build.

## Suggested cadence

Given this is roughly a 1–2 week effort end to end (see Phase estimates in
[PROJECT_PLAN.md](PROJECT_PLAN.md)), a single milestone check-in at M3/M4 completion (the
midpoint) plus a go/no-go review before M6 is proportionate — this doesn't need a heavier
process than that.
