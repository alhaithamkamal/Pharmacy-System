<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Medicine;
use App\Notifications\OrderConfirmation;
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

    public function store(StoreOrderRequest $order_request, StoreMedicineRequest $medicine_request)
    {

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
        $client = Client::find($order_request->client_id);
        $client_address = $client->addresses()->where('is_main', true)->first();
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
            'delivering_address_id' => $client_address ? $client_address->id : null,
        ]);

        if (Auth::user()->hasRole('pharmacy')) {
            $pharmacy_id = Auth::user()->id;
            $order->create([
                'pharmacy_id' => $pharmacy_id,
            ]);
        } elseif (Auth::user()->hasRole('doctor')) {
            $doctor_id = Auth::user()->id;
            $pharmacy_id = Auth::user()->doctor->pharmacy_id;
            $order->create([
                'pharmacy_id' => $pharmacy_id,
                'doctor_id' => $doctor_id,
            ]);
        }
        $medicine->order()->attach($order->id);
        $client->user->notify(new OrderConfirmation($order));
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

    public function update(Request $request)
    {
        $orderId = $request->order;
        $order = Order::find($orderId);
        $client = Client::find($request->client_id);

        $data = $request->only([
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
        $client->user->notify(new OrderConfirmation($order));
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
