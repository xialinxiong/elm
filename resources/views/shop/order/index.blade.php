@extends("shop.layouts.main")
@section("title","订单列表")
@section("content")

    <table class="table">
        <tr>
            <th>ID</th>
            <th>用户名称</th>
            <th>订单号</th>
            <th>省</th>
            <th>市</th>
            <th>县</th>
            <th>详细地址</th>
            <th>收货人电话</th>
            <th>收货人姓名</th>
            <th>价格</th>
            <th>下单时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        {{--$arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "完成"];--}}
    @foreach($datas as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->member->username}}</td>
                <td>{{$data->order_code}}</td>
                <td>{{$data->province}}</td>
                <td>{{$data->city}}</td>
                <td>{{$data->area}}</td>
                <td>{{$data->detail_address}}</td>
                <td>{{$data->tel}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->total}}</td>
                <td>{{$data->created_at}}</td>
                <td>
                    @if($data->status==-1)已取消@endif
                    @if($data->status==0)代付款@endif
                    @if($data->status==1)待发货@endif
                    @if($data->status==2)待确认@endif
                    @if($data->status==3)完成@endif
                    </td>
                <td>
                    <a href="" class="btn btn-info">查看订单</a>
                    @if($data->status!=-1 && $data->status!=3) <a href="{{route("shop.order.cancel",$data->id)}}" class="btn btn-danger">取消订单</a>@endif

                    @if($data->status==0)<a href="{{route("shop.order.hair",[$data->id,1])}}" class="btn btn-info">发货</a>@endif
                    @if($data->status==1)<a href="{{route("shop.order.hair",[$data->id,2])}}" class="btn btn-info">确认收货</a>@endif
                    @if($data->status==2)<a href="{{route("shop.order.hair",[$data->id,3])}}" class="btn btn-info">完成</a>@endif
                </td>

            </tr>
        @endforeach

    </table>


@endsection

