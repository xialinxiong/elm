<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function __construct()
    {
        //中间件auth:admin
        $this->middleware("auth:admin",[
            "except"=>["login"]
        ]);

        $this->middleware(function ($request, \Closure $next){
        //有没有权限
            //得到路由
            $route=Route::currentRouteName();
         //设置白名单 登陆 注销 修改密码
            $allow=[
                "admin.admin.login",
                "admin.admin.logout",
                "admin.admin.edit"
            ];
            //要保证在白名单 并且 有权限 而且 Id==1
            if (!in_array($route,$allow) &&!Auth::guard("admin")->user()->can($route) && Auth::guard("admin")->id()!=1){
                exit(view("admin.admin.fuck"));
            }

            return $next($request);

        });


    }
}
