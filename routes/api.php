<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\TourController;

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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('test', function () {
        return 'It is ok';
    });

    $api->get('/tours', 'App\Http\Controllers\Api\TourController@index');
    $api->get('/tours/{str}', 'App\Http\Controllers\Api\TourController@getTour');
    $api->post('/tours', 'App\Http\Controllers\Api\TourController@store');
    $api->put('/tours', 'App\Http\Controllers\Api\TourController@update');
    $api->delete('/tours/{id}', 'App\Http\Controllers\Api\TourController@destroyTour');
});

// $api->middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
