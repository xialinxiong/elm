@extends("shop.layouts.main")
@section("title","增加菜品")
@section("content")

    <form class="form-horizontal"  method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">菜单名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="goods_name" value="{{old("goods_name")}}" id="inputEmail3" placeholder="Name">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜单分类</label>
            <div class="col-sm-10">
                <select name="category_id" class="form-control">
                    <option >--选择分类--</option>
                    @foreach($data as $datas)
                        <option value="{{$datas->id}}">{{$datas->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">价格</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{old("goods_price")}}" name="goods_price" id="inputEmail3" placeholder="money">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="description" value="{{old("description")}}" id="inputEmail3" placeholder="描述">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">提示信息</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="tips" value="{{old("tips")}}" id="inputEmail3" placeholder="提示信息">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜单图片
            </label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="goods_img">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否上架
            </label>
            <div class="col-sm-10">
                <input type="radio" name="status" value="1" >上架
                <input type="radio" checked name="status" value="0" >不上架
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加分类</button>
            </div>
        </div>
    </form>

@endsection