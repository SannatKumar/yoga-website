<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
// use App\Models\Visit; 

class CoverLetterController extends Controller
{

    public function getCoverLetter(Request $request)
    {
        $coverLetter = 'Cover Letter';

        return view('cover-letter', compact('coverLetter'));
    }
    
}