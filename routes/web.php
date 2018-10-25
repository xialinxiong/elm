<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::domain("elm.shop.com")->namespace("Shop")->group(function (){
    Route::any("user/reg","UserController@reg")->name("shop.user.reg");
    Route::any("user/edit","UserController@edit")->name("shop.user.edit");
    Route::get("user/index","UserController@index")->name("shop.user.index");
    Route::any("user/login","UserController@login")->name("shop.user.login");
    Route::get("user/logout","UserController@logout")->name("shop.user.logout");

});

Route::domain("elm.admin.com")->namespace("Admin")->group(function (){
//    分类
    Route::get("category/index","CategoryController@index")->name("admin.category.index");
    Route::any("category/add","CategoryController@add")->name("admin.category.add");
    Route::any("category/edit/{id}","CategoryController@edit")->name("admin.category.edit");
    Route::get("category/del/{id}","CategoryController@del")->name("admin.category.del");
//店铺
    Route::get("store/index","StoreController@index")->name("admin.store.index");
    Route::any("store/edit/{id}","StoreController@edit")->name("admin.store.edit");
    Route::get("store/del/{id}","StoreController@del")->name("admin.store.del");
    Route::any("store/shen/{id}","StoreController@shen")->name("admin.store.shen");
    //用户
    Route::get("user/index","UserController@index")->name("admin.user.index");
    Route::any("user/edit/{id}","UserController@edit")->name("admin.user.edit");
    Route::get("user/del/{id}","UserController@del")->name("admin.user.del");
});


Route::domain("elm.shop.com")->namespace("Shop")->group(function (){

    Route::any("store/add","StoreController@add")->name("shop.store.add");
    Route::get("store/index","StoreController@index")->name("shop.store.index");


});