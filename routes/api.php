<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/upload-excel', [CustomerController::class, 'uploadExcel']);

Route::post('/upload-xml', [CustomerController::class, 'uploadXml']);
