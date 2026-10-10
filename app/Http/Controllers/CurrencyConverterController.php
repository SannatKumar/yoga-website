<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Models\Visit;

class CurrencyConverterController extends Controller
{
    public function getCurrencyConverter(Request $request)
    {

        $currencyConverter = 'Currency Converter';

        return view('currency-converter', compact('currencyConverter'));
    }
}
