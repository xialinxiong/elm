<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">大后台</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">首页 <span class="sr-only">(current)</span></a></li>
                @foreach(\App\Models\Nav::where('pid',0)->get() as $k1=>$v1)
                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$v1->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach(\App\Models\Nav::where('pid',$v1->id)->get() as $k2=>$v2)
                        <li><a href="{{route($v2->url)}}">{{$v2->name}}</a></li>
                            @endforeach
                    </ul>

                </li>
                @endforeach
                {{--<li class="active"><a href="{{route("admin.category.index")}}">分类管理 <span class="sr-only">(current)</span></a></li>--}}
                {{--<li class="active"><a href="{{route("admin.store.index")}}">店铺管理 <span class="sr-only">(current)</span></a></li>--}}
                {{--<li class="active"><a href="{{route("admin.user.index")}}">用户管理 <span class="sr-only">(current)</span></a></li>--}}
                {{--<li class="active"><a href="{{route("admin.activity.index")}}">活动 <span class="sr-only">(current)</span></a></li>--}}
                {{--<li class="active"><a href="{{route("admin.member.index")}}">会员管理 <span class="sr-only">(current)</span></a></li>--}}
                {{--<li class="active"><a href="{{route("admin.order.index")}}">订单 <span class="sr-only">(current)</span></a></li>--}}
                {{--<li class="active"><a href="{{route("admin.admin.index")}}">后台用户<span class="sr-only">(current)</span></a></li>--}}


                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">权限<span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route("admin.permission.index")}}">权限列表</a></li>--}}
                        {{--<li><a href="{{route("admin.permission.add")}}">增加权限</a></li>--}}
                        {{--<li><a href="#">Something else here</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">One more separated link</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">角色<span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{route("admin.role.index")}}">角色列表</a></li>--}}
                        {{--<li><a href="{{route("admin.role.add")}}">增加角色</a></li>--}}
                        {{--<li><a href="#">Something else here</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">One more separated link</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>



            <ul class="nav navbar-nav navbar-right">

                @auth("admin")
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            欢迎:{{\Illuminate\Support\Facades\Auth::guard("admin")->user()->name}}</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route("admin.admin.edit")}}">修改密码</a></li>

                            <li role="separator" class="divider"></li>
                            <li><a href="{{route("admin.admin.logout")}}">注销</a></li>
                        </ul>
                    </li>
                @endauth

                @guest("admin")
                    <li><a href="{{route("admin.admin.login")}}">登录</a></li>
                @endguest

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>