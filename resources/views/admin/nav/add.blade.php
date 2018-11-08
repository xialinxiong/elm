@extends("admin.layouts.main")
@section("title","菜单添加")

@section("content")

    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label class="col-sm-2 control-label">名字</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="名字" name="name" value="{{old("name")}}" style="width: 400px;">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">地址</label>
            <div class="col-sm-10">
                <select name="url" class="form-control" style="width: 400px;">>
                    <option value="">--请选择--</option>
                    @foreach($urls as $url)
                        <option value="{{$url}}">{{$url}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">上级菜单</label>
            <div class="col-sm-10">
                <select name="pid" class="form-control" style="width: 400px;">>
                    <option value="">--请选择--</option>
                    <option value="0">导航栏</option>
                    @foreach($navs as $nav)
                        <option value="{{$nav->id}}">{{$nav->name}}</option>
                    @endforeach
                </select>
                {{--<input type="text" class="form-control" placeholder="上级菜单" name="pid" value="{{old("pid")}}" style="width: 400px;">--}}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>


@endsection

@extends("admin.layouts._footer")
