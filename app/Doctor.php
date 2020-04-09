<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    
    
    protected $fillable=[
       'user_id',
    //    'pharmacy_id',
    //    'is_banned'
        
    ];
    // //public function user (){
    //     return $this->belongsTo('App\User');
    // }
    // public static function storePostImage($request)
    // {
    //     if ($request->file('image')) {
    //         $path = $request->file('image')->store('public/images');
    //         $path = str_replace('public/', '', $path);
    //     }else
    //         $path = null;
    //     return $path;
    // }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
