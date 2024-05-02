<?php

use App\Http\Livewire\Product\Index;
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

Route::get('/product', 'ApiController@index');
Route::get('/product/{id}', 'ApiController@show');
Route::post('/product', 'ApiController@store');
Route::put('/product/{product}', 'ApiController@update');


