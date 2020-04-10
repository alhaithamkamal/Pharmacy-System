<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail, BannableContract
{
    use HasApiTokens, Notifiable;
    use SoftDeletes;
    use Bannable;
    use HasRoles;


    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name', 'email', 'national_id', 'image', 'password', 'role_id',

    ];

    protected $primaryKey = 'id';



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Add a mutator to ensure hashed passwords
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function client()
    {
        return $this->hasOne('App\Client');
    }

    public function doctor()
    {
        return $this->hasOne('App\Doctor');
    }

    public function pharmacy()
    {
        return $this->hasOne('App\Pharmacy');
    }

    public static function storeUserImage($request)
    {
        if ($request->file('image')) {
            $path = $request->file('image')->store('public/images');
            $path = str_replace('public/', '', $path);
        } else
            $path = null;
        return $path;
    }
}
