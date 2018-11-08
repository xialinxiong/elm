<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
//            $file = $request->file("shop_img");
            if($da['shop_img']==null){
                $da['shop_img']=$data->shop_img;
//                dd($da);
            }else{
                Storage::delete($data->shop_img);
            }
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
        Storage::delete($store->shop_img);
//        unlink($store->shop_img);
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

        $user=User::where('id',$data->user_id)->first();

        $shopName=$data->shop_name;
        $to = $user->email;

        // dd($to);
        $subject =$shopName. '审核通知';

        Mail::send(
            'emails.shop',
            compact("shopName"),
            function ($message) use($to, $subject) {
//                dd($message);
                $message->to($to)->subject($subject);
            }

        );

        return redirect()->route("admin.store.index")->with("success","审核成功");
}

    //处理上传图片
    public function upload(Request $request)
    {
        //处理上传
        //dd($request->file("file"));
        $file=$request->file("file");
        if ($file){
            //上传
            $url=$file->store("menu_cate");
//             var_dump($url);
            //得到真实地址  加 http的址
            $url=Storage::url($url);
            $data['url']=$url;

            return $data;
            ///var_dump($url);
        }

    }
}
