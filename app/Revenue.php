<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    protected $fillable=[
   'pharmacy_name',
   'total_orders',
   'total_revenue',
   'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
