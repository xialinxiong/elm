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
    Route::get("user/index","UserController@index")->name("shop.user.index");
    Route::any("user/login","UserController@login")->name("shop.user.login");

});

Route::domain("elm.admin.com")->namespace("Admin")->group(function (){
    Route::get("category/index","CategoryController@index")->name("admin.category.index");
    Route::any("category/add","CategoryController@add")->name("admin.category.add");
    Route::any("category/edit/{id}","CategoryController@edit")->name("admin.category.edit");
    Route::get("category/del/{id}","CategoryController@del")->name("admin.category.del");
});


Route::domain("elm.shop.com")->namespace("Shop")->group(function (){

    Route::any("store/add","StoreController@add")->name("shop.store.add");
    Route::get("store/index","StoreController@index")->name("shop.store.index");


});