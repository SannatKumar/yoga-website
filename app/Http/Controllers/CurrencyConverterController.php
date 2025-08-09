<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
// use App\Models\Visit; 

class CurrencyConverterController extends Controller
{

    public function getCurrencyConverter(Request $request)
    {



        $currencyConverter = 'Currency Converter';

        return view('currency-converter', compact('currencyConverter'));
    }
    
}