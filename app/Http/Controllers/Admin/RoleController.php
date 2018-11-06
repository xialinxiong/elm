<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{
    //添加角色
    public function add(Request $request)
    {
        if ($request->isMethod("post")){

            //接收参数
            $pers=$request->post('pers');
            //添加角色
            $role=Role::create([
                "name"=>$request->post("name"),
                "guard_name"=>"admin"
            ]);
            // 给角色同步权限
            if ($pers){
                $role->syncPermissions($pers);
            }
        }

        //得到所有权限
        $pers = Permission::all();
        return view("admin.role.add",compact("pers"));

    }

    //角色列表
    public function index()
    {
        $data=Role::all();
        return view("admin.role.index",compact("data"));
    }

//角色修改
    public function edit(Request $request,$id)
    {
        //得到当前角色
        $role=Role::find($id);
        //得到所有权限
        $pers=Permission::all();

        //post提交
        if ($request->isMethod('post')) {
        //接收参数
            $data['name'] = $request->post('name');
            //修改
            $role->update($data);
            //一次性撤消并添加新的权限
//            $user->syncPermissions(['edit articles', 'delete articles']);
            $role->syncPermissions($request->post('per'));

            return redirect()->route('admin.role.index')->with('success','修改成功');
        }
        //跳转
            return view('admin.role.edit', compact('pers', 'role'));
    }

    //删除
    public function del($id)
    {
        $per=Role::find($id);
        $per->delete();
        return redirect()->route('admin.role.index')->with('success', '删除成功');
    }


}
