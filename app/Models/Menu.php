<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //所属分类
    public function mc()
{
    return $this->belongsTo(MenuCategories::class,"category_id");
}
    //所属商家
    public function user(){
        return $this->hasOne(MenuCategories::class,"shop_id");
    }

    protected $fillable=["goods_name","rating","shop_id","category_id","goods_price","description","month_sales","rating_count","tips","satisfy_count","satisfy_rate","goods_img","status"];
}
