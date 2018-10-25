<?php

namespace App\Http\Controllers\shop;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreController extends BaseController
{
    //店铺显示
    public function index()
    {
//        dd(Auth::id());

        $data=DB::table("stores")->where('user_id',Auth::id())->get();
        $data=$data['0'];
      //  dd($data->id);
       return view("shop.store.index",compact("data"));
    }

    //店铺注册
    public function add(Request $request)
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
            $data['shop_img']=$file->store("shop_img","image");
            $data['is_brand']=$request->has("is_brand")?1:0;
            $data['is_time']=$request->has("is_time")?1:0;
            $data['is_feng']=$request->has("is_feng")?1:0;
            $data['is_bao']=$request->has("is_bao")?1:0;
            $data['is_piao']=$request->has("is_piao")?1:0;
            $data['is_zhun']=$request->has("is_zhun")?1:0;
            $data['state']=2;
            $data['user_id']=Auth::id();
//            dd($data);
            Store::create($data);
            //返回
            session()->flash("success","注册成功");
            return redirect()->route("shop.store.index");

        }
     return view("shop.store.add",compact("fl"));
    }
}
