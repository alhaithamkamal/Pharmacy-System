<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = [
            [
                'id' => '1',
                'user_name' => 'nour',
                'user_address' => 'Alex Smoha street',
                'created_at' => '29/2/2020',
                'doctor_name' => 'Khaled',
                'user_is_insured' => 'yes',
                'status' => 'Wating For User Confirmation'
            ],
            [
                'id' => '12',
                'user_name' => 'ahmed',
                'user_address' => 'Tanta elgalaa street',
                'created_at' => '14/3/2020',
                'doctor_name' => 'Haitham',
                'user_is_insured' => 'no',
                'status' => 'Confirmed'
            ]
        ];
        return view('orders.index', [
            'orders' => $orders,
        ]);
    }

    public function create()
    {
        $orders = [
            [
                'id' => '1',
                'user_name' => 'nour',
                'user_address' => 'Alex Smoha street',
                'created_at' => '29/2/2020',
                'doctor_name' => 'Khaled',
                'user_is_insured' => 'yes',
                'status' => 'Wating For User Confirmation'
            ],
            [
                'id' => '12',
                'user_name' => 'ahmed',
                'user_address' => 'Tanta elgalaa street',
                'created_at' => '14/3/2020',
                'doctor_name' => 'Haitham',
                'user_is_insured' => 'no',
                'status' => 'Confirmed'
            ]
        ];
        return view('orders.create', [
            'orders' => $orders
        ]);
    }

    public function store()
    {

        return redirect()->route('orders.index');
    }
}
