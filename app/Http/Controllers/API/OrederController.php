<?php

namespace App\Http\Controllers\API;

use App\Client;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrederController extends Controller
{
    public function index(Client $client)
    {
        return $client->orders;
    }

    public function show(Order $order)
    {
        return $order;
    }
}
