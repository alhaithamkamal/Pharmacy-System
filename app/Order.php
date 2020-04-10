<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'doctor_id',
        'creator_type',
        'client_id',
        'status',
        'delivering_address_id',
        'pharmacy_id',
        'is_insured'
    ];

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function pharmacy()
    {
        return $this->belongsTo('App\Pharmacy', 'pharmacy_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Client', 'client_id');
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
