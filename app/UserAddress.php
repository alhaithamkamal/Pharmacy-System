<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    protected $guarded = [];
    use SoftDeletes;

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }
}
