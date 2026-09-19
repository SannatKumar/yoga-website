# Variable Naming Conventions

Written 2026-09-19. Three different contexts, three different rules — this project keeps them
consistently separate rather than picking one style everywhere, and that separation is worth
preserving.

## PHP variables (controllers, models)

**camelCase**, always: `$asanaName`, `$asanaDescription`, `$primaryImage`, `$categoryId`,
`$difficultyId`, `$timeOftheDayId` (note the inconsistent internal capitalization on this one
specifically — `timeOftheDay` not `timeOfTheDay` — a pre-existing typo in `TestController`/
`GalleryController::addAsanas()`, left as-is rather than renamed to avoid an unrelated diff; don't
copy the typo into new code, but don't "fix" it in that one spot alone either without checking
every caller).

Request input is pulled into a local camelCase variable immediately at the top of a method
(`$asanaName = $request->asana_name;`) rather than reading `$request->asana_name` inline
throughout the method body — keep doing this, it keeps the mapping from snake_case request field
to camelCase PHP variable in one visible place.

## Array keys that represent a database row or a view's data contract

**snake_case, matching the source column name**, even though the array itself is a plain PHP
array, not an Eloquent model. The `$pose` array built in `GalleryController::getAsanaWithDetails()`
is the canonical example:

```php
$pose = [
    'id' => $asana->id,
    'title' => $asana->asana_name,        // renamed on the way in — see below
    'description' => $asana->asana_description,
    'image_url' => $primaryImage ? ... : null,
    'category' => optional($asana->category)->category_name,
    'difficulty' => optional($asana->difficultyLevel)->level_name,
    'time_of_the_day' => optional($asana->timeOfTheDay)->time_name,
    ...
];
```

Two sub-rules visible here:
- Where the array key is a **generic UI concept** independent of the exact column it came from
  (`title` instead of `asana_name`, `image_url` instead of `image_path`), it's renamed to the
  generic term — because this same `$pose` shape is built from more than one place conceptually
  (an asana's own name column) and the view shouldn't need to know the underlying column name.
- Where the array key **is** effectively the column, unrenamed (`category`, `difficulty`,
  `time_of_the_day`, `benefits`, `contraindications`, `tags`) — stays snake_case, no camelCase
  conversion, so it's traceable back to its source at a glance.

**Keep this same shape for any new controller method that builds an array for a view** — don't
introduce camelCase array keys (`$pose['imageUrl']`) even though PHP array keys "could" be
camelCase; every existing view expects snake_case keys and mixing conventions inside one array is
worse than either convention alone.

## Blade template variables

Whatever the controller passed via `compact(...)` or an explicit array — no renaming happens in
the view. `$pose`, `$steps`, `$images`, `$categories`, `$difficulties`, `$category`, `$difficulty`,
`$search` are all lowercase, singular-or-plural-matching-their-content (`$categories` is a list,
`$category` is the single selected filter value — both exist side by side in
`gallery.blade.php`/`GalleryController::index()`, distinguished only by pluralization, which is
exactly why the plural/singular distinction matters and should stay deliberate).

## Eloquent model properties / `$fillable`

Always the literal snake_case column name — `asana_name`, `practice_type_id`, `is_primary` — no
accessor renaming happens at the model level in this project (no `$appends`, no custom
`get*Attribute()` renaming column names to something friendlier). If a friendlier name is needed,
it's introduced at the controller layer when building the `$pose`-style array, not on the model.

## CSS class names vs PHP/array/Blade variable names

Kept in entirely separate worlds by convention — CSS classes are kebab-case
(`.asana-info`, `.step-image-img`, `.meta-pill`), PHP/array/Blade variables are camelCase or
snake_case per the rules above, and the two are never confused (no `$stepImageImg` PHP variable
mirroring a `.step-image-img` class, for instance). See `CONVENTIONS_CSS.md` for the CSS side.
