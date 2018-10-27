<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## 记录Day03

开发任务
商户端 
- 菜品分类管理 
- 菜品管理 
要求 
- 一个商户只能有且仅有一个默认菜品分类 
- 只能删除空菜品分类 
- 必须登录才能管理商户后台（使用中间件实现） 
- 可以按菜品分类显示该分类下的菜品列表 
- 可以根据条件（按菜品名称和价格区间）搜索菜品

实现步骤
 - 1.做好准备工作 
 - 2.商品分类  在添加分类的同时把登陆的商家id
     在添加数据中加进去 
 - 3.显示分类时 要根据当前登陆者的id 把只属于这个登陆者的
 分类读出来
 - 4.添加分类中的菜品
 - 5.添加菜品的时候 也要把用户id 分类id 加进去 
 - 6.显示时加where语句 只显示当前登陆用户的数据
 - 7.添加分页 。 搜索功能  
 
 
 
 #要点难点及解决方案
 
 在开始之前可以先理一下 表与表之间的关系 
 字段与字段的意思  
 在删除东西时 要考虑 有没有跟其他表有关联 
 
 一般来说，除了最下一层 不交互的表 可以直接删除  其他的 基本都要考虑
 
 
 