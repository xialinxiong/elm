@extends("admin.layouts.main")

@section("content")
    <table class="table">
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>密码</th>
            <th>操作</th>
        </tr>
        @foreach($data as $datas)
            <tr>
                <td>{{$datas->id}}</td>
                <td>{{$datas->name}}</td>
                <td>{{$datas->email}}</td>
                <td>{{$datas->password}}</td>

                <td>
                    <a href="/user/edit/{{$datas->id}}" class="btn btn-info">编辑</a>
                    <a href="/user/del/{{$datas->id}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
            @endforeach
    </table>
    {{--{{$data->links()}}--}}
@endsection