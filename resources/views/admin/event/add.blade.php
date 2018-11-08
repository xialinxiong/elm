@extends("admin.layouts.main")
@section("title","活动添加")
@section("content")

    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">活动名称</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动详情</label>
            <div class="col-sm-10">
                <input type="text" name="content" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">报名开始时间</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" placeholder="报名开始时间" size="5" name="start_time" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">报名结束时间</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" placeholder="报名结束时间" size="5" name="end_time" >
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">开奖时间</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" placeholder="开奖时间" size="5" name="prize_time" >
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">报名人数限制</label>
            <div class="col-sm-10">
                <input type="text" name="num" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>

@endsection
