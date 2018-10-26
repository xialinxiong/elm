<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuController extends BaseController
{
//显示
    public function index(Request $request)
    {
        $id=Auth::id();
//        dd($id);
        $data=Menu::paginate(2)->where("shop_id",$id);
//        dd($data);

        return view("shop.menu.index",compact("data"));
}

//增加
   public function add(Request $request){
       $id=Auth::id();

       $data=MenuCategories::all()->where("store_id",$id);
       if($request->isMethod("post")){
           $this->validate($request,[
               "goods_name"=>"required|unique:menus",
               "category_id"=>"required",
               "goods_price"=>"required",
               "description"=>"required",
               "tips"=>"required",
               "goods_img"=>"required",
               "status"=>"required"
           ]);
           $da=$request->post();
//           dd($da);
           $file = $request->file("goods_img");
           $da['goods_img']=$file->store("images");
           $da['shop_id']=Auth::id();
//           dd($da);
           Menu::create($da);
           //返回
           return redirect()->route("shop.menu.index")->with("success","添加菜单分类成功");
       }



       return view("shop.menu.add",compact("data"));
   }

    //修改
    public function edit(Request $request,$id){
        //读取一条数据
        $data=Menu::find($id);
        //把分类读出来
        $id=Auth::id();
        $da=MenuCategories::all()->where("store_id",$id);
//        dd($da);
        if($request->isMethod("post")){
            $this->validate($request,[
                "goods_name"=>"required",
                "category_id"=>"required",
                "goods_price"=>"required",
                "description"=>"required",
                "tips"=>"required",
                "status"=>"required"
            ]);
            $da=$request->post();
            $file = $request->file("goods_img");
            if($file==null){
                $da['goods_img']=$data->goods_img;
            }else{
//                dd($data->goods_img);
                unlink($data->goods_img);
                $da['goods_img']=$file->store("images");
            }

            $da['shop_id']=Auth::id();
//           dd($da);
            $data->update($da);
            //返回
            return redirect()->route("shop.menu.index")->with("success","添加菜单分类成功");
        }



        return view("shop.menu.edit",compact("data","da"));
    }


 //删除
    //删除
    public function del(Request $request,$id)
    {
        //查询一条
        $on=Menu::find($id);
        $img=$on['goods_img'];
        unlink($img);
        $on->delete();
        //返回
        session()->flash("success","删除成功");
        return redirect()->route("shop.menu.index");
    }






}
