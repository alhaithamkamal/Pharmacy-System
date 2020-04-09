<?php

namespace App\Http\Controllers;

use App\Client;
use App\Medicine;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', [
            'orders' => $orders,
        ]);
    }

    public function create()
    {
        $clients = Client::all();
        return view('orders.create', [
            'clients' => $clients,
        ]);
    }

    public function store()
    {
        $creator_type = 'doctor';
        dd(auth()->user());
        // if(Auth::user()->role_id)

        $status = '';

        $medicine = Medicine::create([
            'name' => request()->name,
            'quantity' => request()->quantity,
            'type' => request()->type,
            'price' => request()->price,
        ]);
        $order = Order::create([
            'creator_id' => 9,
            'creator_type' => $creator_type,
            'client_id' => request()->client_id,
            'status' => $status,
            'is_insured' => '1',
            'delivering_address_id' => '2',
            'pharmacy_id' => 2
        ]);
        $medicine->order()->attach($order);

        return redirect()->route('orders.index');
    }

    public function edit()
    {
        $orderId = request()->order;
        $order = Order::find($orderId);
        $clients = Client::all();
        $medicines = $order->medicine;

        return view('orders.edit', [
            'order' => $order,
            'clients' => $clients,
            'medicines' =>  $medicines,
        ]);
    }

    public function update()
    {
        $orderId = request()->order;
        $order = Order::find($orderId);

        $data = request()->only([
            'client_id',
            'name',
            'quantity',
            'type',
            'price'
        ]);
        $order->update($data);
        return redirect()->route('orders.index');
    }
    public function destroy()
    {
        $orderId = request()->order;
        $order = Order::find($orderId);

        $order->delete();
        return redirect()->route('orders.index');
    }
}
