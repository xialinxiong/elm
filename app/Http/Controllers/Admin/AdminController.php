<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

}
