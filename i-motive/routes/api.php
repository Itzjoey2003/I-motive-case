<?php

use App\Http\Controllers\API\V1\LeadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\API\V1'], function() {
    Route::apiResource('leads', LeadController::class);
    }
);

Route::post('/leads', [LeadController::class, 'store'])->name('lead.store');
Route::put('api/v1/leads/{lead}',[LeadController::class, 'update'])->name('lead.update', 'lead.id');