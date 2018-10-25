@extends("admin.layouts.main")
@section("title","分类增加")
@section("content")

    <form class="form-horizontal"  method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{$user->name}}" id="inputEmail3" placeholder="Name">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" value="{{$user->email}}" id="inputEmail3" placeholder="Eamil">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password" value="{{$user->password}}" id="inputEmail3" placeholder="Password">
            </div>
        </div>

        <button type="submit" class="btn btn-default">编辑</button>
    </form>

@endsection


