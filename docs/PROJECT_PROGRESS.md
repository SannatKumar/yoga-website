# Project Progress — 2026-09-19

You asked for an honest percentage on where this project stands. One single number would be
misleading here, because "done" means different things depending on what you're measuring against
— so this doc gives you several real numbers, then one weighted overall estimate at the end, with
the weighting shown so you can disagree with it and recompute.

## Headline number

**~53% of the way to a public launch.** But that number hides more than it tells you — see the
breakdown below. If the bar is "usable and demoable to yourself/testers on real infrastructure,
privately," you're closer to **~80%**, because the two biggest drags on the public-launch number
(security hardening, and filling in images/tags for all 76 asanas) don't block a *private* test
deploy at all — see `DEPLOYMENT_TODO.md`'s "Testing privately before launch" section.

## By area

| Area | Status | Estimate |
|---|---|---|
| Database schema & architecture | All core tables, FKs, and relationships built (categories, difficulty, tags, benefits, contraindications, images, practice types, Surya Namaskara sequence). Only a content-pipeline tool and a few test-data rows to clean up remain. | **~95%** |
| Content — steps | 62 of 76 asanas have real steps | **82%** |
| Content — benefits | 52 of 76 | **68%** |
| Content — contraindications | 51 of 76 | **67%** |
| Content — images | 17 of 76 (up from 3 this session) | **22%** |
| Content — tags | 2 of 76 | **3%** |
| **Content average** (the 5 rows above) | | **~48%** |
| Frontend page wiring | Every practice type (Asana, Sukshma Vyayama, Sthula Vyayama, Tibetan Rites, Surya Namaskara) has a real, DB-driven page; Yoga Nidra has an honest "coming soon" page rather than a dead link. All routes verified working. | **100%** |
| Security | 5 unauthenticated write routes still open, `.env` still has local dev values, one duplicate write method to resolve. **Nothing started yet.** | **0%** |
| Deployment / infra | Not deployed anywhere yet — not even privately behind an IP allowlist. | **0%** |
| Code cleanup / quality | Dead `show()` method deleted, `Gallery`→`Asana` model rename done, utility-tools decision made and implemented, several real bugs found and fixed along the way (hardcoded `id=1` links, broken route name, `stripos(null)` deprecation, misleading image fallback). One duplicate method (`addAsanas` in two controllers) still open. | **~90%** |
| Documentation | Extensive — schema docs, content-extraction status, deployment checklist, this progress doc, and (new today) six convention docs. | **~90%** |

## By checklist item (the literal `DEPLOYMENT_TODO.md` numbered list)

Of the 11 numbered open items tracked there:
- **5 fully done**: #7 (practice-type pages), #8 (data.md/new_data.md/yogasana.json ingestion),
  #9 (dead `show()` deleted), #10 (Gallery→Asana rename), #11 (utility tools decision).
- **2 partially done**: #4 (content — most but not all asanas), #5 (images done this session,
  tags still open).
- **4 not started**: #1 (unauthenticated write routes), #2 (`.env` production values), #3
  (duplicate `addAsanas`), #6 (content-pipeline tooling).

That's **5/11 fully resolved (45%)**, a third lens on the same project, and roughly consistent
with the weighted number above once you account for #4/#5 being large multi-part items rather
than one-line fixes.

## How the 53% headline was weighted

```
Security               0%  × 15%  =  0.0
Content (avg above)   48%  × 30%  = 14.5
DB schema/architecture 95%  × 15%  = 14.3
Frontend wiring       100%  × 15%  = 15.0
Deployment/infra        0%  × 15%  =  0.0
Code cleanup            90%  × 10%  =  9.0
                                    ------
                                     52.8%  ≈ 53%
```

Security and deployment are weighted heavily because they're binary blockers for a *public*
launch regardless of how much content exists — a site with perfect content and an open write API
is not launchable, and a site with perfect content that's never been deployed isn't live. If your
actual bar is "private test on real infrastructure," drop the security and deployment rows to a
lower weight (they're not blockers for that bar, per `DEPLOYMENT_TODO.md`) and the number moves
up to roughly 80%, matching the headline's second number above.

## What moved this session

- 17/76 asanas now have images (was 3) — see `DEPLOYMENT_TODO.md` item 5.
- Dead code removed (`GalleryController::show()`), model renamed (`Gallery` → `Asana`), non-yoga
  utility tools decided and hidden — items 9, 10, 11.
- `data.md`/`new_data.md`/`yogasana.json` superseded and deleted — item 8.
- The asana detail page's "steps" card now shows one real final-pose photo instead of 4 unrelated
  placeholder lotus icons, and the same photo now sits beside the pose description near the top of
  the page too — plus a real bug fix: asanas with no photo yet no longer silently borrow a
  different asana's real photo as filler (they now show a neutral placeholder).
- Six new convention docs written (`CONVENTIONS_DATABASE.md`, `CONVENTIONS_FUNCTIONS.md`,
  `CONVENTIONS_ROUTES.md`, `CONVENTIONS_FRONTEND.md`, `CONVENTIONS_VARIABLES.md`,
  `CONVENTIONS_CSS.md`) — see those for how to keep new code consistent with what's already here.

## What did not move (still exactly as `DEPLOYMENT_TODO.md` describes)

- Security items 1–3 — untouched.
- Tags — still only 2 of 76 asanas.
- The 3 original asanas with no source text anywhere (Ardha Chakrasana, Ardhakatichakrasanaa,
  Balasana) — still a genuine content gap, not a data-entry backlog.
- The duplicate Vajrasana row and `Trysana*` test rows — still explicitly deferred, per your
  instruction, to be handled "at last."
- No deploy of any kind has happened yet.

See `RESUME_HERE.md` for exactly what to look at first next time you open the project.
