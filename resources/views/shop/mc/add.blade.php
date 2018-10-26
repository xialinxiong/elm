@extends("shop.layouts.main")
@section("title","增加菜单")
@section("content")

    <form class="form-horizontal"  method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{old("name")}}" id="inputEmail3" placeholder="Name">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">菜单编号</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{old("type_accumulation")}}" name="type_accumulation" id="inputEmail3" placeholder="a-z">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="description" value="{{old("description")}}" id="inputEmail3" placeholder="description">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否是默认分类
            </label>
            <div class="col-sm-10">
                <input type="radio" name="is_selected" value="1" >是
                <input type="radio" checked name="is_selected" value="0" >否
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加分类</button>
            </div>
        </div>
    </form>

@endsection