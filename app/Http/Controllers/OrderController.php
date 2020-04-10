<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Medicine;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        dd($orders);
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

    public function store(Request $order_request, StoreMedicineRequest $medicine_request)
    {
        $creator_id = auth()->user()->id;

        if (auth()->user()->role_id == 1) {
            $creator_type = 'pharmacy';
        } elseif (auth()->user()->role_id == 2) {
            $creator_type = 'doctor';
        } elseif (auth()->user()->role_id == 0) {
            $creator_type = 'admin';
        } else {
            $creator_type = 'client';
        }

        $status = 'watingForUserConfirmation';

        $medicine = Medicine::create([
            'name' => $medicine_request->name,
            'quantity' => $medicine_request->quantity,
            'type' => $medicine_request->type,
            'price' => $medicine_request->price,
        ]);
        $order = Order::create([
            'creator_type' => $creator_type,
            'client_id' => $order_request->client_id,
            'status' => $status,
            'delivering_address_id' => $order_request->order->address,
        ]);

        $order->pharmacy()->create();
        $order->doctor() ? $order->doctor()->create() : '';
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
        if ($order->status == 'processing') {
            $order->status = 'waitingForUserConfirmation';
        }
        return redirect()->route('orders.index');
    }
    public function destroy()
    {
        $orderId = request()->order;
        $order = Order::find($orderId);

        $order->delete();
        return redirect()->route('orders.index');
    }

    public function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            // dd($query);
            $data = DB::table('medicines')->where('name', 'like', '%' . $query . '%')->get();
            // dd($data);
            $output = '<ul class="dropdown-menu"
                        style="display:block;
                               position:relative">';
            foreach ($data as $row) {
                $output .= '<li><a class="dropdown-item" href="#">' .
                    $row->name . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}