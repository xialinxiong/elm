@extends("admin.layouts.main")
@section("title","用户修改")
@section("content")
    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">角色名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" value="{{old('name',$admin->name)}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">权限名称</label>
            <div class="col-sm-10">
                @foreach($roles as $r)
                    <input type="checkbox" name="role[]" value="{{$r->id}}" @if($admin->hasRole($r->name)) checked @endif>{{$r->name}}
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>

@endsection
