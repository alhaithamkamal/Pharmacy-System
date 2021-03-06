<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $fillable=[
        'user_id',
        'area_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function doctor(){
    	return $this->belongsTo('App\Doctor');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Client', 'pharmay_client');
    }
}
