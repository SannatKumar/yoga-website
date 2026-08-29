# Docs — Yoga Website: Path to Launch

Written 2026-07-20 after auditing the actual codebase (the root `README.md` describes an earlier,
now-stale state of the project). Read in this order:

1. **[PROJECT_FINDINGS.md](PROJECT_FINDINGS.md)** — what's actually in the codebase today: stack,
   what's hardcoded vs. database-driven, specific bugs, image/description mismatches, scope creep.
   Start here — everything else references it.
2. **[PROJECT_PLAN.md](PROJECT_PLAN.md)** — the phased plan to reach a 70%-complete, publishable
   state and deploy to DigitalOcean, with a concrete definition of "70%."
3. **[CONTENT_PIPELINE.md](CONTENT_PIPELINE.md)** — the specific mechanism for updating every
   asana's description/steps/benefits/contraindications from one JSON file instead of editing PHP.

Then the four perspectives, each assuming you've read the three docs above:

- **[README_PROJECT_OWNER.md](README_PROJECT_OWNER.md)** — the business/vision lens: what's really
  done, what decisions only you can make (scope, hosting, content scope for launch).
- **[README_PROJECT_MANAGER.md](README_PROJECT_MANAGER.md)** — milestones, a Definition of Done
  per asana, and the risks worth flagging before they become launch blockers.
- **[README_DEVELOPER.md](README_DEVELOPER.md)** — real project structure, exact file/line bugs,
  the schema gap between `create_table.sql` and actual migrations, deployment checklist.
- **[README_YOGA_PRACTITIONER.md](README_YOGA_PRACTITIONER.md)** — content accuracy and safety
  review: which pose entries are currently wrong, what's missing (contraindications, mostly), and
  what already-written content in the repo is good enough to reuse as-is.
