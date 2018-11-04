<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable=["name","tel","provence","city","area","detail_address","user_id"];
}
