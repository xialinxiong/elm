@extends("shop.layouts.main")

@section("content")


    <div class="col-md-8">
        <form class="form-inline pull-right" method="get">

            <div class="form-group">
                <select name="good_id" class="form-control">
                    <option value="">请选择分类</option>
                    @foreach($mc as $mcs)
                        <option value="{{$mcs->id}}">{{$mcs->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="最低价" size="5" name="minPrice" value="{{request()->get("minPrice")}}">
            </div>
            -
            <div class="form-group">
                <input type="text" class="form-control" placeholder="最高价" size="5" name="maxPrice" value="{{request()->get("maxPrice")}}">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="请输入名称" name="keyword" value="{{request()->get("keyword")}}">
            </div>

            <button type="submit" class="btn btn-primary">搜索</button>

        </form>
        <a href="{{route("shop.menu.add")}}" class="btn btn-info">添加菜单</a>
        <table class="table">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>所属分类id</th>
            <th>价格</th>
            <th>描述</th>
            <th>提示信息</th>
            <th>商品图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($goods as $datas)
            <tr>
                <td>{{$datas->id}}</td>
                <td>{{$datas->goods_name}}</td>
                <td>{{$datas->mc->name}}</td>
                <td>{{$datas->goods_price}}</td>
                <td>{{$datas->description}}</td>
                <td>{{$datas->tips}}</td>
                <td><img src="/{{$datas->goods_img}}" width="100px"></td>
                <td>@if($datas->status==1)上架@else未上架@endif</td>
                <td>
                    <a href="{{route("shop.menu.edit",$datas->id)}}" class="btn btn-info">编辑</a>
                    <a href="{{route("shop.menu.del",$datas->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>

    {{$goods->appends($url)->links()}}

@endsection