<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class,"shop_category_id");
    }
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
    protected $fillable=["shop_name","shop_category_id","shop_img","shop_score","is_brand","is_time","is_feng","is_bao","is_piao","is_zhun","qi_money","pei_money","notice","discount","state","user_id"];
}
