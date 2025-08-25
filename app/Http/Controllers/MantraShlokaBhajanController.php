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
        ],        
        [
            'id' => 3,
            'title' => 'Sahanavavatu',
            'author' => 'Rishi Markandeya',
            'year' => '1000 BCE',
            'book' => 'Rigveda',
            'content' => 'ॐ सह नाववतु । सह नौ भुनक्तु । सह वीर्यं करवावहै । तेजस्वि नावधीतमस्तु मा विद्विषावहै । ॐ शान्तिः शान्तिः शान्तिः ॥',
            'translation' => 'We worship the three-eyed Lord Shiva, who is fragrant and nourishes all beings; may He liberate us from the bondage of worldly attachments and death, bestowing us the nectar of immortality.',
            'translation_language' => 'English'
        ],        
        [
            'id' => 4,
            'title' => 'Purnamada',
            'author' => 'Rishi Markandeya',
            'year' => '1000 BCE',
            'book' => 'Rigveda',
            'content' => 'ॐ पूर्णमदः पूर्णमिदं पूर्णात्पूर्णमुदच्यते । पूर्णस्य पूर्णमादाय पूर्णमेवावशिष्यते ॥ ॐ शान्तिः शान्तिः शान्तिः ॥',
            'translation' => 'We worship the three-eyed Lord Shiva, who is fragrant and nourishes all beings; may He liberate us from the bondage of worldly attachments and death, bestowing us the nectar of immortality.',
            'translation_language' => 'English'
        ],        
        [
            'id' => 5,
            'title' => 'Asatoma Sadgamaya',
            'author' => 'Rishi Markandeya',
            'year' => '1000 BCE',
            'book' => 'Rigveda',
            'content' => 'ॐ असतो मा सद्गमय । तमसो मा ज्योतिर्गमय । मृत्योर्मा अमृतं गमय । ॐ शान्तिः शान्तिः शान्तिः ॥',
            'translation' => 'We worship the three-eyed Lord Shiva, who is fragrant and nourishes all beings; may He liberate us from the bondage of worldly attachments and death, bestowing us the nectar of immortality.',
            'translation_language' => 'English'
        ],        
        [
            'id' => 6,
            'title' => 'Sham no Mitra',
            'author' => 'Rishi Markandeya',
            'year' => '1000 BCE',
            'book' => 'Rigveda',
            'content' => 'ॐ शं नो मित्रः शं वरुणः । शं नो भवत्वर्यमा । शं नो इन्द्रो बृहस्पतिः । शं नो विष्णुरुरुक्रमः । नमो ब्रह्मणे । नमस्ते वायो ।त्वमेव प्रत्यक्षं ब्रह्मासि । तवामेव प्रत्यक्षं ब्रह्म वदिष्यामि । ॠतं वदिष्यामि । सत्यं वदिष्यामि । तन्मामवतु । तद्वक्तारमवतु । अवतु माम् । अवतु वक्तारम् ॥ ॐ शान्तिः शान्तिः शान्तिः ॥',
            'translation' => 'We worship the three-eyed Lord Shiva, who is fragrant and nourishes all beings; may He liberate us from the bondage of worldly attachments and death, bestowing us the nectar of immortality.',
            'translation_language' => 'English'
        ],        
        [
            'id' => 6,
            'title' => 'Sarva Mangala Mangalye',
            'author' => 'Rishi Markandeya',
            'year' => '1000 BCE',
            'book' => 'Rigveda',
            'content' => 'सर्वमङ्गलमाङ्गल्ये शिवे सर्वार्थसाधिके । शरण्ये त्र्यम्बके गौरि नारायणि नमोऽस्तु ते ॥',
            'translation' => 'We worship the three-eyed Lord Shiva, who is fragrant and nourishes all beings; may He liberate us from the bondage of worldly attachments and death, bestowing us the nectar of immortality.',
            'translation_language' => 'English'
        ],        
        [
            'id' => 7,
            'title' => 'Samgacchadhwam',
            'author' => 'Rishi Markandeya',
            'year' => '1000 BCE',
            'book' => 'Rigveda',
            'content' => 'संगच्छध्वं संवदध्वं सं वो मनांसि जानताम् देवा भागं यथा पूर्वे सञ्जानाना उपासते ||',
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