@extends("admin.layouts.main")
@section("title","后台用户列表")
@section("content")

    <a href="{{route("admin.admin.add")}}" class="btn btn-success">添加后台用户</a>
    <table class="table">
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>密码</th>
            <th>角色</th>
            <th>操作</th>
        </tr>
        @foreach($data as $datas)
            <tr>
                <td>{{$datas->id}}</td>
                <td>{{$datas->name}}</td>
                <td>{{$datas->password}}</td>
                <td>{{str_replace(['[',']','"'],'',json_encode($datas->roles()->pluck('name'),JSON_UNESCAPED_UNICODE)) }}</td>
                <td>
                    <a href="{{route('admin.admin.xiu',$datas->id)}}" class="btn btn-info">编辑权限</a>
                    <a href="{{route('admin.admin.del',$datas->id)}}" class="btn btn-info">删除</a>
                </td>
            </tr>
            @endforeach
    </table>

@endsection