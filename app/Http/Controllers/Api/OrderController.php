<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Site;

use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Symfony\Component\HttpFoundation\Response;


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

//微信支付
    public function wxPay()
    {
        //订单id
        $id =\request()->get("id");
//        dd($id);
        //找到订单
        $order=Order::find($id);
//        dd($order);
        //配置
        $options=config("wechat");

        $app = new Application($options);
        $payment = $app->payment;
      //生产订单


        $attributes = [
            'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP...
            'body'             => 'iPad mini 16G 白色',
            'detail'           => 'iPad mini 16G 白色',
            'out_trade_no'     => $order->order_code,
            'total_fee'        => $order->total * 100, // 单位：分
            'notify_url'       => 'http://www3.zjl1996.cn/api/order/ok', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
//            'openid'           => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        $order = new \EasyWeChat\Payment\Order($attributes);
//统计下单
        $result = $payment->prepare($order);
//        dd($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
//            dd(1);
            //2.1 拿到预支付链接
            $codeUrl = $result->code_url;
            $qrCode = new QrCode($codeUrl);
            $qrCode->setSize(250);//大小
// Set advanced options
            $qrCode
                ->setMargin(10)//外边框
                ->setEncoding('UTF-8')//编码
                ->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH)//容错级别
                ->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0])//码颜色
                ->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255])//背景色
                ->setLabel('微信扫码支付', 16, public_path("font/msyh.ttc"), LabelAlignment::CENTER)
//                ->setLogoPath(public_path("images/logo.png"))//LOGO
                ->setLogoWidth(100);//LOGO大小

// Directly output the QR code
            header('Content-Type: ' . $qrCode->getContentType());//响应类型
            exit($qrCode->writeString());

        }



    }
//微信异步通知
    public function ok()
    {
        //0.配置
        $options = config("wechat");
        //dd($options);
        $app = new Application($options);
        //1.回调
        $response = $app->payment->handleNotify(function ($notify, $successful) {
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            // $order = 查询订单($notify->out_trade_no);
            $order=Order::where("order_code",$notify->out_trade_no)->first();

            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status==1) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }

            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                //$order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 1;
            }

            $order->save(); // 保存订单

            return true; // 返回处理完成
        });

        return $response;
    }


//订单
   public function status(){
       $id = \request()->get("id");
       $order = Order::find($id);
       return $order;

   }

}
