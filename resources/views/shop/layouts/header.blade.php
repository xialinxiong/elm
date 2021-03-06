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
            <a class="navbar-brand" href="#">店铺</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{route("shop.store.index")}}">首页 <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="{{route("shop.mc.index")}}">菜单分类管理 <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="{{route("shop.menu.index")}}">菜单管理 <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="{{route("shop.activity.index")}}">活动 <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="{{route("shop.order.index")}}">订单管理 <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="{{route("shop.event.index")}}">抽奖活动<span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">订单量统计<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("shop.order.day")}}">天数</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route("shop.order.month")}}">月份</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route("shop.order.total")}}">总计</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品销量统计<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("shop.order.cday")}}">天数</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route("shop.order.cmonth")}}">月份</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route("shop.order.ctotal")}}">总计</a></li>
                    </ul>
                </li>
            </ul>


            <ul class="nav navbar-nav navbar-right">

                @auth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">欢迎:{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route("shop.user.edit")}}">修改密码</a></li>

                            <li role="separator" class="divider"></li>
                            <li><a href="{{route("shop.user.logout")}}">注销</a></li>
                        </ul>
                    </li>
                @endauth

                @guest
                    <li><a href="{{route("shop.user.login")}}">登录</a></li>
                    <li><a href="{{route("shop.user.reg")}}">注册</a></li>
                @endguest

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>