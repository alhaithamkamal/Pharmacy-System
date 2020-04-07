<?php

namespace App\Http\Controllers;

use App\Client;
use App\Medicine;
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
        $medicine = Medicine::create([
            'name' => request()->name,
            'quantity' => request()->quantity,
            'type' => request()->type,
            'price' => request()->price,
        ]);
        $order = Order::create([
            'user_id' => 11,
            'client_id' => request()->client_id,
            'status' => 'processing'
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
