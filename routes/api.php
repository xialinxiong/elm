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

Route::any("store/index","Api\StoreController@index");
Route::any("store/detail","Api\StoreController@detail");
Route::any("member/reg","Api\MemberController@reg");
Route::get("member/sms","Api\MemberController@sms");
Route::any("member/login","Api\MemberController@login");
Route::any("member/edit","Api\MemberController@edit");
Route::any("member/forget","Api\MemberController@forget");