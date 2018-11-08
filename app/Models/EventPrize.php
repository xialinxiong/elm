<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class, "event_id");
    }
    protected $fillable=["event_id","name","description","user_id"];
}
