@extends("shop.layouts.main")

@section("content")
    <a href="{{route("shop.mc.add")}}" class="btn btn-info">添加菜单</a>
    <table class="table">
        <tr>
            <th>id</th>
            <th>菜单名</th>
            <th>编号</th>
            <th>描述</th>
            <th>是否是默认分类</th>
            <th>操作</th>
        </tr>
        @foreach($data as $datas)
            <tr>
                <td>{{$datas->id}}</td>
                <td>{{$datas->name}}</td>
                <td>{{$datas->type_accumulation}}</td>
                <td>{{$datas->description}}</td>
                <td>@if($datas->is_selected==1)是@else否@endif</td>
                <td>
                    <a href="{{route("shop.mc.edit",$datas->id)}}" class="btn btn-info">编辑</a>
                    <a href="{{route("shop.mc.del",$datas->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection