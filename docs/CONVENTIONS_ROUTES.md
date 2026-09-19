# Route Conventions

Written 2026-09-19. Everything below is drawn from the current `routes/web.php` — a single
route file, no route groups beyond the one shared middleware group and the handful of
CSRF-exempt write routes declared above it.

## URL paths

- **kebab-case, always**: `/sukhsma-vyayama`, `/tibetan-rites`, `/surya-namaskara`,
  `/asana-details/{id}`, `/showgallerycard/{id}`, `/currency-converter`. No camelCase, no
  underscores, anywhere in a path.
- **Route parameters**: `{id}` for a numeric primary key (`/asana-details/{id}`,
  `/mantra/{id}`, `/teacher/{id}`). No slugs are used anywhere yet — every detail route is
  id-based.

## Route names

- **The route `name()` matches the URL path, kebab-case, with the leading slash and any `{param}`
  dropped**: `/tibetan-rites` → `->name('tibetan-rites')`, `/surya-namaskara` →
  `->name('surya-namaskara')`, `/asana-details/{id}` → `->name('asana-details')`. This is a hard
  rule to keep — a mismatch here is exactly the kind of bug that was found and fixed this session
  (`sthula-vyayama.blade.php` linked to a route named `gallery-asana-detail`, which doesn't exist
  anywhere in `web.php`, and would have thrown `RouteNotFoundException` the first time it was hit).
  **Before adding a `route('some-name')` call anywhere in a Blade file, confirm that name exists
  in `web.php` — don't assume it from the URL.**
- Two historical routes keep separate names for the same controller action
  (`showgallerycard` and `asana-details` both point at `getAsanaWithDetails`) — that's
  intentional backward-compatibility (an older link path was kept working when the newer
  `/asana-details/{id}` name was introduced), not a pattern to repeat. Don't add a second name
  for a new route "just in case" — one URL, one name.

## Grouping and middleware

- Almost every page route lives inside one shared group:
  `Route::middleware([SetLocale::class, SetDefaultLocaleForUrls::class, TrackVisits::class])->group(...)`.
  Any new user-facing page route belongs inside this group.
- A small number of routes are declared **outside** that group, above it in the file, each with
  `->withoutMiddleware([...VerifyCsrfToken::class])` — these are the API/Postman-testing write
  endpoints (`/get-asanas`, `/add-asanas`, `/update-asanas`, `/delete-asanas`, `/add-asana-steps`).
  **This is flagged as the #1 pre-launch blocker in `DEPLOYMENT_TODO.md`** — these routes are
  currently unauthenticated and reachable by anyone with the URL. Don't add another CSRF-exempt
  write route without also addressing that item; if you're adding a new write endpoint, prefer
  putting it behind `auth` middleware from the start rather than adding to the unauthenticated list.
- Simple static/no-controller-logic pages use `Route::view('/path', 'view-name')->name(...)`
  directly (`/philosophy`, `/videos`, `/terms`, `/yoga-nidra`) — use this instead of a controller
  with a one-line `return view(...)` method when the page truly has no logic.

## Controller reference style

- `Route::get('/path', [ControllerClass::class, 'method'])` — the `::class` constant + array
  callable syntax throughout, not the older `'Controller@method'` string syntax. Keep this style.
- Every controller used in `web.php` is `use`-imported at the top of the file, one per line,
  grouped loosely by when they were added rather than alphabetized — when adding a new controller,
  add its `use` line near the routes that use it (as the Tibetan Rites/Surya Namaskara ones were
  added right above their own route block) rather than resorting the whole import list.

## Disabled-but-kept routes

- The four non-yoga utility tool routes (`/cv-generator`, `/cover-letter`,
  `/currency-converter`, `/nepali-calendar`) are commented out, not deleted — along with their
  now-unused controller `use` imports. This is the pattern to follow for "not part of this
  launch, but keep the code": comment out the route (and its now-dangling import) with a short
  comment explaining why and pointing at the relevant `DEPLOYMENT_TODO.md` item, rather than
  deleting working code or leaving a route silently live with no nav link to it.
