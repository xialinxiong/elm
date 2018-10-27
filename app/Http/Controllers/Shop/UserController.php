<?php

namespace App\Http\Controllers\Shop;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    //注册
    public function reg(Request $request)
{
    if($request->isMethod("post")){

        $this->validate($request,[
            "name"=>"required|unique:users",
            "password"=>"required|confirmed",
            "email"=>"required"
        ]);
        $data=$request->post();
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        //返回
        session()->flash("success","注册成功");
        return redirect()->route("shop.user.login");
    }
    return view("shop.user.reg");
}

//登陆
    public function login(Request $request)
    {
        if($request->isMethod("post")){
            $data=$this->validate($request,[
                "name"=>"required",
                "password"=>"required"
            ]);
            //2.判断账号密码是否正确
            if (Auth::attempt($data,$request->has("remember"))){
                //判断是否创建商铺
                if(!DB::table("stores")->where('user_id',Auth::id())->get()->isEmpty()) {
                    session()->flash("success","登陆成功");
                    return redirect()->route("shop.store.index");
                }else{
                    session()->flash("success","您还没注册店铺");
                    return redirect()->route("shop.store.add");
                }
              //end判断

            }else{
                return redirect()->back()->withInput()->with("danger","账号或密码错误");
            }

        }
        return view("shop.user.login");
    }

//注销
    public function logout()
    {
        Auth::logout();
        return redirect()->route("shop.user.login");
}
//重置密码
    public function edit(Request $request)
{
    $id=Auth::id();
    $user=User::find($id);
    if($request->isMethod("post")){
        $data=$this->validate($request,[
            "password"=>"required|confirmed",
        ]);
        $data['password'] = bcrypt($data['password']);

        $user->update($data);
        //返回
        session()->flash("success","修改成功");
        return redirect()->route("shop.store.index");
    }


    return view("shop.user.edit",compact("user"));

}

    public function index()
    {

        return 123;
    }


}
