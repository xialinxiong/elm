<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function shop()
    {
        return $this->belongsTo(Store::class, "shop_id");
    }
    public function goods()
    {
        return $this->hasMany(OrderDetail::class, "order_id");
    }
    protected $fillable=["user_id","shop_id","order_code","province","city","area","detail_address","tel","name","total","status"];
}
