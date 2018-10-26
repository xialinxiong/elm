<?php

namespace App\Http\Controllers\Shop;

use App\Models\MenuCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuCategoriesController extends BaseController
{
    //显示
    public function index()
    {
        $id=Auth::id();
        $data=MenuCategories::all()->where("store_id",$id);
//        dd($data);
        return view("shop.mc.index",compact("data"));
}

//增加
    public function add(Request $request)
    {
        if($request->isMethod("post")){

            $this->validate($request,[
                "name"=>"required|unique:users",
                "type_accumulation"=>"required",
                "description"=>"required"
            ]);
            $data=$request->post();
            //向数据中增加登陆者 的id
            $data['store_id']=Auth::id();
//            dd($data);
           MenuCategories::create($data);
            //返回
            return redirect()->route("shop.mc.index")->with("success","添加菜单分类成功");
        }
        return view("shop.mc.add");
    }

    //编辑
    public function edit(Request $request,$id)
    {
        $mc=MenuCategories::find($id);
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required|unique:users",
                "type_accumulation"=>"required",
                "description"=>"required"
            ]);
            $data=$request->post();
            $mc->update($data);
            //返回
            return redirect()->route("shop.mc.index")->with("success","修改菜单分类成功");
        }
        return view("shop.mc.edit",compact("mc"));
    }

    //删除
    public function del($id)
    {

        $mc=MenuCategories::find($id);
        if ($mc->mc==null){
        $mc->delete();
        return redirect()->route("shop.mc.index")->with("success","删除成功");
        }else{
            return redirect()->route("shop.mc.index")->with("success","该分类下有菜品");
        }


    }
}
