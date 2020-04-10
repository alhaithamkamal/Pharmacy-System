<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;


class Client extends Model
{
    protected $guarded = [];

    use SoftDeletes, CascadeSoftDeletes;
    protected $dates = ['deleted_at'];
    protected $cascadeDeletes = ['addresses'];


    public function getLastLoginAtAttribute($last_login_at)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $last_login_at)->format('Y-m-d');
    }

    public function user()
    {
    return $this->belongsTo('App\User','user_id','id')->withTrashed();
    }

    public function addresses()
    {
        return $this->hasMany('App\UserAddress');
    }
    
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function pharmacies()
    {
        return $this->belongsToMany('App\Pharmacy', 'pharmay_client');
    }
}
