<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit; 

class HomeController extends Controller
{

    public function index()
    {
        $totalVisits = Visit::count();
        $uniqueVisitors = Visit::distinct('ip_address')->count('ip_address');

        return view('welcome', compact('totalVisits', 'uniqueVisitors'));
    }
    
}