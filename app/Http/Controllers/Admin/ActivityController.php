<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class ActivityController extends BaseController
{
    public function index(Request $request)
    {
//        $datas=Activity::all();
        $url = $request->query();
        $time =$request->get("time");
        //有效期内
        //$date = date('Y-m-d',time());
        $query = Activity::orderBy("id");
       //得到当前时间
        $date=date('Y-m-d H:i:s', time());
       //判断时间  1 进行 2 结束 3 未开始
        if( $time == 1 ){
            $query->where("start_time","<=",$date)->where("end_time",">",$date);
        }
        if($time == 2){
            $query->where("end_time","<",$date);
        }
        if($time == 3){
            $query->where("start_time",">",$date);
        }
        $datas = $query->paginate(2);



        return view("admin.activity.index",compact("datas","url"));
    }
//添加
    public function add(Request $request)
    {
        if($request->isMethod("post")){
//            dd(111);
            $this->validate($request,[
                "title"=>"required",
                "start_time"=>"required",
                "end_time"=>"required",
                "content"=>"required"
            ]);
            $data=$request->post();
//            dd($data);
            //开始时间
            $start=$data['start_time'];
            //结束时间
            $end=$data['end_time'];
            //当前时间
            $ymd=date('Y-m-d H:i:s');
//            dd($ymd);
            //开始时间不能再结束时间之前
            if ($end < $start){
                return redirect()->intended(route("admin.activity.index"))->with("success","开始时间不能再结束时间之前");
            }

            //开始时间不能再当前时间之前
            if ($ymd > $start){
                return redirect()->intended(route("admin.activity.index"))->with("success","开始时间不能再当前时间之前");
            }

            Activity::create($data);
            //返回
            session()->flash("success","添加成功");
            return redirect()->route("admin.activity.index");
        }

        return view("admin.activity.add");
    }
    //修改
    public function edit(Request $request,$id)
    {
      $data=Activity::find($id);
      $data->start_time=str_replace(" ","T",$data->start_time);
        $data->end_time=str_replace(" ","T",$data->end_time);
        if($request->isMethod("post")){
            $da= $this->validate($request,[
                "title"=>"required",
                "start_time"=>"required",
                "end_time"=>"required",
                "content"=>"required"
            ]);
//            $da=$request->post();
//           dd($da);
            $da['start_time']=str_replace("T"," ",$da['start_time']);
            $da['end_time']=str_replace("T"," ",$da['end_time']);

//            dd($da);
           $data->update($da);
            return redirect()->intended(route("admin.activity.index"))->with("success","修改成功");
        }
//dd($data);


      return view("admin.activity.edit",compact("data"));
    }
    //删除
    public function del($id)
    {
        $data=Activity::find($id);
       $data->delete();
        return redirect()->intended(route("admin.activity.index"))->with("success","删除成功");
    }
}
