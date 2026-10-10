<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruStutiController extends Controller
{
    private $guruStutis = [
        [
            'title' => 'Guru Brahma',
            'text' => 'गुरु ब्रह्मा गुरु विष्णुः गुरु देवो महेश्वरः। गुरु साक्षात् परब्रह्म तस्मै श्री गुरवे नमः॥',
            'color' => 'purple-700',
        ],
        [
            'title' => 'Agyan Timirandhasya',
            'text' => 'अज्ञानतिमिरान्धस्य ज्ञानाञ्जनशालाकया। चक्षुरुन्मीलितं येन तस्मै श्रीगुरवे नमः॥',
            'color' => 'blue-700',
        ],
        [
            'title' => 'Yogena Chittasya – Patanjali Stotra',
            'text' => 'योगेन चित्तस्य पदेन वाचां मलं शरीरस्य च वैद्यकेन। योऽपाकरोत्तं प्रवरं मुनीनां पतञ्जलिं प्राञ्जलिरानतोऽस्मि॥',
            'color' => 'green-700',
        ],
        [
            'title' => 'Asato Ma Sadgamaya',
            'text' => 'असतो मा सद्गमय। तमसो मा ज्योतिर्गमय। मृत्योर् मा अमृतं गमय॥',
            'color' => 'red-700',
        ],
        [
            'title' => 'Om Shree Gurubhyo Namaha',
            'text' => 'ॐ श्री गुरुभ्यो नमः॥',
            'color' => 'indigo-700',
        ],
        [
            'title' => 'अखण्ड-मण्डलाकारम्',
            'text' => 'अखण्ड-मण्डलाकारम् व्याप्तम् येन चराचरम्। तत्पदम् दर्शितम् येन तस्मै श्री गुरवे नमः॥',
            'color' => 'indigo-700',
        ],
    ];

    public function getGuruStuti(Request $request)
    {
        $guruStutis = $this->guruStutis;

        return view('guru-stuti', compact('guruStutis'));
    }
}
