<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
// use App\Models\Visit; 

class MantraShlokaBhajanController extends Controller
{
    private $mantraData = [
        [
            'id' => 1,
            'title' => 'Gayatri Mantra',
            'author' => 'Maharishi Vishvamitra',
            'year' => '1500 BCE',
            'book' => 'Rigveda',
            'content' => 'ॐ भूर्भुवः स्वः तत्सवितुर्वरेण्यं भर्गो देवस्य धीमहि। धियो यो नः प्रचोदयात्॥',
            'translation' => 'We meditate on the glory of the Creator; who has created the Universe; who is worthy of Worship; who is the embodiment of Knowledge and Light; who is the remover of all Sin and Ignorance. May He enlighten our intellect.',
            'translation_language' => 'English'
        ],
        [
            'id' => 2,
            'title' => 'Mahamrityunjaya Mantra',
            'author' => 'Rishi Markandeya',
            'year' => '1000 BCE',
            'book' => 'Rigveda',
            'content' => 'ॐ त्र्यम्बकं यजामहे सुगन्धिं पुष्टिवर्धनम्। उर्वारुकमिव बन्धनान्मृत्योर्मुक्षीय माऽमृतात्॥',
            'translation' => 'We worship the three-eyed Lord Shiva, who is fragrant and nourishes all beings; may He liberate us from the bondage of worldly attachments and death, bestowing us the nectar of immortality.',
            'translation_language' => 'English'
        ]
    ];

    public function getMantraShlokaBhajan(Request $request)
    {
        $mantraShlokaBhajan = 'Mantra Shloka Bhajan';

            $mantras = collect($this->mantraData)
                ->map(function ($item) {
                    return (object) $item;
                });

        return view('mantra-shloka-bhajan', ['mantras' => $mantras]);
    }


    //Mantra Shloka Bhajan Content

    public function getMantraShlokaBhajanContent($id)
    {
        Log::info('It came here');

        // Log::info('RequestID:'.$lang);
        Log::info('RequestID:'.$id);


        $mantra = collect($this->mantraData)->firstWhere('id', $id);

        // $mantraShlokaBhajanContent = 'Mantra Shloka Bhajan Content';

        return view('mantra-shloka-bhajan-content', ['mantra' => (object) $mantra]);
    }
    
}