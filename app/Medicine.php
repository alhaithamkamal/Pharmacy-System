<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{

    protected $fillable = [
        'name',
        'quantity',
        'type',
        'price'
    ];
    public function order()
    {
        return $this->belongsToMany('App\Order', 'medicine_order');
    }
}
