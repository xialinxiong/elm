@extends("admin.layouts.main")
@section("title","权限增加")
@section("content")

    <form class="form-horizontal"  method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">权限路由</label>
            <div class="col-sm-10">
                <select name="name" class="form-control">
                    @foreach($urls as $url)
                        <option value="{{$url}}">{{$url}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">权限描述</label>
            <div class="col-sm-10">
                <input type="text" name="intro" class="form-control" id="inputPassword3" placeholder="描述">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加权限</button>
            </div>
        </div>
    </form>

@endsection
