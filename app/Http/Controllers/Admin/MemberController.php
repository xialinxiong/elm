<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends BaseController
{
    //显示
    public function index(Request $request)
    {
        $url = $request->query();
       //接收数据
        $keyword=$request->get("keyword");
        $query=Member::orderBy("id");
        if ($keyword!==null){
            $query->where("username","like","%{$keyword}%");
        }
        $goods=$query->paginate(2);
        return view("admin.member.index",compact("url","goods"));
   }


}
