<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    protected $fillable=[
   'pharmacy_name',
   'total_orders',
   'total_revenue'
    ];
}
