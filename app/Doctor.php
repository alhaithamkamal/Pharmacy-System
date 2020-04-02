<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    
    //
    // public static function storeDoctorImage($request)
    // {
    //     if ($request->file('image')) {
    //         $path = $request->file('image')->store('public/images');
    //         $path = str_replace('public/', '', $path);
    //     }else
    //         $path = null;
    //     return $path;
    // }
}
