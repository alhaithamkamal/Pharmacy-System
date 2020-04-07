<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function medicine()
    {
        return $this->belongsToMany('App\Medicine', 'medicine_order');
    }
    public static function storeOrderPrescription($request)
    {
        $prescription = [];
        if ($request->hasfile('prescription')) {
            foreach ($request->file('prescription') as $image) {
                $path = $image->store('public/prescriptions');
                $path = str_replace('public/', '', $path);
                $prescription[] = $path;
            }
            return implode(',', $prescription);
        } else {
            return null;
        }
    }
}
