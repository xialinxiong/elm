@extends("admin.layouts.main")

@section("content")
    <table class="table">
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>密码</th>
            <th>拥有店铺</th>
            <th>操作</th>
        </tr>
        @foreach($data as $datas)
            <tr>
                <td>{{$datas->id}}</td>
                <td>{{$datas->name}}</td>
                <td>{{$datas->email}}</td>
                <td>{{$datas->password}}</td>
                <td>@if($datas->store){{$datas->store->shop_name}}@endif</td>
                <td>
                    <a href="/user/edit/{{$datas->id}}" class="btn btn-info">编辑</a>
                    <a href="/user/del/{{$datas->id}}" class="btn btn-danger">删除</a>
                <td>@if(!$datas->store)<a href="/user/add/{{$datas->id}}" class="btn btn-info">添加店铺</a>@endif</td>
                </td>
            </tr>
            @endforeach
    </table>
    {{--{{$data->links()}}--}}
@endsection