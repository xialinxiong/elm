<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function add(Request $request)
    {
        //用户id
        Cart::where("user_id", $request->post('user_id'))->delete();
    $user=$request->post("user_id");
   $menu_ids=$request->post("goodsList");
   $nums=$request->post("goodsCount");
//dump($menu_ids);
   foreach ($menu_ids as $a=>$menu_id){
        Cart::create([
            "user_id"=>$user,
            "menu_id"=>$menu_id,
            "nums"=>$nums[$a]
        ]);

   }
        $da=[
            "status" =>"true",
            "message" => "添加成功"
        ];
        return $da;

}


//显示订单
    public function index()
    {
        //用户id
        $id=\request()->post("user_id");
        //购物车
        $site=Cart::where("user_id",$id)->get();
//        dd($site);
        //声明一个数组接收
        $menu_id=[];
        //总价
        $totalCost=0;
        //循环
        foreach ($site as $a=>$b){
       $good= Menu::where('id',$b->menu_id)->first(['id as goods_id','goods_name', 'goods_img', 'goods_price']);
          //数量
        $good->nums = $b->nums;
       //总价
       $totalCost=$good->nums * $good->goods_price+$totalCost;
       $menu_id[]=$good;
    }
return [
    'goods_list' => $menu_id,
    'totalCost' => $totalCost
];

 }

}
