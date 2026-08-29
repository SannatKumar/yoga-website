# Add Asana Steps — Feature Summary

Written 2026-08-29. Mirrors the existing `addAsanas` pattern to let a new
`asana_steps` row be created via HTTP POST, the same way asanas themselves
are created.

## Source of truth used

- `database/migrations/2025_11_08_142807_create_asana_steps_table.php` —
  defines the `asana_steps` table: `id`, `asana_steps` (string, 100),
  `steps_order_number` (int, nullable), `asanas_id` (int, nullable),
  timestamps.
- The `asana_steps` result-grid screenshot supplied, confirming the same
  column names/order as the migration.
- The existing `addAsanas` implementation (`Gallery` model +
  `GalleryController::addAsanas` + `/add-asanas` route in `web.php`) was
  used as the template for structure and naming.

## Files changed

### 1. `app/Models/AsanaStep.php` (new)
New Eloquent model for the `asana_steps` table, same shape as
`app/Models/Gallery.php`:
- `$table = 'asana_steps'`
- `$fillable = ['asana_steps', 'steps_order_number', 'asanas_id']`

### 2. `app/Http/Controllers/GalleryController.php`
- Added `use App\Models\AsanaStep;`.
- Added `addAsanaSteps(Request $request)`, modeled on `addAsanas()`: reads
  `asana_steps`, `steps_order_number`, `asanas_id` from the request, calls
  `AsanaStep::create([...])`, and returns the created row as JSON
  (`{"result": {...}}`, 200).

### 3. `routes/web.php`
- Added, next to the existing `/add-asanas` Postman-friendly route:
  ```php
  Route::post('/add-asana-steps', [GalleryController::class, 'addAsanaSteps'])
      ->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
  ```
- Placed outside the `SetLocale`/`TrackVisits` middleware group and CSRF
  middleware, matching how `/add-asanas`, `/update-asanas`, and
  `/delete-asanas` are wired for Postman/API testing.

## Example request

```
POST /add-asana-steps
Content-Type: application/json

{
  "asana_steps": "Raise the arms overhead.",
  "steps_order_number": 3,
  "asanas_id": 1
}
```

Response:
```json
{
  "result": {
    "id": 20,
    "asana_steps": "Raise the arms overhead.",
    "steps_order_number": 3,
    "asanas_id": 1,
    "created_at": "...",
    "updated_at": "..."
  }
}
```

## Not done (out of scope for this change)

- No `updateAsanaSteps` / `deleteAsanaSteps` / `getAsanaSteps` counterparts
  were added — only the create path was requested, matching the ask to
  build "a similar function like `addAsanas`."
- No validation rules were added, consistent with the existing
  `addAsanas`/`addAsanas`-in-`TestController` implementations, which also
  read request fields directly without a `FormRequest` or `validate()` call.