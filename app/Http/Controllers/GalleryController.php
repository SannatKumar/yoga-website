<?php

namespace App\Http\Controllers;

use App\Models\Asana;
use App\Models\AsanaStep;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        // Real asana data from the database, replacing the old hardcoded sample array.
        // Scoped to practice_type_id 1 (Asana) — Sukshma Vyayama, Sthula Vyayama, and
        // Tibetan Rite practices now share this table but don't belong on the asana gallery.
        $images = Asana::with(['category', 'difficultyLevel', 'tags', 'images'])
            // ->where('practice_type_id', 1)
            ->get()
            ->map(function ($asana) {
                $primaryImage = $asana->images->firstWhere('is_primary', true) ?? $asana->images->first();

                return [
                    'id' => $asana->id,
                    'title' => $asana->asana_name,
                    'description' => $asana->asana_description,
                    'image_url' => $primaryImage ? '/'.ltrim($primaryImage->image_path, '/') : '/lotus-images/blank_image.png',
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

        return view('gallery', compact('images', 'categories', 'difficulties', 'category', 'difficulty', 'search'));
    }

    // getAsanaWithDetails
    public function getAsanaWithDetails(int $id)
    {
        $asana = Asana::with([
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
            'image_url' => $primaryImage ? '/'.ltrim($primaryImage->image_path, '/') : null,
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

    // addAsanas
    public function addAsanas(Request $request)
    {
        // Take all the asanas Data
        $asanaName = $request->asana_name;
        $asanaDescription = $request->asana_description;
        $sourceId = $request->source_id;
        $categoryId = $request->category_id;
        $difficultyId = $request->difficulty_id;
        $timeOftheDayId = $request->time_of_the_day_id;
        $referenceId = $request->reference_id;

        $asana = Asana::create([
            'asana_name' => $asanaName,
            'asana_description' => $asanaDescription,
            'source_id' => $sourceId,
            'category_id' => $categoryId,
            'difficulty_id' => $difficultyId,
            'time_of_the_day_id' => $timeOftheDayId,
            'reference_id' => $referenceId,
        ]);

        return response()->json(['result' => $asana], 200)
            ->header('Content-Type', 'application/json');
    }

    // addAsanaSteps
    public function addAsanaSteps(Request $request)
    {
        // Take the asanas_id and the full ordered list of steps for that asana
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
            ->header('Content-Type', 'application/json');
    }
}
