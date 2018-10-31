<?php

namespace App\Http\Controllers\shop;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    //活动
    public function index()
    {
        //当前时间
        $time = date('Y-m-d H:i:s',time());
        $datas = Activity::where("end_time",">",$time)->get();
//        dd($exercise);

        return view("shop.activity.index",compact("datas"));
    }
}
