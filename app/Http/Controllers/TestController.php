<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //getAsanas
    public function getAsanas(Request $request)
    {
        // Optional: you can apply filters if query parameters are passed
        $query = Gallery::query();

        if ($request->has('tag_id')) {
            $query->where('tag_id', $request->tag_id);
        }

        if ($request->has('time_of_the_day_id')) {
            $query->where('time_of_the_day_id', $request->time_of_the_day_id);
        }

        if ($request->has('source_id')) {
            $query->where('source_id', $request->source_id);
        }

        // Fetch all matching records
        $asanas = $query->get();

        // Return as JSON
        return response()->json(['result' => $asanas], 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Write function to create a new resource.
     */
    //addAsanas
    public function addAsanas(Request $request)
    {
        //Take all the asanas Data
        $asanaName = $request->asana_name;
        $asanaDescription = $request->asana_description;
        $sourceId = $request->source_id;
        $stepsId = $request->steps_id;
        $tagId = $request->tag_id;
        $timeOftheDayId = $request->time_of_the_day_id;
        $referenceId = $request->reference_id;

        $gallery = Gallery::create([
            'asana_name' => $asanaName,
            'asana_description' => $asanaDescription,
            'source_id' => $sourceId,
            'steps_id' => $stepsId,
            'tag_id' => $tagId,
            'time_of_the_day_id' => $timeOftheDayId,
            'reference_id' => $referenceId,
        ]);



        return response()->json(['result' => $gallery], 200)
        ->header('Content-Type', 'application/json' );
    }

    /**
     * Update the specified resource in storage.
     */
    //updateAsanas
    public function updateAsanas(Request $request)
    {
        $asanaId = $request->id;
            // Find the asana by ID
        $asana = Gallery::find($asanaId);

        // Check if record exists
        if (!$asana) {
            return response()->json(['message' => 'Asana not found'], 404);
        }

        // Update fields (only those passed)
        $asana->update([
            'asana_name' => $request->asana_name ?? $asana->asana_name,
            'asana_description' => $request->asana_description ?? $asana->asana_description,
            'source_id' => $request->source_id ?? $asana->source_id,
            'steps_id' => $request->steps_id ?? $asana->steps_id,
            'category_id' => $request->category_id ?? $asana->category_id,
            'tag_id' => $request->tag_id ?? $asana->tag_id,
            'time_of_the_day_id' => $request->time_of_the_day_id ?? $asana->time_of_the_day_id,
            'reference_id' => $request->reference_id ?? $asana->reference_id,
        ]);

        return response()->json([
            'message' => 'Asana updated successfully',
            'result' => $asana,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
        //deleteAsanas
    public function deleteAsanas(Request $request)
    {
        $asanaId = $request->id;
        $asana = Gallery::find($asanaId);

        if (!$asana) {
            return response()->json(['message' => 'Asana not found'], 404);
        }

        $asana->delete();

        return response()->json(['message' => 'Asana deleted successfully'], 200);
    }
}
