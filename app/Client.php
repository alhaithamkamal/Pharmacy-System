<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'last_login_at' => 'datetime',
    ];

    public function client_info()
    {
        return $this->hasOne('App\User');
    }
    public function adresses()
    {
        return $this->hasMany('App\UserAddress');
    }
}
