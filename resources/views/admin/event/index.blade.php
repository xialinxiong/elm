@extends("admin.layouts.main")
@section("title","抽奖活动首页")
@section("content")
    <a href="{{route("admin.event.add")}}" class="btn btn-success">添加</a>
    <table class="table">
        <tr>
            <th>id</th>
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
                <td>{{$datas->id}}</td>
                <td>{{$datas->title}}</td>
                <td>{{$datas->content}}</td>
                <td>{{date("Y-m-d H:i",$datas->start_time)}}</td>
                <td>{{date("Y-m-d H:i",$datas->end_time)}}</td>
                <td>{{date("Y-m-d H:i",$datas->prize_time)}}</td>
                <td>{{$datas->num}}</td>
                <td>@if($datas->is_prize==0)未开奖@else以开奖@endif</td>
                <td>
                    <a href="{{route('admin.event.edit',$datas->id)}}" class="btn btn-info">编辑</a>
                    <a href="{{route('admin.event.del',$datas->id)}}" class="btn btn-danger">删除</a>
                    @if($datas->is_prize==0)<a href="{{route('admin.event.draw',$datas->id)}}" class="btn btn-danger">开奖</a>@endif

                </td>
            </tr>
        @endforeach
    </table>

@endsection