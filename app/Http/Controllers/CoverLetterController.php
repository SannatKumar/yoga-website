<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Models\Visit;

class CoverLetterController extends Controller
{
    public function getCoverLetter(Request $request)
    {
        $coverLetter = 'Cover Letter';

        return view('cover-letter', compact('coverLetter'));
    }
}
