@extends("admin.layouts.main")
@section("title","活动添加")
@section("content")
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>


    <form class="form-horizontal"  method="post" >
        {{ csrf_field() }}
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">活动标题</label>
        <div class="col-sm-10">
            <input type="text" name="title" value="{{$data->title}}" class="form-control" id="inputPassword3" placeholder="标题">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">开始时间</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="start_time"  value="{{$data->start_time}}"  class="form-control" id="inputPassword3" class="input-text" >
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">结束时间</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="end_time" value="{{$data->end_time}}" class="form-control" id="inputPassword3"  class="input-text">
        </div>
    </div>

    {{--<!-- 编辑器容器 -->--}}
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">活动内容</label>
        <div class="col-sm-10">
            <script id="container" name="content"  type="text/plain">{!!$data->content!!}</script>
        </div>
    </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">修改活动</button>
            </div>
        </div>
    </form>

@endsection

