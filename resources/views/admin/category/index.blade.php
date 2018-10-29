@extends("admin.layouts.main")

@section("content")
    <a href="{{route("admin.category.add")}}" class="btn btn-success">添加</a>
    <table class="table">
        <tr>
            <th>id</th>
            <th>分类名称</th>
            <th>分类图片</th>
            <th>分类状态</th>
            <th>操作</th>
        </tr>
        @foreach($data as $datas)
            <tr>
                <td>{{$datas->id}}</td>
                <td>{{$datas->name}}</td>
                <td>
                    {{--<img src="/{{$datas->img}}" width="100px">--}}
                    @if($datas->img)
                        <img src="{{$datas->img}}?x-oss-process=image/resize,m_fill,w_80,h_80">
                        {{--<img src="{{env("ALIYUN_OSS_URL").$datas->goods_img}}?x-oss-process=image/resize,m_fill,w_80,h_80">--}}
                    @endif
                </td>
                <td>{{$datas->category_img}}</td>
                <td>
                    <a href="{{route('admin.category.edit',$datas->id)}}" class="btn btn-info">编辑</a>
                    <a href="{{route('admin.category.del',$datas->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>

@endsection