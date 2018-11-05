<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    public function index(Request $request)
    {
        //所有参数
        $url = $request->query();
        //接受
        $start =$request->get("start_time");
        $end =$request->get("end_time");
//dd(1);
//        $total= Order::whereIn("status",[1,2,3])
//            ->select(DB::raw("shop_id,SUM(amount) as nums,SUM(amount * goods_price) as money"))
//            ->groupBy('shop_id')
//            ->get();
        $total =Order::whereIn('status',[1,2,3])
            ->select(DB::raw("shop_id,COUNT(*) as nums,SUM(total) as money"))
            ->groupBy('shop_id');
//                dd($total->toArray());
        //判断
        if($start !==null ){
            $total->where("created_at",">=","$start");
        }
        if( $end !==null){
            //  exit("111");
            $total->where("created_at","<=",$end);
        }
        $data =$total->get();
//        dd($data->toArray());
        return view("admin.order.index", compact("data","url"));
    }
}
