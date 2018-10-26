<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
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


    //如果用户没有店铺 可以添加店铺
    public function add(Request $request,$id)
    {
        $fl=Category::all();
        if($request->isMethod("post")) {
            $this->validate($request,[
                "shop_category_id"=>"required",
                "shop_name"=>"required",
                "shop_img"=>"required",
                "qi_money"=>"required",
                "pei_money"=>"required",
                "notice"=>"required",
                "discount"=>"required"
            ]);
            $data=$request->post();
            $file = $request->file("shop_img");
            $data['shop_img']=$file->store("shop_img");
            $data['is_brand']=$request->has("is_brand")?1:0;
            $data['is_time']=$request->has("is_time")?1:0;
            $data['is_feng']=$request->has("is_feng")?1:0;
            $data['is_bao']=$request->has("is_bao")?1:0;
            $data['is_piao']=$request->has("is_piao")?1:0;
            $data['is_zhun']=$request->has("is_zhun")?1:0;
            $data['state']=1;
            $data['user_id']=$id;
//            dd($data);
            Store::create($data);
            //返回
            session()->flash("success","添加店铺成功");
            return redirect()->route("admin.user.index");

        }



    return view("admin.user.add",compact("fl"));
    }

}
