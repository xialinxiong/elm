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
Route::any("member/detail","Api\MemberController@detail");


//收货地址
Route::any("site/add","Api\SiteController@add");
Route::get("site/index","Api\SiteController@index");
Route::any("site/edit","Api\SiteController@edit");
//购物车
Route::any("cart/add","Api\CartController@add");
Route::any("cart/index","Api\CartController@index");

//订单
Route::any("order/add","Api\OrderController@add");
Route::any ("order/detail","Api\OrderController@detail");
Route::any("order/index","Api\OrderController@index");
Route::any("order/pay","Api\OrderController@pay");

//微信支付
Route::any("order/wxPay","Api\OrderController@wxPay");
//订单状态
Route::any("order/status","Api\OrderController@status");




