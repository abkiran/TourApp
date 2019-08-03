<?php

use Illuminate\Http\Request;

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

Route::get('/tours', 'TourController@index');
Route::get('/tours/{str}', 'TourController@getTour');
Route::post('/tours', 'TourController@store');
Route::put('/tours', 'TourController@update');
Route::delete('/tours/{id}', 'TourController@deleteTour');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
