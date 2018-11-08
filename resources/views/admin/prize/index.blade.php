@extends("admin.layouts.main")
@section("title","抽奖活动首页")
@section("content")
    <a href="{{route("admin.prize.add")}}" class="btn btn-success">添加</a>
    <table class="table">
        <tr>
            <th>id</th>
            <th>活动id</th>
            <th>奖品名称</th>
            <th>奖品详情</th>
            <th>中奖商家账号id</th>
            <th>操作</th>
        </tr>
        @foreach($data as $datas)
            <tr>
                <td>{{$datas->id}}</td>
                <td>{{$datas->event->title}}</td>
                <td>{{$datas->name}}</td>
                <td>{{$datas->description}}</td>
                <td>@if($datas->user_id==0)未开奖@else{{$datas->user_id}}@endif </td>
                <td>
                    <a href="{{route('admin.prize.edit',$datas->id)}}" class="btn btn-info">编辑</a>
                    <a href="{{route('admin.prize.del',$datas->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>

@endsection