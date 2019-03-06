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

Route::post('/signUp', 'ApiController@signUp');
Route::post('/login', 'ApiController@login');
Route::post('/getProfile', 'ApiController@getProfile');
Route::post('/forgotPassword', 'ApiController@forgotPassword');
Route::post('/updateProfile', 'ApiController@updateProfile');
Route::post('/changePassword', 'ApiController@changePassword');
Route::post('/createWallet', 'ApiController@createWallet');
Route::post('/payment', 'ApiController@payment');
Route::post('/importWallet', 'ApiController@importWallet');
