<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        // Sample yoga images data (in a real app, this would come from the database)
        $images = [
            [
                'id' => 1,
                'title' => 'Sun Salutation',
                'description' => 'A beautiful morning sun salutation sequence',
                'image_url' => '/images/Sarvangasana.jpeg',
                'category' => 'Vinyasa',
                'difficulty' => 'Beginner',
                'tags' => ['morning', 'flow', 'energizing']
            ],
            [
                'id' => 2,
                'title' => 'Meditation Pose',
                'description' => 'Peaceful meditation in nature',
                'image_url' => '/images/Matsyasana.jpeg',
                'category' => 'Meditation',
                'difficulty' => 'All Levels',
                'tags' => ['meditation', 'peace', 'mindfulness']
            ],
            [
                'id' => 3,
                'title' => 'Warrior Pose',
                'description' => 'Strong and powerful warrior II pose',
                'image_url' => '/images/Vajroli.jpeg',
                'category' => 'Hatha',
                'difficulty' => 'Intermediate',
                'tags' => ['strength', 'balance', 'focus']
            ],
            [
                'id' => 4,
                'title' => 'Tree Pose',
                'description' => 'Balanced tree pose in the forest',
                'image_url' => '/images/Halasana.jpeg',
                'category' => 'Hatha',
                'difficulty' => 'Beginner',
                'tags' => ['balance', 'nature', 'grounding']
            ],
            [
                'id' => 5,
                'title' => 'Downward Dog',
                'description' => 'Classic downward facing dog pose',
                'image_url' => '/images/Halasana.jpeg',
                'category' => 'Vinyasa',
                'difficulty' => 'Beginner',
                'tags' => ['inversion', 'strength', 'stretch']
            ],
            [
                'id' => 6,
                'title' => 'Lotus Pose',
                'description' => 'Traditional lotus meditation pose',
                'image_url' => '/images/virasana.jpeg',
                'category' => 'Meditation',
                'difficulty' => 'Advanced',
                'tags' => ['meditation', 'traditional', 'flexibility']
            ],
            [
                'id' => 7,
                'title' => 'Cobra Pose',
                'description' => 'Energizing cobra backbend',
                'image_url' => '/images/tadasana.jpeg',
                'category' => 'Hatha',
                'difficulty' => 'Beginner',
                'tags' => ['backbend', 'energy', 'opening']
            ],
            [
                'id' => 8,
                'title' => 'Child\'s Pose',
                'description' => 'Restorative child\'s pose',
                'image_url' => '/images/yogamudra.png',
                'category' => 'Restorative',
                'difficulty' => 'All Levels',
                'tags' => ['restorative', 'relaxation', 'gentle']
            ]
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

        return view('gallery', compact('images', 'categories', 'difficulties', 'category', 'difficulty', 'search'));
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
        return view('gallery_detail', compact('pose'));
    }
}
