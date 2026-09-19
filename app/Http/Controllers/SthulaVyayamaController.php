<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asana;
use Illuminate\Http\Request;

class SthulaVyayamaController extends Controller
{
    public function sthulaVyayama(Request $request)
    {
        // Real Sthula Vyayama practices (practice_type_id 3), replacing the old hardcoded sample array.
        $images = Asana::with(['category', 'difficultyLevel', 'tags', 'images'])
            ->where('practice_type_id', 3)
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
                       stripos($image['description'] ?? '', $search) !== false;
            });
        }

        // Get unique categories and difficulties for filters
        $categories = array_unique(array_column($images, 'category'));
        $difficulties = array_unique(array_column($images, 'difficulty'));

        return view('sthula-vyayama', compact('images', 'categories', 'difficulties', 'category', 'difficulty', 'search'));
    }

    public function show(Request $request)
    {
        $id = $request->id;

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
        return view('gallery-detail', compact('pose'));
    }
}
