# For the Project Owner

You've built a real Laravel yoga site with working routing, three languages, a component
library, and a genuine photo library of asana poses. That's more than most side projects get to.
What's missing isn't more features — it's finishing the content layer and making a few scope
decisions before this goes public. Full technical detail is in
[PROJECT_FINDINGS.md](PROJECT_FINDINGS.md); this page is the decisions and framing that only you
can make.

## Where the project actually stands

- Not "in progress on Info/Videos/Contact" the way the root `README.md` says — that file is
  stale. The real state: routing, layout, localization, and Blade components are solid; asana
  *content* is the unfinished part, and it's unfinished because it's hand-typed into PHP files
  instead of coming from the database you already built tables for.
- The "one description for every asana" problem you flagged is real and has one root cause:
  there's no single place content lives. [CONTENT_PIPELINE.md](CONTENT_PIPELINE.md) fixes that
  once, permanently — after that, updating content is editing a JSON file and re-running one
  command, not touching code.

## Three decisions worth 10 minutes now, to save days of rework later

**1. What else is in this codebase, and does it launch too?**
A CV generator, cover letter generator, currency converter, and Nepali calendar all live in this
same app. Their nav links are already commented out in the header, so someone (you, probably)
already half-decided these aren't part of the yoga site's public identity. Worth making that
explicit: cut them from this app, move them to their own project, or keep them as unlinked
routes for personal use. Any of the three is fine — leaving it undecided is what causes scope
creep later.

**2. How much content is "done enough to launch"?**
You have real photography for roughly 17 distinct poses already in `public/images/`. The plan
targets all of those getting full, correct content (description, steps, benefits,
contraindications) as the 70% bar. If that's too much to write before your target date, the
right move is to cut the *list*, not the *quality* — publish 8 poses done properly rather than
17 done at "one vague sentence" quality, which is the exact problem you're trying to get away
from.

**3. Droplet or App Platform on DigitalOcean?**
You already have `digitalocean_laravel_mysql_deployment.pdf` in the repo, which suggests a
Droplet + manually-managed MySQL path. That's the cheaper, more hands-on option — fine for a
low-traffic launch, and you already have the runbook. App Platform costs a bit more but means
less server maintenance. Either works; pick based on whether you want to SSH in occasionally or
not.

## What "publish to DigitalOcean" commits you to

- A recurring hosting cost (Droplet or App Platform + managed DB if you go that route).
- Production credentials that are *not* `root`/`root` (that's the local `.env` right now — fine
  for local dev, must change before this is public).
- Someone owning "what happens when a visitor reports a wrong pose description" — worth deciding
  who that is (you, or whoever authors the content) before launch, not after.

## What you get once Phase 2 of the plan lands

- Visit counts and unique visitor tracking already work (`Visit` model, already wired into
  several pages) — you don't need to bolt on Google Analytics to get a basic sense of traffic.
- Updating a pose's description becomes a content edit, not a deploy. That's the actual fix to
  the problem you described, not a workaround.

See [PROJECT_PLAN.md](PROJECT_PLAN.md) for the phased path there, and
[README_PROJECT_MANAGER.md](README_PROJECT_MANAGER.md) for how to track it week to week.
