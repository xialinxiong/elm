<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends BaseController
{
    public function index()
    {
        $data=Permission::all();
        return view("admin.permission.index",compact("data"));
    }
    //添加权限
    public function add(Request $request)
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
//dd($urls);
        //从数据库取出已经存在的
        $nav=Nav::pluck("name")->toArray();
        //已经存在的从$urls中去掉
        $urls=array_diff($urls,$nav);

        if ($request->isMethod("post")){
        $data=$request->post();
        $data['guard_name']="admin";
        Permission::create($data);
    }
//        dd($urls);
    return view("admin.permission.add",compact("urls"));
}
//修改
    public function edit(Request $request,$id)
    {
        $per=Permission::find($id);
        if ($request->isMethod("post")){
            $data=$request->post();
            $data['guard_name']="admin";
//            dd($data);
           $per->update($data);
            return redirect()->route('admin.permission.index')->with('success', '修改' . $per->intro . "成功");
        }

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
//dd($urls);
        //从数据库取出已经存在的
        $pers=Permission::pluck("name")->toArray();
        //已经存在的从$urls中去掉
        $urls=array_diff($urls,$pers);
        $urls[]=$per->name;
//        dd($urls);
        return view("admin.permission.edit",compact("per","urls"));
    }

    //删除
    public function del($id)
    {
        $per=Permission::find($id);
        $per->delete();
        return redirect()->route('admin.permission.index')->with('success', '删除成功');
    }

}
