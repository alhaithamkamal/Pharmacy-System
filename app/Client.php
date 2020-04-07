<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    protected $guarded = [];

    public function getLastLoginAtAttribute($last_login_at)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $last_login_at)->format('d. M, Y ');
    }
    
    use SoftDeletes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    // protected $casts = [
    //     'last_login_at' => 'date',
    // ];

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
