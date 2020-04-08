<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
