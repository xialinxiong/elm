<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
      $data['event_id']=$id;
      $data['user_id']=Auth::user()->id;
//      dd($data);
//dd(1);
      $num=Event::where("id",$id)->first()->num;
//      dd($num);
      $count=EventUser::where("event_id",$id)->count();
//        dd($count);
       if ($num <= $count){

           return redirect()->route('shop.event.index')->with('success','报名人数以满');

       }else{
           EventUser::create($data);
           return redirect()->route('shop.event.index')->with('success','报名成功');
//      dd($data);

       }




 }



}
