<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
// use App\Models\Visit; 

class CVGeneratorController extends Controller
{

    public function getCVGenerator(Request $request)
    {
        $CVGenerator = 'CV Generator';

        return view('cv-generator', compact('CVGenerator'));
    }
    
}