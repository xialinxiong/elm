<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    //显示
    public function index()
    {
        $data=User::all();
        return view("admin.user.index",compact("data"));
    }
    //编辑
    public function edit(Request $request,$id)
    {
        //查找一条
        $user=User::find($id);
        if($request->isMethod("post")){
//            dd($request->post());
            $this->validate($request,[
                "name"=>"required",
                "password"=>"required",
                "email"=>"required"
            ]);
            $data=$request->post();
            $data['password'] = bcrypt($data['password']);
            $user->update($data);
            //返回
            return redirect()->route("admin.user.index")->with("success","修改成功");

        }
        return view("admin.user.edit",compact("user"));
    }

    //删除
    public function del($id)
    {
      DB::transaction(function ()use ($id){
//删除用户
          DB::table('users')->where('id','=',$id)->delete();
          DB::table('stores')->where('user_id','=',$id)->delete();
      });
        return redirect()->route("admin.user.index")->with("success","删除成功");
    }

}
