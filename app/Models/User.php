<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function store()
    {
        return $this->hasOne(Store::class,"user_id");
    }
    protected $fillable=["name","password","email"];
}
