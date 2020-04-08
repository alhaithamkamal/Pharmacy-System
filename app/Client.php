<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;


class Client extends Model
{
    protected $guarded = [];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function getLastLoginAtAttribute($last_login_at)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $last_login_at)->format('d. M, Y ');
    }
    
    use SoftDeletes, CascadeSoftDeletes;

    // protected $cascadeDeletes = ['UserAddress'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    // protected $casts = [
    //     'last_login_at' => 'date',
    // ];

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
        return $this->hasMany('App\Order', 'creator_id');
    }
}
