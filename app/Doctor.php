<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    
    
    protected $fillable=[
       'user_id',
        'pharmacy_id',
        'is_banned'
        
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function pharmacy()
    {
        return $this->belongsTo('App\Pharmacy');
    }
}
