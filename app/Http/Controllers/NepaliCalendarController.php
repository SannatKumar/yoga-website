<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
// use App\Models\Visit; 

class NepaliCalendarController extends Controller
{

    public function getNepaliCalendar(Request $request)
    {



        $nepaliCalendar = 'Nepali Calendar';

        return view('nepali-calendar', compact('nepaliCalendar'));
    }
    
}