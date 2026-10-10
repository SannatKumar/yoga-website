<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Models\Visit;

class CVGeneratorController extends Controller
{
    public function getCVGenerator(Request $request)
    {
        $CVGenerator = 'CV Generator';

        return view('cv-generator', compact('CVGenerator'));
    }
}
