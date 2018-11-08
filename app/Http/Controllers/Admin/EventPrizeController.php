<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventPrizeController extends BaseController
{
    //奖品首页
    public function index()
    {
        $data=EventPrize::all();
        return view("admin.prize.index",compact("data"));
    }
    //添加奖品
    public function add(Request $request)
    {
       $events=Event::all();
        if($request->isMethod("post")) {
            $data=$request->post();
            //user_id 为0 表示没人中奖
            $data['user_id']=0;
            EventPrize::create($data);
            return redirect()->route('admin.prize.index')->with('success','添加奖品成功');
        }


        return view("admin.prize.add",compact("events"));
    }

//修改奖品
    public function edit(Request $request,$id)
    {
        //读取一条数据
        $prize=EventPrize::find($id);
        //读取event表数据
        $events=Event::all();

        if($request->isMethod("post")) {
            $data=$request->post();
            $prize->update($data);
            return redirect()->route('admin.prize.index')->with('success','修改奖品成功');

        }

        return view("admin.prize.edit",compact("prize","events"));
   }
//删除奖品
    public function del($id)
    {
        $prize=EventPrize::find($id);
        $prize->delete();
        return redirect()->route('admin.prize.index')->with('success','删除活动成功');

    }

}
