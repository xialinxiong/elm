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
    return view('index');
});
Route::domain("elm.shop.com")->namespace("Shop")->group(function (){
    Route::any("activity/index","ActivityController@index")->name("shop.activity.index");


    Route::any("user/reg","UserController@reg")->name("shop.user.reg");
    Route::any("user/edit","UserController@edit")->name("shop.user.edit");
    Route::get("user/index","UserController@index")->name("shop.user.index");
    Route::any("user/login","UserController@login")->name("shop.user.login");
    Route::get("user/logout","UserController@logout")->name("shop.user.logout");

    //菜单分类
    Route::get("mc/index","MenuCategoriesController@index")->name("shop.mc.index");
    Route::any("mc/add","MenuCategoriesController@add")->name("shop.mc.add");
    Route::any("mc/edit/{id}","MenuCategoriesController@edit")->name("shop.mc.edit");
    Route::get("mc/del/{id}","MenuCategoriesController@del")->name("shop.mc.del");

    //菜单
    Route::get("menu/index","MenuController@index")->name("shop.menu.index");
    Route::any("menu/add","MenuController@add")->name("shop.menu.add");
    Route::any("menu/upload","MenuController@upload")->name("shop.menu.upload");
    Route::any("menu/edit/{id}","MenuController@edit")->name("shop.menu.edit");
    Route::get("menu/del/{id}","MenuController@del")->name("shop.menu.del");
    //订单管理
    Route::get("order/index","OrderController@index")->name("shop.order.index");
    Route::any("order/cancel/{id}","OrderController@cancel")->name("shop.order.cancel");
    Route::any("order/hair/{id}/{status}","OrderController@hair")->name("shop.order.hair");

    //订单量
    Route::any("order/day","OrderController@day")->name("shop.order.day");
    Route::get("order/month","OrderController@month")->name("shop.order.month");
    Route::get("order/total","OrderController@total")->name("shop.order.total");
    //菜品量
    Route::get("order/cday","OrderController@cday")->name("shop.order.cday");
    Route::get("order/cmonth","OrderController@cmonth")->name("shop.order.cmonth");
    Route::get("order/ctotal","OrderController@ctotal")->name("shop.order.ctotal");
});

Route::domain("elm.admin.com")->namespace("Admin")->group(function (){
    //登陆
    Route::any("admin/login","AdminController@login")->name("admin.admin.login");
    Route::any("admin/edit","AdminController@edit")->name("admin.admin.edit");
    Route::get("admin/logout","AdminController@logout")->name("admin.admin.logout");
//    分类
    Route::get("category/index","CategoryController@index")->name("admin.category.index");
    Route::any("category/add","CategoryController@add")->name("admin.category.add");
    Route::any("category/upload","CategoryController@upload")->name("admin.category.upload");
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
    Route::any("user/add/{id}","UserController@add")->name("admin.user.add");
    //活动
    Route::any("activity/index","ActivityController@index")->name("admin.activity.index");
    Route::any("activity/add","ActivityController@add")->name("admin.activity.add");
    Route::any("activity/edit/{id}","ActivityController@edit")->name("admin.activity.edit");
    Route::get("activity/del/{id}","ActivityController@del")->name("admin.activity.del");
    //会员管理
    Route::any("member/index","MemberController@index")->name("admin.member.index");
    Route::get("member/del/{id}","MemberController@del")->name("admin.member.del");
    Route::any("order/index","OrderController@index")->name("admin.order.index");

    //权限管理
    Route::any("permission/add","PermissionController@add")->name("admin.permission.add");
    Route::any("permission/edit/{id}","PermissionController@edit")->name("admin.permission.edit");
    Route::get("permission/del/{id}","PermissionController@del")->name("admin.permission.del");
    Route::get("permission/index","PermissionController@index")->name("admin.permission.index");

    //角色管理
    Route::any("role/add","RoleController@add")->name("admin.role.add");
    Route::any("role/edit/{id}","RoleController@edit")->name("admin.role.edit");
    Route::get("role/del/{id}","RoleController@del")->name("admin.role.del");
    Route::get("role/index","RoleController@index")->name("admin.role.index");
    //后台用户首页
    Route::get("admin/index","AdminController@index")->name("admin.admin.index");
    Route::any("admin/add","AdminController@add")->name("admin.admin.add");
    Route::any("admin/xiu/{id}","AdminController@xiu")->name("admin.admin.xiu");
    Route::get("admin/del/{id}","AdminController@del")->name("admin.admin.del");

});


    Route::domain("elm.shop.com")->namespace("Shop")->group(function (){
    Route::any("store/add","StoreController@add")->name("shop.store.add");
    Route::get("store/index","StoreController@index")->name("shop.store.index");


});