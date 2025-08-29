<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SthulaVyayamaController extends Controller
{
    public function sthulaVyayama(Request $request)
    {
        // Sample yoga images data (in a real app, this would come from the database)
        $images = [
            [
                'id' => 1,
                'title' => 'sarvanga-pushti',
                'description' => 'sarvanga-pushti-desc',
                'image_url' => '/images/yogasana_pictures/vajrasana_front_side.jpg',
                'category' => 'sarvanga-pushti-category',
                'difficulty' => 'Beginner',
                'tags' => ['spinal strength', 'Robust digestion', 'energizing']
            ],
            [
                'id' => 2,
                'title' => 'hrid-gati',
                'description' => 'hrid-gati-desc',
                'image_url' => '/images/yogasana_pictures/padmasana_front_side.jpg',
                'category' => 'hrid-gati-category',
                'difficulty' => 'All Levels',
                'tags' => ['meditation', 'peace', 'mindfulness']
            ],
        ];

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
