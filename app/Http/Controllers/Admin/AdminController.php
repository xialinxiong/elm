<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AdminController extends BaseController
{
    public function login(Request $request)
    {
        if($request->isMethod("post")){
            $data=$this->validate($request,[
                "name"=>"required",
                "password"=>"required"
            ]);
            if (Auth::guard("admin")->attempt($data,$request->has("remember"))){
                //跳转
                return redirect()->intended(route("admin.user.index"))->with("success","登录成功");
            }else{
                //3.返回失败
                return redirect()->back()->withInput()->with("danger","账号密码错误");
            }

        }
        return view("admin.admin.login");
   }

    //注销
    public function logout()
    {
        Auth::logout();
        return redirect()->route("admin.admin.login");
    }

    //修改密码
    public function edit(Request $request)
    {
        $id=Auth::id();
        $user=Admin::find($id);
        if($request->isMethod("post")){
            $data=$this->validate($request,[
                "password"=>"required|confirmed",
            ]);
            $data['password'] = bcrypt($data['password']);

            $user->update($data);
            //返回
            session()->flash("success","修改密码成功");
            return redirect()->route("admin.user.index");
        }


        return view("admin.admin.edit",compact("user"));

    }

    //后台用户首页
    public function index()
    {
        $data=Admin::all();
        return view("admin.admin.index",compact("data"));
    }
//添加
    public function add(Request $request)
    {
        if ($request->isMethod('post')){
            //接收参数
            $data = $request->post();
            $data['password'] = bcrypt($data['password']);
             //创建用户
            $admin=Admin::create($data);
            //给用户添加角色
            $admin->syncRoles($request->post('role'));
            //跳转并提示
            return redirect()->route('admin.admin.index')->with('success', '创建' .$admin->name. "成功");
        }


        //得到所有角色
        $roles=Role::all();
        return view('admin.admin.add',compact("roles"));
    }
//后台角色修改
    public function xiu(Request $request,$id)
    {
     //得到当前用户数据
        $admin=Admin::find($id);
        //得到所有用户
        $roles=Role::all();

        if ($request->isMethod('post')) {
            //接收参数
            $data['name'] = $request->post('name');
            //修改
            $admin->update($data);
            //一次性撤消并添加新的权限
//            $user->syncPermissions(['edit articles', 'delete articles']);
            $admin->syncRoles($request->post('role'));
            return redirect()->route('admin.admin.index')->with('success','修改成功');
        }


        //跳转
        return view('admin.admin.xiu', compact('admin', 'roles'));
}
//删除
    public function del($id)
    {
        $per=Admin::find($id);
        $per->delete();
        return redirect()->route('admin.admin.index')->with('success', '删除成功');

  }


}
