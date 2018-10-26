<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategories extends Model
{
    //所属分类
    public function mc()
    {
        return $this->hasOne(Menu::class,"category_id");
    }

    protected $fillable=["name","type_accumulation","description","is_selected","store_id"];
}
