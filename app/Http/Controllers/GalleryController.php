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
                'image_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'category' => 'Vinyasa',
                'difficulty' => 'Beginner',
                'tags' => ['morning', 'flow', 'energizing']
            ],
            [
                'id' => 2,
                'title' => 'Meditation Pose',
                'description' => 'Peaceful meditation in nature',
                'image_url' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'category' => 'Meditation',
                'difficulty' => 'All Levels',
                'tags' => ['meditation', 'peace', 'mindfulness']
            ],
            [
                'id' => 3,
                'title' => 'Warrior Pose',
                'description' => 'Strong and powerful warrior II pose',
                'image_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'category' => 'Hatha',
                'difficulty' => 'Intermediate',
                'tags' => ['strength', 'balance', 'focus']
            ],
            [
                'id' => 4,
                'title' => 'Tree Pose',
                'description' => 'Balanced tree pose in the forest',
                'image_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'category' => 'Hatha',
                'difficulty' => 'Beginner',
                'tags' => ['balance', 'nature', 'grounding']
            ],
            [
                'id' => 5,
                'title' => 'Downward Dog',
                'description' => 'Classic downward facing dog pose',
                'image_url' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'category' => 'Vinyasa',
                'difficulty' => 'Beginner',
                'tags' => ['inversion', 'strength', 'stretch']
            ],
            [
                'id' => 6,
                'title' => 'Lotus Pose',
                'description' => 'Traditional lotus meditation pose',
                'image_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'category' => 'Meditation',
                'difficulty' => 'Advanced',
                'tags' => ['meditation', 'traditional', 'flexibility']
            ],
            [
                'id' => 7,
                'title' => 'Cobra Pose',
                'description' => 'Energizing cobra backbend',
                'image_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'category' => 'Hatha',
                'difficulty' => 'Beginner',
                'tags' => ['backbend', 'energy', 'opening']
            ],
            [
                'id' => 8,
                'title' => 'Child\'s Pose',
                'description' => 'Restorative child\'s pose',
                'image_url' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
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
}
