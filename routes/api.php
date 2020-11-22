<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Vehicles

// List vehicles
Route::get('vehicles', 'App\Http\Controllers\VehicleController@index');

// Create a new brand
Route::post('brand', 'App\Http\Controllers\BrandController@store');

// Edit brand
Route::put('brand', 'App\Http\Controllers\BrandController@store');

// Delete brand
Route::delete('brand/{id}', 'App\Http\Controllers\BrandController@destroy');

// Vehicle_models
Route::get('vehicle_model', 'App\Http\Controllers\VehicleModelController@index');
