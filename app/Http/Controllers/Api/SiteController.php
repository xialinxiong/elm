<?php

namespace App\Http\Controllers\Api;

use App\Models\Site;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    //新增收获地址
    public function add(Request $request)
    {
        //接收数据
        $data=$request->post();
        //增加
        if (Site::create($data)){
            $da=[
                "status" =>"true",
                "message" => "新增成功"
            ];
            return $da;
        }else{
            $da=[
                "status" =>"false",
                "message" => "新增失败"
            ];
            return $da;

        }

    }
    //显示收货地址
    public function index()
    {
        //接收id
        $id=\request()->post("user_id");
//        dd($id);
//        查询属于user_id的地址
        $site=Site::where("user_id",$id)->get();
//        dd($site);
        return $site;

    }
//修改地址
    public function edit(Request $request)
    {
      if ($_POST){
          //接收数据
       $data=$request->post();
//       dd($data);
       //读取一条
          $site=Site::find($data['id']);
          //修改一条
          $site->update($data);
          $data=[
              "status" =>"true",
              "message" => "修改成功"
          ];
          return $data;

      }else{
          $id=$request->post("id");
//          dd($id);
          $site=Site::find($id);
          return $site;

      }

}


}
