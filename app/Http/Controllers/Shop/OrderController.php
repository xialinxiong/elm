<?php

namespace App\Http\Controllers\Shop;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    //显示订单
    public function index()
    {
        //得到登陆商家id
        $id = Auth::id();
        //显示属于商家id的订单
        $datas = Order::where("shop_id", $id)->get();
//      dd($datas);
        return view("shop.order.index", compact("datas"));
    }

    //取消订单
    public function cancel($id)
    {
        $data = Order::find($id);
        $data->status = -1;
        $data->save();
        return redirect()->route("shop.order.index")->with("success", "取消成功");
    }

    //发货
    public function hair($id, $status)
    {
//        $ids=Auth::user()->shop_id;
//        dd($ids);
        $result = Order::where("id", $id)->where("shop_id", Auth::id())->update(['status' => $status]);
        if ($result) {
            return redirect()->route("shop.order.index")->with("success", "更改状态成功");
        }
//        $data=Order::find($id);
//        $data->status=2;
//        $data->save();
//        return redirect()->route("shop.order.index")->with("success","发货成功");
    }



//订单量
    //日
    public function day(Request $request)
    {
        //所有参数
        $url = $request->query();
        //接受
        $start =$request->get("start_time");
        $end =$request->get("end_time");

        $query=  Order::where("shop_id",Auth::id())->whereIn("status",[1,2,3])
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,COUNT(*) as nums,SUM(total) as money"))
            ->groupBy('date');
//            ->get();
        //判断
        if($start !==null ){
            $query->where("created_at",">=","$start");
        }
        if( $end !==null){
            //  exit("111");
            $query->where("created_at","<=",$end);
        }
        $data =$query->get();
//        dd($data->toArray());
        return view("shop.order.day", compact("data","url"));
    }
//月份
    public function month()
    {
        $data=  Order::where("shop_id",Auth::id())->whereIn("status",[1,2,3])
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date,COUNT(*) as nums,SUM(total) as money"))
            ->groupBy('date')
            ->get();
//        dd($data->toArray());
        return view("shop.order.month", compact("data"));
}
//总计
    public function total()
    {
        $data=  Order::where("shop_id",Auth::id())->whereIn("status",[1,2,3])
            ->select(DB::raw("COUNT(*) as nums,SUM(total) as money"))
            ->get();
//        dd($data->toArray());
        return view("shop.order.total", compact("data"));
    }

    //菜品
//    日
    public function cday()
    {
        //读取商家所有订单
        $order=Order::where("shop_id",Auth::id())->whereIn("status",[1,2,3])->pluck("id");

        $data= OrderDetail::select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,SUM(amount) as nums,SUM(amount * goods_price) as money"))
            ->whereIn("order_id",$order)
            ->groupBy('date')
            ->get();

        return view("shop.order.cday", compact("data"));
}
//y月
    public function cmonth()
    {
        //读取商家所有订单
        $order=Order::where("shop_id",Auth::id())->whereIn("status",[1,2,3])->pluck("id");
        $data= OrderDetail::select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date,SUM(amount) as nums,SUM(amount * goods_price) as money"))
            ->whereIn("order_id",$order)
            ->groupBy('date')
            ->get();

        return view("shop.order.cmonth", compact("data"));
    }
//总
    public function ctotal()
    {
        $order=Order::where("shop_id",Auth::id())->whereIn("status",[1,2,3])->pluck("id");
        $data= OrderDetail::select(DB::raw("SUM(amount) as nums,SUM(amount * goods_price) as money"))
            ->whereIn("order_id",$order)
            ->get();

//        $total= OrderDetail::whereIn("order_id",$order)
//            ->select(DB::raw("goods_id,SUM(amount) as nums,SUM(amount * goods_price) as money"))
//            ->groupBy('goods_id')
//            ->get();
//        dd($total->toArray());

        return view("shop.order.ctotal", compact("data","total"));
    }



}
