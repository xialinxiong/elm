@extends("admin.layouts.main")
@section("title","分类增加")
@section("content")

    <form class="form-horizontal"  method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Name">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">分类图片</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="img" id="inputEmail3" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">商品状态</label>
            <div class="col-sm-10">
                <input type="text" name="category_img" class="form-control" id="inputPassword3" placeholder="1：显示，0：不显示">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加分类</button>
            </div>
        </div>
    </form>

@endsection