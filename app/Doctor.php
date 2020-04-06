<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    
    
    protected $fillable=[
        'name',
        'email',
        'national_id',
        'image'
        
    ];
    // public static function storePostImage($request)
    // {
    //     if ($request->file('image')) {
    //         $path = $request->file('image')->store('public/images');
    //         $path = str_replace('public/', '', $path);
    //     }else
    //         $path = null;
    //     return $path;
    // }
}
