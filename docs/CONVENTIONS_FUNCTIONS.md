# Function / Method Naming Conventions

Written 2026-09-19. Covers controller methods and Eloquent model methods as they actually exist
in the codebase today. There are two genuinely different conventions in play depending on the
kind of controller — both are documented below, along with which one to follow for new code.

## Controller methods: two coexisting patterns

**Pattern A — page controllers (the dominant pattern, use this for new pages).**
Laravel resource-style verbs where they fit, otherwise a `get`-prefixed action name:
- `index()` — a listing page (`GalleryController::index`, `SukhsmaVyayamaController` originally,
  `TibetanRitesController::index`, `SuryaNamaskaraController::index`).
- `get{Noun}()` — fetch-and-render a single page that isn't a plain resource `show`:
  `GuideController::getGuide`, `TeacherController::getTeacher`, `ShowAsanaController::getAsana`,
  `MantraShlokaBhajanController::getMantraShlokaBhajan`.
- A couple of controllers name their one action after the *thing* rather than `index`/`get*` —
  `SukhsmaVyayamaController::sukhsmaVyayama()`, `SthulaVyayamaController::sthulaVyayama()`. This
  predates the `get*`/`index` pattern above and wasn't renamed when the rest of the app
  standardized, purely to avoid an unrelated diff — **new controllers should use `index()` for a
  listing page**, matching `TibetanRitesController`/`SuryaNamaskaraController`, not this older
  style.
- `getAsanaWithDetails(int $id)` — the one detail-page method, doesn't follow `show()` because it
  replaced an older, differently-named `show()` and callers (`route()` definitions) were updated
  to match rather than renamed again to fit the resource convention. If you add another
  single-item detail page, prefer plain `show($id)`.

**Pattern B — API/data controllers (`TestController`, and the write actions on
`GalleryController`).**
CRUD verbs prefixed onto the noun, matching the resource they touch, used for endpoints meant to
be called by Postman/an external client rather than rendered as a page:
`getAsanas()`, `addAsanas()`, `updateAsanas()`, `deleteAsanas()`, `addAsanaSteps()`. Keep this
prefix style for any future write/API endpoint — don't mix in bare Laravel resource names
(`store`/`update`/`destroy`) here, since these routes are intentionally named to be
self-describing outside of Laravel's routing conventions (they're called directly by URL/Postman,
not discovered via `route()` helpers).

**Duplication to know about, not to copy**: `GalleryController::addAsanas()` and
`TestController::addAsanas()` do the same thing. This is flagged as an open cleanup item in
`DEPLOYMENT_TODO.md` (#3) — don't add a third copy; when it's resolved, one of the two should be
deleted and the other kept as the single source of truth.

## Eloquent model methods (relationships)

Consistent, and worth preserving exactly as-is:

- **`belongsTo` → singular method name matching the parent's variable name**: `category()`,
  `difficultyLevel()`, `timeOfTheDay()`, `source()`, `reference()`, `practiceType()`, `asana()`
  (a child row's link back to its parent asana — used in `AsanaStep`, `AsanaBenefit`,
  `AsanaContraindication`, `Image`, `SuryaNamaskaraStep`).
- **`hasMany` / `belongsToMany` → plural method name**: `steps()`, `tags()`, `benefits()`,
  `contraindications()`, `images()` (all on `Asana`), and the reverse side — `asanas()` on
  `Category`, `DifficultyLevel`, `TimeOfTheDay`, `Source`, `PracticeType`, `Tag`,
  `AsanaReference`. The singular/plural split maps exactly to belongsTo/hasMany — **`asana()`
  singular always means "the one parent," `asanas()` plural always means "the many children/
  related rows." Keep that mapping on any new relationship** rather than picking a name by feel.
- Ordering is baked into the relationship method itself where it matters:
  `hasMany(AsanaStep::class, 'asanas_id')->orderBy('steps_order_number')` — the controller/view
  never re-sorts; the model relationship is the single source of truth for order. Do the same for
  any new orderable child relationship.

## camelCase vs snake_case, generally

- **PHP method and variable names**: camelCase (`getAsanaWithDetails`, `$asanaName`,
  `$primaryImage`, `$difficultyId`).
- **Database columns, and the keys of any array built to mirror a database row** (e.g. the
  `$pose` array built in `getAsanaWithDetails()`): snake_case, matching the column name it came
  from (`asana_description` → `'description'` is renamed on the way into the array — see
  `CONVENTIONS_VARIABLES.md` for the full array-key convention).
- Don't camelCase an array key that exists purely to mirror a raw DB row — leave it matching the
  column so it's traceable back to its source without a lookup.
