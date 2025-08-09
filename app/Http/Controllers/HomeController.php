<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Visit; 

class HomeController extends Controller
{

    public function index()
    {
        $totalVisits = Visit::count();
        $uniqueVisitors = Visit::distinct('ip_address')->count('ip_address');


        $yogaIntroCards = [
        [
            'title' => 'What is Yoga?',
            'text' => 'Yoga means union—of breath, body, and awareness. It’s a way of being, not just doing.',
            'color' => 'green-600',
        ],
        [
            'title' => 'Why Yoga?',
            'text' => 'To connect, balance, heal and understand life deeply—on and off the mat.',
            'color' => 'blue-600',
        ],
        [
            'title' => 'When Yoga?',
            'text' => 'Any moment that invites awareness becomes your yoga. It’s timeless.',
            'color' => 'purple-600',
        ],
        [
            'title' => 'How Yoga?',
            'text' => 'With the breath, through movement, in stillness—guided by presence.',
            'color' => 'yellow-600',
        ],
        [
            'title' => 'Where Yoga?',
            'text' => 'Here. Now. In your body, in your breath, wherever you are.',
            'color' => 'red-600',
        ],
    ];

        return view('welcome', compact('totalVisits', 'uniqueVisitors', 'yogaIntroCards'));
    }
    
}