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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('1', 'Tp1@rqt1');
Route::get('2', 'Tp1@rqt2');
Route::get('3', 'Tp1@rqt3');
Route::get('4', 'Tp1@rqt4');
Route::get('5', 'Tp1@rqt5');
Route::get('6', 'Tp1@rqt6');
Route::get('7', 'Tp1@rqt7');
Route::get('8', 'Tp1@rqt8');
Route::get('9', 'Tp1@rqt9');
Route::get('10', 'Tp1@rqt10');
Route::get('11', 'Tp1@rqt11');
