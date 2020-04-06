<?php

namespace App\Http\Controllers;

use App\Client;
use App\Order;
use App\User;
use Illuminate\Http\Request;

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
        Order::create([
            'user_id' => 11,
            'client_id' => request()->client_id,
            'status' => 'processing'
        ]);

        return redirect()->route('orders.index');
    }

    public function edit()
    {
        $orderId = request()->order;
        $order = Order::find($orderId);
        $clients = Client::all();

        return view('orders.edit', [
            'order' => $order,
            'clients' => $clients,
        ]);
    }

    public function update()
    {
        $orderId = request()->order;
        $order = Order::find($orderId);

        $data = request()->only([
            'client_id',
            'status',
        ]);
        $order->update($data);
        return redirect()->route('orders.index');
    }
}
