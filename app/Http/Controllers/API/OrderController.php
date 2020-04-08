<?php

namespace App\Http\Controllers\API;

use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(Client $client)
    {
        return $client->orders;
    }

    public function store(OrderRequest $request)
    {
        Auth::user()->client->orders()->create([
            'status' => 'new',
            'creator_type' => 'client',
            'is_insured' => $request->is_insured,
            'delivering_address_id' => $request->delivering_address_id,
            'prescription' => Order::storeOrderPrescription($request)
        ]);
        return response('Order has been created');
    }
    
    public function show(Order $order)
    {
        return $order;
    }

    public function update(OrderRequest $request, Order $order)
    {
        if ($order->status !== 'new') {
            $request->validate(['cancel' => 'required|boolean']);
            $attributes = [
                'is_insured' => $request->is_insured,
                'delivering_address_id' => $request->delivering_address_id,
            ];
            if ($request->hasfile('prescription')) {
                $attributes['prescription'] = Order::storeOrderPrescription($request);
                $prescriptions = explode(',', $order->prescription);
                foreach ($prescriptions as $prescription) {
                    Storage::delete('public/'.$prescription);
                }
            }
            if ((bool)$request->cancel) {
                $attributes['status'] = 'canceled';
            }
            $order->update($attributes);
            return response('Order has been updated');
        }
        else
            return response('You can only modify new orders', 203);
    }
}
