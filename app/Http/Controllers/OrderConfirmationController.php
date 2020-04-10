<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderConfirmationController extends Controller
{
    public function confirm(Order $order)
    {
        $order->status = 'cofirmed';
        return view('orderconfirmation/confirmed');
    }

    public function cancel(Order $order)
    {
        $order->status = 'canceled';
        return view('orderconfirmation/caneled');
    }
}
