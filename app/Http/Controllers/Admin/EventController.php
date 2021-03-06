<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rule;

class EventController extends BaseController
{
    //活动开奖
    public function draw($id)
    {
        //开奖把数据从redis同步过来
        $users=Redis::smembers("event:".$id);
        foreach ($users as $user){
            EventUser::insert([
                "event_id"=>$id,
                "user_id"=>$user
            ]);
        }
//        通过当前活动ID把已经报名的用户ID取出来
        $userIds=EventUser::where("event_id",$id)->pluck("user_id")->shuffle();

//        $userid=DB::table('event_users')->where('event_id',$id)->pluck('user_id')->toArray();
//        dd($userid);
        //打乱id
//        shuffle($userid);
        //找出所有奖品 并打乱
        $prize=EventPrize::where("event_id",$id)->get()->shuffle();
//        dd($prize);
        foreach ($prize as $k=>$v){
            //把奖品给userid
            $v->user_id=$userIds[$k];
            //保存
            $v->save();
        }
        //修改状态
        $event=Event::find($id);
//        dd($event);
        $event->is_prize=1;
        $event->save();
        return redirect()->route('admin.event.index')->with('success','开奖成功');

    }


    //活动抽奖首页
    public function index()
    {
        //得到所有数据
        $data = Event::all();
        return view("admin.event.index",compact("data"));
    }


//添加活动
    public function add(Request $request)
    {
        //如果为post提交
        if($request->isMethod("post")) {
           $this->validate($request, [
               "title" => 'required|unique:events,title',
                "content" => "required",
                "start_time" => "required",
                "end_time" => 'required',
                "prize_time"=>'required',
                "num"=>'required'
            ]);


            $data=$request->post();
//            0未开奖 1开奖
            $data['is_prize']=0;
            //转换时间戳
            $data['start_time']=strtotime($data['start_time']);
            $data['end_time']=strtotime($data['end_time']);
            $data['prize_time']=strtotime($data['prize_time']);
//            dd($data);
          $datas= Event::create($data);
           Redis::set("event_num:".$datas->id,$datas->num);
            return redirect()->route('admin.event.index')->with('success','添加活动成功');
        }

        return view("admin.event.add");
    }
    //修改活动
    public function edit(Request $request,$id)
    {
     $event=Event::find($id);
     $event['start_time']=date("Y-m-d",$event->start_time);
     $event['end_time']=date("Y-m-d",$event->end_time);
     $event['prize_time']=date("Y-m-d",$event->prize_time);

        if($request->isMethod("post")) {
           $this->validate($request, [
                "content" => "required",
                "start_time" => "required",
                "end_time" => 'required',
                "prize_time"=>'required',
                "num"=>'required'
            ]);

            $data=$request->post();
            //转换时间戳
            $data['start_time']=strtotime($data['start_time']);
            $data['end_time']=strtotime($data['end_time']);
            $data['prize_time']=strtotime($data['prize_time']);
            $event->update($data);
            return redirect()->route('admin.event.index')->with('success','修改活动成功');
        }

        return view("admin.event.edit",compact("event"));
    }
 //删除活动
    public function del($id)
    {
        $event=Event::find($id);
        $event->delete();
        return redirect()->route('admin.event.index')->with('success','删除活动成功');

    }
}
