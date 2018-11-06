@extends("admin.layouts.main")
@section("title","权限增加")
@section("content")

    <form class="form-horizontal"  method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">角色名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Name">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">权限</label>
            <div class="col-sm-10">
                @foreach($pers as $per)
                    <input type="checkbox" name="pers[]" value="{{$per->id}}">{{$per->intro}}
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加权限</button>
            </div>
        </div>
    </form>

@endsection
