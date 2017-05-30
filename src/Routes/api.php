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


Route::get('user', '\Frontiernxt\Controllers\API\AccountsController@user')->middleware('jwt.refresh');

Route::post('account/create', '\Frontiernxt\Controllers\API\AccountsController@store')->middleware('apiauth');

Route::post('account/authenticate', '\Frontiernxt\Controllers\API\AccountsController@authenticate')->middleware('apiauth');