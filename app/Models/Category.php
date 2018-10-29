<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function store()
    {
        return $this->hasOne(Store::class,"shop_category_id");
    }
    protected $fillable=["name","img","category_img"];
}
