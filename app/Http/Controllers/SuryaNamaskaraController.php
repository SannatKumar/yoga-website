<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SuryaNamaskara;

class SuryaNamaskaraController extends Controller
{
    public function index()
    {
        $suryaNamaskara = SuryaNamaskara::with(['steps.asana', 'benefits', 'contraindications'])
            ->orderBy('id')
            ->first();

        return view('surya-namaskara', compact('suryaNamaskara'));
    }
}
