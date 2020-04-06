<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }
}
