# Content Pipeline — Updating Descriptions & Steps for All Asanas

The question this answers: *"how do I update the description and steps for every asana without
touching PHP or Blade every time?"* Today the honest answer is "you can't, they're hardcoded" —
this is the plan to fix that once, so every future update is a data edit.

## Why one description exists per asana today

Content currently lives inline in PHP array literals inside controller methods (see
[PROJECT_FINDINGS.md](PROJECT_FINDINGS.md)). There is no database read for asana content anywhere
in the app right now, despite the `asanas` / `asana_steps` / `tags` tables existing. Editing an
asana means finding the right controller, finding the right array element, and editing PHP.

## Target: one JSON file → one seeder → the whole site updates

### 1. Standardize the schema

`yogasana.json` (root of the repo) already has the right shape for 2 sample entries. Extend it to
cover benefits and contraindications, which it's currently missing:

```json
{
  "id": 1,
  "name": "Vajrasana",
  "sanskrit": "Vajrāsana",
  "slug": "vajrasana",
  "category": "Seated",
  "difficulty": "Beginner",
  "image": "images/yogasana_pictures/vajrasana_front_side.jpg",
  "description": "A kneeling meditation posture that aids digestion and calms the mind.",
  "steps": [
    { "step": 1, "title": "Kneel Down", "instruction": "Fold your legs under you, sitting back on your heels." },
    { "step": 2, "title": "Align the Spine", "instruction": "Keep the back straight, hands resting on the knees." }
  ],
  "benefits": [
    "Improves digestion after meals",
    "Strengthens the pelvic muscles",
    "Calms the mind for meditation"
  ],
  "contraindications": [
    "Knee injury or recent knee surgery",
    "Severe varicose veins"
  ]
}
```

### 2. Populate it from what already exists — don't start from a blank page

Real, usable content already exists, just disconnected from the app:

| Source file | What's usable |
|---|---|
| `data.md` | Full Tadasana writeup (steps, benefits, contraindications) — use as the quality template. Also the five-spinal-movements framework, good for a "philosophy of asana" page. |
| `new_data.md` | Griva Shakti Vikasaka variations 1–3, real steps with breath cues (inhale/exhale) — ready to drop into the `steps` array as-is. |
| `yogasana.json` | Correct target schema, 2 sample entries (Adho Mukha Svanasana, Bhujangasana). |

For every other asana, match against the photos already shot in
`public/images/yogasana_pictures/` (Vajrasana, Padmasana, Virasana, Vrikshasana, Bhadrasana,
Gomukhasana, Mandukasana, Trikonasana, Uttanamandukasana, Yogamudrasana) plus the standalone
images in `public/images/` (Tadasana, Halasana, Matsyasana, Sarvangasana, Vajroli,
Vipareetakarani, duipadahastasana) — those are the poses with real photography ready to publish,
so they're the natural first batch for the master JSON.

### 3. Add the missing migrations

- `create_asana_benefits_table` and `create_asana_contraindications_table` — schema already
  written in `create_table.sql`, just needs `php artisan make:migration` + paste, adjusted to
  Laravel's `$table->foreignId('asana_id')->constrained()` style instead of raw `INT`.
- Fix `create_images_table` — it currently only has `id()` + `timestamps()`. Add
  `path`, `asana_id` (foreign key), `alt_text`, `is_primary` (boolean, for picking the hero image
  when an asana has multiple angle shots, e.g. Bhadrasana's front/back/left/right photos).

### 4. Add Eloquent models with relationships

```php
class Asana extends Model
{
    protected $fillable = ['asana_name', 'asana_description', 'category_id', 'tag_id', 'deleted'];

    public function steps() { return $this->hasMany(AsanaStep::class, 'asanas_id')->orderBy('steps_order_number'); }
    public function benefits() { return $this->hasMany(AsanaBenefit::class); }
    public function contraindications() { return $this->hasMany(AsanaContraindication::class); }
    public function images() { return $this->hasMany(Image::class); }
    public function tag() { return $this->belongsTo(Tag::class); }
}
```

Retire (or rename) `App\Models\Gallery` — it points at the `asanas` table under a name that
describes a page, not the data, which is confusing for anyone who hasn't read this doc.

### 5. Write the seeder

```php
class AsanaSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('data/asanas.json')), true);

        foreach ($data['asanas'] as $entry) {
            $asana = Asana::updateOrCreate(
                ['asana_name' => $entry['name']],
                ['asana_description' => $entry['description']]
            );

            $asana->steps()->delete();
            foreach ($entry['steps'] as $step) {
                $asana->steps()->create([
                    'asana_steps' => $step['instruction'],
                    'steps_order_number' => $step['step'],
                ]);
            }

            $asana->benefits()->delete();
            foreach ($entry['benefits'] ?? [] as $b) {
                $asana->benefits()->create(['benefit_description' => $b]);
            }

            $asana->contraindications()->delete();
            foreach ($entry['contraindications'] ?? [] as $c) {
                $asana->contraindications()->create(['contraindication_description' => $c]);
            }
        }
    }
}
```

`updateOrCreate` makes this **idempotent** — re-running `php artisan db:seed --class=AsanaSeeder`
after editing the JSON is the entire "update all descriptions" workflow going forward.

### 6. Point the views at the database

Replace the hardcoded `$images = [...]` arrays in `GalleryController`, `ShowAsanaController`,
`SukshmaVyayamaController`, `SthulaVyayamaController` with `Asana::with(['steps', 'benefits',
'contraindications', 'images'])->get()`, and keep the existing category/difficulty/search filter
logic — it already works, it just needs to run against a Collection from the DB instead of a
literal array (this is a copy-paste-compatible change; the `array_filter` calls become
`->filter()` calls on the same shape of data).

## Day-to-day update workflow once this is in place

1. Edit `database/data/asanas.json` (or hand it to whoever is writing content — no PHP knowledge
   needed, it's just JSON).
2. Run `php artisan db:seed --class=AsanaSeeder`.
3. Refresh the page. Done — no controller or Blade edit required for a text/step change.

If ongoing non-technical editing becomes common, a simple admin CRUD screen (Filament or a
hand-rolled resource controller) is the natural next step after 70% — deliberately out of scope
for this milestone (see [PROJECT_PLAN.md](PROJECT_PLAN.md)).
