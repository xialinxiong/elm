@extends("admin.layouts.main")
@section("title","权限列表")
@section("content")
    <table class="table">
        <tr>
            <th>id</th>
            <th>导航名</th>
            <th>路径</th>
            <th>上级</th>
            <th>操作</th>
        </tr>
        @foreach($data as $datas)
            <tr>
                <td>{{$datas->id}}</td>
                <td>{{$datas->name}}</td>
                <td>{{$datas->url}}</td>
                <td>
                    {{str_replace(['[',']','"'],'',json_encode(\App\Models\Nav::where('id',$datas->pid)->pluck('name'),JSON_UNESCAPED_UNICODE)) }}
                    {{--{{\App\Models\Nav::where('id',$datas->pid)->pluck('name')}}--}}
                </td>

                <td>
                    <a href="" class="btn btn-info">编辑</a>
                   <a href="" class="btn btn-info">删除</a>

                </td>
            </tr>
            @endforeach
    </table>

@endsection