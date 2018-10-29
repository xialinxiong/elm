@extends("admin.layouts.main")
@section("title","活动列表")
@section("content")


    <div class="row">
        <div class="col-md-4">
            <a href="{{route("admin.activity.add")}}" class="btn btn-info">添加</a>
        </div>
        <div class="col-md-8">
            <form class="form-inline pull-right" method="get">
                <div class="form-group">
                    <select name="time" class="form-control">
                        <option value="">请选择时间</option>
                        <option value="1">活动进行中</option>
                        <option value="2">已结束活动</option>
                        <option value="3">未开展活动</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get("keyword")}}">
                </div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>
    </div>



    <table class="table">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动详情</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($datas as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->title}}</td>
                <td>{!!$data->content!!}</td>
                <td>{{$data->start_time}}</td>
                <td>{{$data->end_time}}</td>
                <td>
                    <a href="edit/{{$data->id}}" class="btn btn-info">编辑</a>
                    <a href="del/{{$data->id}}" class="btn btn-info">删除</a>
                </td>
            </tr>
        @endforeach

    </table>


@endsection

