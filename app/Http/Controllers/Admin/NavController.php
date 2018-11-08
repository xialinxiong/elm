<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class NavController extends BaseController
{
    //导航条显示
    public function index()
    {

      $data=Nav::all();
        return view("admin.nav.index",compact('data'));
    }
//导航条增加
    public function  add(Request $request)
    {
        //声明一个空数组用来装路由名字
        $urls=[];
//    dd($urls);
        //得到所有路由
        $roles=Route::getRoutes();
        //循环得到单个路径
        foreach ($roles as $role){
            //判断命名空间是 后台的
            if ($role->action["namespace"]=="App\Http\Controllers\Admin"){
                //取别名存到$urls中
                $urls[]=$role->action['as'];
            }

        }
        //从数据库取出已经存在的
        $perss=Nav::pluck("url")->toArray();
        //已经存在的从$urls中去掉
        $urls=array_diff($urls,$perss);

        if($request->isMethod("post")) {
            $data = $request->post();
//            dd($data);
            Nav::create($data);
        }
        $navs=Nav::where("pid",0)->get();
//        dd($navs);
            return view("admin.nav.add",compact('urls','navs'));
   }


}
