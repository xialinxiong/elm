@extends("shop.layouts.main")
@section("title","抽奖活动")
@section("content")
    <table class="table">
        <tr>
            {{--<th>id</th>--}}
            <th>活动名称</th>
            <th>活动详情</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖时间</th>
            <th>报名人数限制</th>
            <th>是否已开奖</th>
            <th>操作</th>
        </tr>
        @foreach($data as $datas)
            <tr>
                {{--<td>{{$datas->id}}</td>--}}
                <td>{{$datas->title}}</td>
                <td>{{$datas->content}}</td>
                <td>{{date("Y-m-d H:i",$datas->start_time)}}</td>
                <td>{{date("Y-m-d H:i",$datas->end_time)}}</td>
                <td>{{date("Y-m-d H:i",$datas->prize_time)}}</td>
                <td>{{$datas->num}}</td>
                <td>@if($datas->is_prize==0)未开奖@else以开奖@endif</td>
                <td>
                    <a href="" class="btn btn-info">详情</a>
                    <a href="{{route('shop.event.signup',$datas->id)}}" class="btn btn-danger">报名</a>
                </td>
            </tr>
        @endforeach
    </table>

@endsection