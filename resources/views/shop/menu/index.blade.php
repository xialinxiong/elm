@extends("shop.layouts.main")

@section("content")
    <a href="{{route("shop.menu.add")}}" class="btn btn-info">添加菜单</a>
    <table class="table">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>所属分类id</th>
            <th>价格</th>
            <th>描述</th>
            <th>提示信息</th>
            <th>商品图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($data as $datas)
            <tr>
                <td>{{$datas->id}}</td>
                <td>{{$datas->goods_name}}</td>
                <td>{{$datas->mc->name}}</td>
                <td>{{$datas->goods_price}}</td>
                <td>{{$datas->description}}</td>
                <td>{{$datas->tips}}</td>
                <td><img src="/{{$datas->goods_img}}" width="100px"></td>
                <td>@if($datas->status==1)上架@else未上架@endif</td>
                <td>
                    <a href="{{route("shop.menu.edit",$datas->id)}}" class="btn btn-info">编辑</a>
                    <a href="{{route("shop.menu.del",$datas->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>

    {{--{{$data->appends($url)->links()}}--}}

@endsection