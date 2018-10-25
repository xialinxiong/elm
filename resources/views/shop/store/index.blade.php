@extends("shop.layouts.main")
@section("title","饿了么")
@section("content")
    <div class="row">
        <div class="col-md-4">
        </div>
    </div>
    <table class="table">
        <tr><td>id</td><td>店铺分类ID</td><td>	名称</td><td>店铺图片</td>
            <td>评分</td><td>是否是品牌</td>
            <td>是否准时送达</td><td>是否蜂鸟配送</td>
            <td>是否保标记</td><td>是否票标记</td><td>是否准标记</td>
            <td>起送金额</td><td>配送费</td><td>店公告</td><td>优惠信息</td>
            <td>状态</td><td>用户</td>
        </tr>
            <tr>
                <td>{{$data->id}}</td>
               <td>{{$data->shop_category_id}}</td>
                <td>{{$data->shop_name}}</td>
                <td><img src="/{{$data->shop_img}}" width="30" height="30"></td>
                <td>{{$data->shop_score}}</td>
                <td>{{$data->is_brand}}</td>
                <td>{{$data->is_time}}</td>
                <td>{{$data->is_feng}}</td>
                <td>{{$data->is_bao}}</td>
                <td>{{$data->is_piao}}</td>
                <td>{{$data->is_zhun}}</td>
                <td>{{$data->qi_money}}</td>
                <td>{{$data->pei_money}}</td>
                <td>{{$data->notice}}</td>
                <td>{{$data->discount}}</td>
                <td>{{$data->state}}</td>
                <td>{{$data->user_id}}</td>
            </tr>
    </table>
@endsection

