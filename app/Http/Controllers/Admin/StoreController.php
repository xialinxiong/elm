<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends BaseController
{
    //店铺显示
    public function index()
    {
        $datas=Store::all();
       return view("admin.store.index",compact("datas"));
    }
    //店铺修改
    public function edit(Request $request,$id)
    {
        //读取一条数据
        $data=Store::find($id);
        $fl=Category::all();
        if($request->isMethod("post")) {
            $this->validate($request,[
                "shop_category_id"=>"required",
                "shop_name"=>"required",
                "qi_money"=>"required",
                "pei_money"=>"required",
                "notice"=>"required",
                "discount"=>"required"
            ]);
            $da=$request->post();
            $file = $request->file("shop_img");
            if($file==null){
                $da['shop_img']=$data->shop_img;
//                dd($da);
            }else{
                unlink($data->shop_img);
                $da['shop_img']=$file->store("shop_img");
            }
            $da['shop_img']=$file->store("shop_img");
            $da['is_brand']=$request->has("is_brand")?1:0;
            $da['is_time']=$request->has("is_time")?1:0;
            $da['is_feng']=$request->has("is_feng")?1:0;
            $da['is_bao']=$request->has("is_bao")?1:0;
            $da['is_piao']=$request->has("is_piao")?1:0;
            $da['is_zhun']=$request->has("is_zhun")?1:0;
//            dd($da);
            $data->update($da);
            //返回
            session()->flash("success","修改成功");
            return redirect()->route("admin.store.index");

        }

        return view("admin.store.edit",compact("data","fl"));
    }

    //删除
    public function del($id)
    {
        //查询一条
        $store=Store::find($id);
        unlink($store->shop_img);
        $store->delete();
        return redirect()->route("admin.store.index")->with("success","删除成功");
    }

    public function shen($id)
    {
        $data=Store::find($id);
//        dd($id);
        $data->state=1;
//        dd($data);
       $data->save();
        return redirect()->route("admin.store.index")->with("success","审核成功");
}


}