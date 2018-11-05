@extends("admin.layouts.main")

@section("content")
    <form class="form-inline pull-right" method="get">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="请输入会员名称" name="keyword" value="{{request()->get("keyword")}}">
        </div>

        <button type="submit" class="btn btn-primary">搜索</button>

    </form>
    <table class="table">
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>电话</th>
            <th>密码</th>
            <th>余额</th>
            <th>积分</th>
            <th>操作</th>
        </tr>
        @foreach($goods as $datas)
            <tr>
                <td>{{$datas->id}}</td>
                <td>{{$datas->username}}</td>
                <td>{{$datas->tel}}</td>
                <td>{{$datas->password}}</td>
                <td>{{$datas->money}}</td>
                <td>{{$datas->jifen}}</td>

                <td>
                    <a href="#" class="btn btn-info">禁用</a>
                </td>
            </tr>
            @endforeach
    </table>
    {{$goods->appends($url)->links()}}
@endsection