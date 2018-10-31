<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\MenuCategories;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function index(Request $request)
    {


        $keyword=$request->get("keyword");

        if ($keyword!==null){
            $store = Store::where("state", 1)->where("shop_name", "like", "%{$keyword}%")->get();
        }else{
            $store=Store::where("state",1)->get();
        }

//        dump($store->toArray());
        foreach ($store as $s => $x){
        $store[$s]->shop_rating="4.".rand(0,9);
        $store[$s]->service_code="4.".rand(0,9);
        $store[$s]->foods_code="4.".rand(0,9);
        $store[$s]->high_or_low=true;
        $store[$s]->h_l_percent=20;
        $store[$s]->brand=$x->is_brand;
        $store[$s]->on_time=$x->is_time;
        $store[$s]->fengniao=$x->is_feng;
        $store[$s]->bao=$x->is_bao;
        $store[$s]->piao=$x->is_piao;
        $store[$s]->zhun=$x->is_zhun;
        $store[$s]->start_send=$x->qi_money;
        $store[$s]->send_cost=$x->pei_money;
        $store[$s]->distance= rand(1000, 5000);
        $store[$s]->estimate_time= rand(10, 60);
        }

//        dd($store->toArray());

        return $store;
    }


    public function detail(Request $request)
    {
        $id = request()->get('id');
        $store=Store::find($id);
//        dump($store->toArray());
//        dd($store->toArray());
        $store->service_code=4.6;
        //评论
        $store->evaluate = [
            [
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 1,
                "send_time" => 30,
                "evaluate_details" => "不怎么好吃"],
            ["user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 4.5,
                "send_time" => 30,
                "evaluate_details" => "很好吃"]
        ];

      $cates=MenuCategories::where("store_id",$id)->get();
//        dd($cates->toArray());
      //分类下有那些商品
//        dd($cates->toArray());
        foreach ($cates as $k=>$c){
            $cates[$k]->goods_list=$c->goodsList;
        }
//        dd($cates->toArray());
        $store->commodity=$cates;
//        dd($store->commodity);
        return $store;

    }
    
    
    

}
