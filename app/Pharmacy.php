<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $fillable=[
    	'user_id',
    	'area_id'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
