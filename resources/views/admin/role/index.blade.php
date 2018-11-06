@extends("admin.layouts.main")
@section("title","权限列表")
@section("content")
    <table class="table">
        <tr>
            <th>id</th>
            <th>角色名</th>
            <th>保安</th>
            <th>权限</th>
            <th>操作</th>
        </tr>
        @foreach($data as $datas)
            <tr>
                <td>{{$datas->id}}</td>
                <td>{{$datas->name}}</td>
                <td>{{$datas->guard_name}}</td>
                <td>{{str_replace(['[',']','"'],'',json_encode($datas->permissions()->pluck('intro'),JSON_UNESCAPED_UNICODE)) }}
                </td>
                <td>
                    <a href="{{route('admin.role.edit',$datas->id)}}" class="btn btn-info">编辑</a>
                    <a href="{{route('admin.role.del',$datas->id)}}" class="btn btn-info">删除</a>
                </td>
            </tr>
            @endforeach
    </table>

@endsection