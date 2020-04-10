@extends('layouts.app')

@section('content')

<div class="container m-5 ">
    <div class="card ">
        <div class="card-header text-center bg-primary text-light">
            Order info
        </div>
        <div class="card-body">
            <h5 class="card-title"><b>Order ID: </b> {{$order->id}}</h5>
            <p class="card-text">Order Status: </p> {{$order->status}}
            <p class="card-text"><b>Mideicines Details:</b><br>
                <div>
                    @foreach ($medicines as $medicine)
                        Medicine name: {{$medicine->name}}<br>
                        Mideicine Quantity: {{$medicine->quantity}}<br>
                        Medicine Type: {{$medicine->type}}<br>
                        Medicine Price: {{$medicine->price}}
                    @endforeach
                </div>
            </p>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header text-center bg-success text-light">
           Order Creator info
        </div>
        <div class="card-body">
            <h5 class="card-title"><b>Creator Name:</b> {{$order->creator->name}}</h5>
            <p class="card-text"><b>Creator Email:</b><br> {{$order->creator->email}}</p>
            <p class="card-text"><b>Creation Date:</b><br>{{$order->creator->getCreatedAtAttribute()}}</p>
        </div>
    </div>

     <div class="card mt-5">
        <div class="card-header text-center bg-success text-light">
           Order User info
        </div>
        <div class="card-body">
            <h5 class="card-title"><b>Order User Name:</b> {{$order->client->user->name}}</h5>
            <p class="card-text"><b>Order User Adress:</b><br> {{ (string) $order->address }}</p>
        </div>
    </div>
</div>    

@endsection