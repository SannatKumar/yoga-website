<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Customer; 

class CustomerController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function uploadExcel(Request $request)
    {
        $requestData = $request->all();
        Log::info('Upload Excel request data', [
            'type' => gettype($requestData),
            'data' => $requestData,
        ]);

        $data = $request->input('data');

        if(!is_array($data)){
            return response()->json(['error' => 'Invalid Data Format'], 400);
        }

        $createdCount = 0;
        foreach ($data as $row) {

        Log::info('Upload Excel request data', [
            'type' => gettype($row),
            'data' => $row,
            'first' => $row[0],
        ]);
        if($createdCount > 0)
        {
            Customer::create([
                'FirstName'  => $row[1] ?? null,
                'LastName'   => $row[2] ?? null,
                'Email'      => $row[3] ?? null,
                'Phone'      => $row[4] ?? null,
                'Country'    => $row[5] ?? null,
                'SignupDate' => now(),
            ]);    
        }
        $createdCount++;
        }


        return response()->json([
            'message' => 'Customer created successfully',
            'request' => $requestData,
            'successRows' => $createdCount,
            //'data' => $customer
        ], 201);
    }

}
