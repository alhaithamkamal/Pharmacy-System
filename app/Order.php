<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function creator()
    {
        if ($this->creator_type == 'client')
            return $this->belongsTo('App\Client', 'creator_id');
        else
            return $this->belongsTo('App\Doctor', 'creator_id');
    }

    public function pharmacy()
    {
        return $this->belongsTo('App\User');
    }

    public function address()
    {
        return $this->belongsTo('App\UserAddress', 'delivering_address_id');
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
