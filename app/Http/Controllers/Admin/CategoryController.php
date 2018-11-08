<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
        $this->validate($request,[
                "name"=>"required",
                "img"=>"required",
                "category_img"=>"required"
            ]);
        $data=$request->post();
//        dd($data);
//        $file = $request->file("img");
//        dd($file);
//        $data['img']=$file->store("images");
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
//        dd($on->img);
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "category_img"=>"required"
            ]);
            $data=$request->post();
//            dd($data);
            if($data['img']){
                Storage::delete($on->img);
            }else{
                $data['img']=$on->img;
            }
//            dd($data);
            $on->update($data);
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
//        dd($on->store);

        if ($on->store==null){
        $img=$on['img'];
        Storage::delete($img);
        $on->delete();
        //返回
        session()->flash("success","删除成功");
        return redirect()->route("admin.category.index");
        }else{
            session()->flash("success","该分类下有店铺");
            return redirect()->route("admin.category.index");
        }

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
