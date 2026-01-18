<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Customer; 

class CustomerController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function uploadExcel(Request $request)
    {
        $requestData = $request->all();
        // $validated = $request->validate([
        //     'FirstName' => 'required|string|max:255',
        //     'LastName'  => 'required|string|max:255',
        //     'Email'     => 'required|email|unique:customers,Email',
        //     'Phone'     => 'nullable|string|max:50',
        //     'Country'   => 'required|string|max:100',
        //     'SignupDate'=> 'nullable|date',
        // ]);

        // $customer = Customer::create($validated);

        return response()->json([
            'message' => 'Customer created successfully',
            'request' => $requestData
            //'data' => $customer
        ], 201);
    }

}
