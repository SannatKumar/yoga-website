<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        if (! is_array($data)) {
            return response()->json(['error' => 'Invalid Data Format'], 400);
        }

        $createdCount = 0;
        foreach ($data as $row) {

            Log::info('Upload Excel request data', [
                'type' => gettype($row),
                'data' => $row,
                'first' => $row[0],
            ]);
            if ($createdCount > 0) {
                Customer::create([
                    'FirstName' => $row[1] ?? null,
                    'LastName' => $row[2] ?? null,
                    'Email' => $row[3] ?? null,
                    'Phone' => $row[4] ?? null,
                    'Country' => $row[5] ?? null,
                    'SignupDate' => now(),
                ]);
            }
            $createdCount++;
        }

        return response()->json([
            'message' => 'Customer created successfully',
            'request' => $requestData,
            'successRows' => $createdCount,
            // 'data' => $customer
        ], 201);
    }

    // Upload Xml
    public function uploadXml(Request $request)
    {

        $request->validate([
            'xml' => 'required|string',
        ]);

        $xmlString = $request->input('xml');

        try {
            // Parse XML string
            $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);
            $json = json_encode($xml); // optional convert to JSON
            $data = json_decode($json, true); // associative array

            // Example: just log it
            Log::info('Uploaded XML Data:', $data);

            // TODO: save $data to DB or handle as needed

            return response()->json([
                'message' => 'XML processed successfully',
                'data' => $data, // optional
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to parse XML',
                'error' => $e->getMessage(),
            ], 400);
        }

    }
}
