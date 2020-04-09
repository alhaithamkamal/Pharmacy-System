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
        $creator_id = auth()->user()->id;

        if (auth()->user()->role_id == 1) {
            $creator_type = 'pharmacy';
        } elseif (auth()->user()->role_id == 2) {
            $creator_type = 'doctor';
        } elseif (auth()->user()->role_id == 0) {
            $creator_type = 'admin';
        }

        $status = 'processing';

        $medicine = Medicine::create([
            'name' => request()->name,
            'quantity' => request()->quantity,
            'type' => request()->type,
            'price' => request()->price,
        ]);
        $order = Order::create([
            'creator_id' => $creator_id,
            'creator_type' => $creator_type,
            'client_id' => request()->client_id,
            'status' => $status,
            'delivering_address_id' => request()->order->address,
        ]);

        $order->pharmacy()->create();
        $medicine->order()->attach($order);

        return redirect()->route('orders.index');
    }
    public function show()
    {
        $orderId = request()->order;
        $order = Order::find($orderId);
        $medicines = $order->medicine;

        return view('orders.show', [
            'order' => $order,
            'medicines' =>  $medicines,
        ]);
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
