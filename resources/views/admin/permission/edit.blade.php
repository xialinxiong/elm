@extends("admin.layouts.main")
@section("title","权限修改")
@section("content")

    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">权限名称</label>
            <div class="col-sm-10">
                <select name="name" class="form-control">
                    @foreach($urls as $url)
                        <option value="{{$url}}" @if($per->name==$url) selected @endif >{{$url}}</option>
                    @endforeach
                </select>
                {{--<input type="text" name="name" class="form-control" value="{{$per->name}}">--}}
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">权限描述</label>
            <div class="col-sm-10">
                <input type="text" name="intro" class="form-control" value="{{$per->intro}} ">
            </div>

        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>

@endsection
