<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable=["shop_name","shop_category_id","shop_img","shop_score","is_brand","is_time","is_feng","is_bao","is_piao","is_zhun","qi_money","pei_money","notice","discount","state","user_id"];
}
