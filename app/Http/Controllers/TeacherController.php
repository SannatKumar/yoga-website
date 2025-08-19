<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TeacherController extends Controller
{
        private $teachers = [
        [
            'id' => 1,
            'name' => 'Jasmine',
            'photo' => '/images/natural_scene/bee_and_flower.jpeg',
            'title' => 'IYA Certified Yoga Teacher',
            'bio' => 'Jasmine specializes in restorative and prenatal yoga...',
            'social' => ['instagram' => 'https://instagram.com/jasmine.yoga'],
            'tagline' => 'Example Tag line',
            'certificates' => [
                    'RYT-200 from Yoga Alliance (2020)',
                    'Prenatal Yoga Certification – Shakti Institute (2021)',
                    'Mindfulness Meditation Training (2022)'
            ],
            'dob' => '1990-06-15',
            'qualifications' => ['M.A. in Psychology', 'Certified Ayurveda Practitioner']
        ],
        [
            'id' => 2,
            'name' => 'Mango',
            'photo' => '/images/natural_scene/northern_lights_first.jpeg',
            'title' => 'IYA Certified Yoga Teacher',
            'bio' => 'Mango brings a playful spirit...',
            'social' => ['facebook' => 'https://facebook.com/mangoyoga'],
                        'tagline' => 'Example Tag line',
            'certificates' => [
                    'RYT-200 from Yoga Alliance (2020)',
                    'Prenatal Yoga Certification – Shakti Institute (2021)',
                    'Mindfulness Meditation Training (2022)'
            ],
            'dob' => '1990-06-15',
            'qualifications' => ['M.A. in Psychology', 'Certified Ayurveda Practitioner']
        ],
        [
            'id' => 3,
            'name' => 'Apple',
            'photo' => '/images/natural_scene/blue_sky_forest_and_lake.jpeg',
            'title' => 'IYA Certified Yoga Teacher',
            'bio' => 'Apple is passionate about yoga for mental health...',
            'social' => ['website' => 'https://appleyoga.com'],
        ],
        [
            'id' => 4,
            'name' => 'Coconut',
            'photo' => '/images/natural_scene//fire_and_lake.jpeg',
            'title' => 'IYA Certified Yoga Teacher',
            'bio' => 'Coconut is a yoga therapist and anatomy expert...',
            'social' => [
                'instagram' => 'https://instagram.com/coconutyoga',
                'facebook' => 'https://facebook.com/coconutyoga',
            ],
        ],
        [
            'id' => 5,
            'name' => 'Raj Kumar',
            'photo' => '/images/natural_scene/grass_and_sun.jpeg',
            'title' => 'IYA Certified Yoga Teacher',
            'bio' => 'Raj is a certified yoga instructor...',
            'social' => [
                'instagram' => 'https://instagram.com/rajyoga',
                'facebook' => 'https://facebook.com/rajyoga',
                'website' => 'https://rajyoga.com',
            ],
        ],
    ];

    public function index()
    {
        $teachers = $this->teachers;
        return view('info', compact('teachers'));
    }
/*
    public function getTeacher(Request $request, $id, $lang)
    {

        dd($id);
        $data = $request->headers->all();
        $url = $request->fullUrl();

        Log::info('Request Data: ' . $url);
        Log::info('Request Data: ' . json_encode($data));
        $id = 1;
        // Log::info($id);
        if (!isset($this->teachers[$id])) {
            abort(404);
        }

        // Log::info("Id", (string)$id);
        dd($id);
        Log::info($this->teachers);
        $teacher = (object)$this->teachers[$id];
        // Log::inf("Teacher", (array)$teacher);
        if (!empty($teacher->dob)) {
            $teacher->dob = Carbon::parse($teacher->dob);
        }
        Log::info("Teacher:", (array)$teacher);
        return view('teacher-profile', compact('teacher'));
    }*/
        public function getTeacher(Request $request, $id)
{
    $id = $id-1;

    // Check if teacher exists
    if (!isset($this->teachers[$id])) {
        Log::warning("Teacher ID $id not found.");
        abort(404);
    }

    // Load teacher and convert to object
    $teacher = (object)$this->teachers[$id];

    Log::info(gettype($teacher));

    // Handle DOB if present
    if (!empty($teacher->dob)) {
        try {
            $teacher->dob = \Carbon\Carbon::parse($teacher->dob);
        } catch (\Exception $e) {
            Log::error('DOB Parse Error: ' . $e->getMessage());
        }
    }
    return view('teacher-profile', compact('teacher'));
}

}
