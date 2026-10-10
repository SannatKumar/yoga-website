<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class ShowAsanaController extends Controller
{
    public function getAsana(Request $request)
    {
        $asana = [
            [
                'id' => 1,
                'title' => 'Step 1: Choose Your Sacred Space',
                'text' => 'Begin by finding a clean, quiet space where you can practice undisturbed. Use a yoga mat or any clean, comfortable surface.',
                'reference' => 'Yoga Sutras I.12 – Abhyasa Vairagya',
            ],
            [
                'id' => 2,
                'title' => 'Step 2: Begin with Guru Stuti',
                'text' => 'Before diving into physical movements, take a moment to honor your lineage. Chant a guru mantra or sit silently in gratitude.',
                'reference' => 'Tradition of Himalayan Yogis',
            ],
            [
                'id' => 3,
                'title' => 'Step 3: Start with Sukshma Vyayama',
                'text' => 'Gentle joint movements awaken energy channels. Rotate your neck, wrists, and ankles slowly while synchronizing with your breath.',
                'reference' => 'Swami Dhirendra Brahmachari – Yoga Sopan',
            ],
            [
                'id' => 4,
                'title' => 'Step 4: Move into Standing Asanas',
                'text' => 'Perform Tadasana, Trikonasana, and other standing poses to build energy and improve alignment.',
                'reference' => 'Hatha Yoga Pradipika II.33',
            ],
            [
                'id' => 5,
                'title' => 'Step 5: Transition to Seated Asanas',
                'text' => 'Sit in Padmasana, Vajrasana, or Siddhasana. These poses cultivate stillness and prepare the mind for deeper practices.',
                'reference' => 'Gheranda Samhita I.13',
            ],
            [
                'id' => 6,
                'title' => 'Step 6: End with Supine and Savasana',
                'text' => 'Lie down in Savasana to integrate all the physical and energetic work. Allow the body to rest completely.',
                'reference' => 'Modern Yoga Therapy Manuals',
            ],
            [
                'id' => 7,
                'title' => 'Step 7: Practice Pranayama',
                'text' => 'Perform Kapalbhati, Bhastrika, and Anuloma Viloma with awareness and ease. Focus on your breath and energy.',
                'reference' => 'Swami Sivananda – The Science of Pranayama',
            ],
            [
                'id' => 8,
                'title' => 'Step 8: Perform Mudras & Bhramari',
                'text' => 'Practice Prana Mudra, Chin Mudra, and Bhramari to activate inner energy and settle your nervous system.',
                'reference' => 'Hatha Yoga Pradipika III.82',
            ],
            [
                'id' => 9,
                'title' => 'Step 9: Enter Silence',
                'text' => 'Allow your awareness to dissolve in mantra chanting or visualization of your chosen deity. This is the meditative core.',
                'reference' => 'Bhagavad Gita VI.20',
            ],
            [
                'id' => 10,
                'title' => 'Final Step: Closing with Gratitude',
                'text' => 'Chant the ending mantra and offer your gratitude to the practice, the body, the breath, and the lineage.',
                'reference' => 'Upanishadic Practice Rituals',
            ],
        ];

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
            [
                'title' => 'For Whom Yoga?',
                'text' => 'Every living being',
                'color' => 'red-600',
            ],
        ];

        $philosophyHighlights = [
            [
                'title' => 'Yamas & Niyamas',
                'excerpt' => 'Core ethical precepts that guide daily practice and mindset toward clarity and compassion.',
                'href' => route('philosophy').'#yamas-niyamas',
                'image' => '/images/yogamudra.png',
            ],
            [
                'title' => 'Eight Limbs of Yoga',
                'excerpt' => 'A holistic path from discipline and posture to breath, focus, and meditative absorption.',
                'href' => route('philosophy').'#ashtanga',
                'image' => '/images/virasana.jpeg',
            ],
            [
                'title' => 'Kriya & Purification',
                'excerpt' => 'Cleansing practices to prepare body and mind for deeper yoga and meditation.',
                'href' => route('philosophy').'#kriya',
                'image' => '/images/tadasana.jpeg',
            ],
            [
                'title' => 'Meditation & Samadhi',
                'excerpt' => 'Cultivating steady attention leading to stillness, insight, and integration.',
                'href' => route('philosophy').'#samadhi',
                'image' => '/images/Matsyasana.jpeg',
            ],
        ];

        return view('show-asana', compact('asana', 'totalVisits', 'uniqueVisitors', 'yogaIntroCards', 'philosophyHighlights'));
    }
}
