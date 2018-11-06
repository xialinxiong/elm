<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

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

    if ($request->isMethod("post")){
        $data=$request->post();
        $data['guard_name']="admin";
        Permission::create($data);
    }
//        dd(1);
    return view("admin.permission.add");
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
        return view("admin.permission.edit",compact("per"));
    }

    //删除
    public function del($id)
    {
        $per=Permission::find($id);
        $per->delete();
        return redirect()->route('admin.permission.index')->with('success', '删除成功');
    }

}
