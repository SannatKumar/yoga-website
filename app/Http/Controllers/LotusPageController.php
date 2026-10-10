<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LotusPageController extends Controller
{
    private $lotus = [
        [
            'title' => 'Mooladhara',   // Root Chakra
            'text' => 'Four Petals',
            'color' => 'red',
        ],
        [
            'title' => 'Swadhisthana', // Sacral Chakra
            'text' => 'Six Petals',
            'color' => 'orange',
        ],
        [
            'title' => 'Manipura',     // Solar Plexus Chakra
            'text' => 'Ten Petals',
            'color' => 'yellow',
        ],
        [
            'title' => 'Anahata',      // Heart Chakra
            'text' => 'Twelve Petals',
            'color' => 'green',
        ],
        [
            'title' => 'Vishuddhi',    // Throat Chakra
            'text' => 'Sixteen Petals',
            'color' => 'blue',
        ],
        [
            'title' => 'Ajna',         // Third Eye Chakra
            'text' => 'Two Petals',
            'color' => 'indigo',
        ],
        [
            'title' => 'Sahasrara',    // Crown Chakra
            'text' => 'Thousand Petals',
            'color' => 'violet',
        ],
    ];

    public function getLotus(Request $request)
    {
        $lotus = $this->lotus;

        return view('lotus-page', compact('lotus'));
    }
}
