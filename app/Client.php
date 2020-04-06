<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];
    protected $dateFormat = 'Y-m-d';
  
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'last_login_at' => 'datetime',
    ];

    // public function client_info()
    // {
    //     return $this->hasOne('App\User');
    // }

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function addresses()
    {
        return $this->hasMany('App\UserAddress');
    }
}
