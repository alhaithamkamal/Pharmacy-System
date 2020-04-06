<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id',
        'status',
        'user_id',
        'prescription'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
