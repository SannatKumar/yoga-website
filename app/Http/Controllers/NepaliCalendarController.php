<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Models\Visit;

class NepaliCalendarController extends Controller
{
    public function getNepaliCalendar(Request $request)
    {

        $nepaliCalendar = 'Nepali Calendar';

        return view('nepali-calendar', compact('nepaliCalendar'));
    }
}
