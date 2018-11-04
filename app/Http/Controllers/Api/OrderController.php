<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //添加订单
    public function add(Request $request)
    {
//    {dd($request->post('address_id'));
        //读取一条数据  判定地址
        $site = Site::find($request->post('address_id'));
        if ($site === null) {
            return [
                "status" => "false",
                "message" => "地址不正确"
            ];
        }
        //查出店铺id
        $cart = Cart::where("user_id", $request->post('user_id'))->get();
//        dd(Menu::find($cart[0]->menu_id));
        $menuid = Menu::find($cart[0]->menu_id)->shop_id;
        //给字段赋值
        $data['user_id'] = $request->post('user_id');
        $data['shop_id'] = $menuid;
        $data['order_code'] = date("ymdHis") . rand(1000, 9999);
        $data['province'] = $site->provence;
        $data['city'] = $site->city;
        $data['area'] = $site->area;
        $data['detail_address'] = $site->detail_address;
        $data['tel'] = $site->tel;
        $data['name'] = $site->name;
        //总价
        $totalCost = 0;
        foreach ($cart as $a => $b) {
            $good = Menu::where('id', $b->menu_id)->first();
            //总价
            $totalCost += $b->nums * $good->goods_price;
        }
        $data['total'] = $totalCost;
//        dd($data);
        $data['status'] = 0;

        //启动事务
        DB::beginTransaction();
        try {
            //添加订单
            $order = Order::create($data);
//            dd($order);
            //订单商品
//            dd($cart->toArray());
            foreach ($cart as $a=>$carts){
                $menu = Menu::find($carts->menu_id);

                $da['order_id']= $order->id;
                $da['goods_id'] = $carts->menu_id;
                $da['amount'] = $carts->nums;
                $da['goods_name']  = $menu->goods_name;
                $da['goods_img'] = $menu->goods_img;
                $da['goods_price'] = $menu->goods_price;
                OrderDetail::create($da);
            }

            //清空购物车
            Cart::where("user_id", $request->post('user_id'))->delete();
            //提交事务
            DB::commit();
        } catch (\Exception $exception) {
            //回滚
            DB::rollBack();
            return [
                "status" => "false",
                "message" => $exception->getMessage(),
            ];
        }
        return [
            "status" => "true",
            "message" => "添加成功",
            "order_id" => $order->id
        ];

    }

//指定订单详情

    public function detail(Request $request)
    {
        $order=Order::find($request->input('id'));
//        dd($order);
        $arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "完成"];
        $data['id'] = $order->id;
        $data['order_code'] = $order->order_code;
        $data['order_birth_time'] = (string)$order->created_at;
//        $data['order_status'] = $order->status;
        $data['order_status'] = $arr["$order->status"];

        $data['shop_id'] = $order->shop_id;
        $data['shop_name'] = $order->shop->shop_name;
        $data['shop_img'] = $order->shop->shop_img;
        $data['order_price'] = $order->total;
        $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
        $data['goods_list'] = $order->goods;
//        dd($data['order_status']);
        return $data;

}


//订单显示
    public function index(Request $request)
    {
        $orders = Order::where("user_id", $request->input('user_id'))->get();
        $datas=[];
        foreach ($orders as $order) {
            $data['id'] = $order->id;
            $data['order_code'] = $order->order_code;
            $data['order_birth_time'] = (string)$order->created_at;
            $data['order_status'] =$order->status;
            $data['shop_id'] = (string)$order->shop_id;
            $data['shop_name'] = $order->shop->shop_name;
            $data['shop_img'] = $order->shop->shop_img;
            $data['order_price'] = $order->total;
            $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
            $data['goods_list'] = $order->goods;
            $datas[] = $data;
        }
        return $datas;


    }

//     订单支付
    public function pay(Request $request)
    {
        // 得到订单
        $order = Order::find($request->post('id'));
//        dd($order);
        //得到用户
        $member = Member::find($order->user_id);
        //判断钱够不够
        if ($order->total > $member->money) {
            return [
                'status' => 'false',
                "message" => "用户余额不够，请充值"
            ];
        }
        //否则扣钱
        $member->money = $member->money - $order->total;
        $member->save();
        //更改订单状态
        $order->status = 1;
        $order->save();
        return [
            'status' => 'true',
            "message" => "支付成功"
        ];
    }

}
