<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class TibetanRitesController extends Controller
{
    public function index(Request $request)
    {
        // Real Tibetan Rite practices (practice_type_id 4).
        $images = Gallery::with(['category', 'difficultyLevel', 'tags', 'images'])
            ->where('practice_type_id', 4)
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
            $images = array_filter($images, function ($image) use ($category) {
                return $image['category'] === $category;
            });
        }

        // Filter by difficulty if requested
        $difficulty = $request->get('difficulty');
        if ($difficulty) {
            $images = array_filter($images, function ($image) use ($difficulty) {
                return $image['difficulty'] === $difficulty;
            });
        }

        // Search by title or description
        $search = $request->get('search');
        if ($search) {
            $images = array_filter($images, function ($image) use ($search) {
                return stripos($image['title'], $search) !== false ||
                       stripos($image['description'] ?? '', $search) !== false;
            });
        }

        // Get unique categories and difficulties for filters
        $categories = array_unique(array_column($images, 'category'));
        $difficulties = array_unique(array_column($images, 'difficulty'));

        return view('tibetan-rites', compact('images', 'categories', 'difficulties', 'category', 'difficulty', 'search'));
    }
}
