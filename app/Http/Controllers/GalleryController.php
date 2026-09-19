<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Gallery;
use App\Models\AsanaStep;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        // Real asana data from the database, replacing the old hardcoded sample array.
        $images = Gallery::with(['category', 'difficultyLevel', 'tags', 'images'])
            ->get()
            ->map(function ($asana) {
                $primaryImage = $asana->images->firstWhere('is_primary', true) ?? $asana->images->first();

                return [
                    'id' => $asana->id,
                    'title' => $asana->asana_name,
                    'description' => $asana->asana_description,
                    'image_url' => $primaryImage ? '/' . ltrim($primaryImage->image_path, '/') : '/lotus-images/blank_image.png',
                    'category' => optional($asana->category)->category_name ?? 'Uncategorized',
                    'difficulty' => optional($asana->difficultyLevel)->level_name ?? 'All Levels',
                    'tags' => $asana->tags->pluck('tag_name')->all(),
                ];
            })
            ->all();

        // Filter by category if requested
        $category = $request->get('category');
        if ($category) {
            $images = array_filter($images, function($image) use ($category) {
                return $image['category'] === $category;
            });
        }

        // Filter by difficulty if requested
        $difficulty = $request->get('difficulty');
        if ($difficulty) {
            $images = array_filter($images, function($image) use ($difficulty) {
                return $image['difficulty'] === $difficulty;
            });
        }

        // Search by title or description
        $search = $request->get('search');
        if ($search) {
            $images = array_filter($images, function($image) use ($search) {
                return stripos($image['title'], $search) !== false || 
                       stripos($image['description'], $search) !== false;
            });
        }

        // Get unique categories and difficulties for filters
        $categories = array_unique(array_column($images, 'category'));
        $difficulties = array_unique(array_column($images, 'difficulty'));

        return view('gallery', compact('images', 'categories', 'difficulties', 'category', 'difficulty', 'search'));
    }

    public function show(Request $request)
    {
        $id = $request->id;
        Log::info($id);

        $id = 1;

        $steps = [
            "Stand firmly with the feet together or hip-width apart, arms relaxed by the sides.",
            "Steady the body and distribute weight evenly across both feet.",
            "Raise the arms overhead.",
            "Interlock the fingers, turn the palms upward, and place the hands on top of the head.",
            "Fix the gaze slightly above eye level on a point on the wall. Keep the eyes steady throughout the practice.",
            "Inhale and stretch the arms, shoulders, and chest upward.",
            "Rise onto the toes, lifting the heels off the floor.",
            "Stretch the entire body from head to toe without losing balance or moving the feet.",
            "Breathe normally. At first, balance may be challenging, but it improves with practice.",
            "Exhale, lower the heels, and bring the hands back onto the head.",
            "This completes one round."
        ];

        // dd($id);
        // Sample yoga images data (same as in index)
        $images = [
            [
                'id' => 1,
                'title' => 'Sun Salutation',
                'description' => 'A beautiful morning sun salutation sequence',
                'image_url' => '/images/Sarvangasana.jpeg',
                'category' => 'Vinyasa',
                'difficulty' => 'Beginner',
                'tags' => ['morning', 'flow', 'energizing'],
                'introduction' => 'Sun Salutation (Surya Namaskar) is a sequence of 12 powerful yoga poses. Besides being a great cardiovascular workout, Sun Salutation is also known to have an immensely positive impact on the body and mind.',
                'benefits' => [
                    'Improves flexibility and strength',
                    'Boosts cardiovascular health',
                    'Reduces stress and anxiety',
                    'Promotes better digestion',
                    'Helps in weight loss',
                ],
                'contraindications' => [
                    'Pregnancy (after first trimester)',
                    'High blood pressure',
                    'Back problems',
                    'Recent surgery',
                ],
                'steps' => [
                    ['name' => 'Pranamasana', 'desc' => 'Prayer Pose'],
                    ['name' => 'Hastauttanasana', 'desc' => 'Raised Arms Pose'],
                    ['name' => 'Hasta Padasana', 'desc' => 'Hand to Foot Pose'],
                    ['name' => 'Ashwa Sanchalanasana', 'desc' => 'Equestrian Pose'],
                    ['name' => 'Dandasana', 'desc' => 'Stick Pose'],
                    ['name' => 'Ashtanga Namaskara', 'desc' => 'Salute with Eight Parts or Points'],
                    ['name' => 'Bhujangasana', 'desc' => 'Cobra Pose'],
                    ['name' => 'Adho Mukha Svanasana', 'desc' => 'Downward Facing Dog Pose'],
                    ['name' => 'Ashwa Sanchalanasana', 'desc' => 'Equestrian Pose (other leg)'],
                    ['name' => 'Hasta Padasana', 'desc' => 'Hand to Foot Pose'],
                    ['name' => 'Hastauttanasana', 'desc' => 'Raised Arms Pose'],
                    ['name' => 'Pranamasana', 'desc' => 'Prayer Pose'],
                ],
            ],
            [
                'id' => 2,
                'title' => 'Meditation Pose',
                'description' => 'Peaceful meditation in nature',
                'image_url' => '/images/Matsyasana.jpeg',
                'category' => 'Meditation',
                'difficulty' => 'All Levels',
                'tags' => ['meditation', 'peace', 'mindfulness'],
                'introduction' => 'Meditation Pose (Sukhasana) is a simple cross-legged sitting asana in hatha yoga, sometimes used for meditation and breathing exercises.',
                'benefits' => [
                    'Calms the mind',
                    'Stretches the knees and ankles',
                    'Strengthens the back',
                ],
                'contraindications' => [
                    'Knee injury',
                    'Hip injury',
                ],
                'steps' => [],
            ],
            // ... add similar details for other poses as needed ...
        ];

        $pose = collect($images)->firstWhere('id', (int)$id);
        if (!$pose) {
            abort(404);
        }
        return view('gallery-detail', compact('pose', 'steps'));
    }

    //getAsanaWithDetails
    public function getAsanaWithDetails(int $id)
    {
        $asana = Gallery::with([
            'steps',
            'benefits',
            'contraindications',
            'images',
            'category',
            'difficultyLevel',
            'timeOfTheDay',
            'source',
            'reference',
            'tags',
        ])->findOrFail($id);

        $primaryImage = $asana->images->firstWhere('is_primary', true) ?? $asana->images->first();

        $steps = $asana->steps->pluck('asana_steps')->all();

        $pose = [
            'id' => $asana->id,
            'title' => $asana->asana_name,
            'description' => $asana->asana_description,
            'image_url' => $primaryImage ? '/' . ltrim($primaryImage->image_path, '/') : null,
            'category' => optional($asana->category)->category_name,
            'difficulty' => optional($asana->difficultyLevel)->level_name,
            'time_of_the_day' => optional($asana->timeOfTheDay)->time_name,
            'source' => optional($asana->source)->source_name,
            'reference' => optional($asana->reference)->reference_title,
            'tags' => $asana->tags->pluck('tag_name')->all(),
            'benefits' => $asana->benefits->pluck('benefit')->all(),
            'contraindications' => $asana->contraindications->pluck('contraindication')->all(),
            'steps' => $steps,
        ];

        return view('gallery-detail', compact('pose', 'steps'));
    }


    //addAsanas
    public function addAsanas(Request $request)
    {
        //Take all the asanas Data
        $asanaName = $request->asana_name;
        $asanaDescription = $request->asana_description;
        $sourceId = $request->source_id;
        $categoryId = $request->category_id;
        $difficultyId = $request->difficulty_id;
        $timeOftheDayId = $request->time_of_the_day_id;
        $referenceId = $request->reference_id;

        $gallery = Gallery::create([
            'asana_name' => $asanaName,
            'asana_description' => $asanaDescription,
            'source_id' => $sourceId,
            'category_id' => $categoryId,
            'difficulty_id' => $difficultyId,
            'time_of_the_day_id' => $timeOftheDayId,
            'reference_id' => $referenceId,
        ]);



        return response()->json(['result' => $gallery], 200)
        ->header('Content-Type', 'application/json' );
    }

    //addAsanaSteps
    public function addAsanaSteps(Request $request)
    {
        //Take the asanas_id and the full ordered list of steps for that asana
        $asanasId = $request->asanas_id;
        $steps = $request->steps;

        $createdSteps = [];

        foreach ($steps as $index => $step) {
            $createdSteps[] = AsanaStep::create([
                'asana_steps' => $step,
                'steps_order_number' => $index + 1,
                'asanas_id' => $asanasId,
            ]);
        }

        return response()->json(['result' => $createdSteps], 200)
        ->header('Content-Type', 'application/json' );
    }
}
