<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class EventUserController extends BaseController
{
    public function index()
    {
        //抽奖活动首页
        $data=Event::all();
        return view("shop.event.index",compact("data"));
    }
    //抽奖报名
    public function signup($id)
    {
        $eventId=$id;
        $userId=Auth::user()->id;
//        $num=Event::where("id",$id)->first()->num;
//      $data['event_id']=$id;
//      $data['user_id']=Auth::user()->id;
//      dd($data);
//dd(1);
       //1.取出限制报名人数
        $num=Redis::get("event_num:".$eventId);
        //2.取出报名人数
        $users=Redis::scard("event:".$eventId);
        if ($users<$num){
            //3. 把当前报名的人的ID 存到 Redis中  存什么类型 格式 event:3
            Redis::sadd("event:".$eventId,$userId);
            return "报名成功";
        }else{
            return "报名失败";
        }


//
//      $num=Event::where("id",$id)->first()->num;
////      dd($num);
//      $count=EventUser::where("event_id",$id)->count();
////        dd($count);
//       if ($num <= $count){
//
//           return redirect()->route('shop.event.index')->with('success','报名人数以满');
//
//       }else{
//           EventUser::create($data);
//           return redirect()->route('shop.event.index')->with('success','报名成功');
////      dd($data);
//
//       }




 }



}
