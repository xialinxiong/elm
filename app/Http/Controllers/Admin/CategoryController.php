<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends BaseController
{
    //显示
    public function index()
    {
        $data=Category::all();
        return view("admin.category.index",compact("data"));
    }
    //添加
    public function add(Request $request){
    if($request->isMethod("post")){
//        dd(111);
        $this->validate($request,[
                "name"=>"required",
                "img"=>"required",
                "category_img"=>"required"
            ]);
        $data=$request->post();
//        dd($data);
        $file = $request->file("img");
//        dd($file);
        $data['img']=$file->store("images","image");
//        dd($data);
        Category::create($data);

        //返回
        session()->flash("success","添加成功");
        return redirect()->route("admin.category.index");
    }

  return view("admin.category.add");
    }
//编辑
    public function edit(Request $request,$id){
        $on=Category::find($id);
//        dd($on);
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "category_img"=>"required"
            ]);
            $data=$request->post();
            $file = $request->file("img");
//            dd($on->img);
            if($file==null){
                $data['img']=$on->img;
                $on->update($data);
            }else{
                unlink($on->img);
                $data['img']=$file->store("images","image");
               $on->update($data);
            }
            //返回
            session()->flash("success","修改成功");
            return redirect()->route("admin.category.index");
        }

        return view("admin.category.edit",compact("on"));
    }
    //end编辑

    //删除
    public function del(Request $request,$id)
    {
        //查询一条
        $on=Category::find($id);
        $img=$on['img'];
        unlink($img);

        $on->delete();


        //返回
        session()->flash("success","删除成功");
        return redirect()->route("admin.category.index");
    }

}
