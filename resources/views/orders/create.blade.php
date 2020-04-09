@extends('layouts.app')

@section('content')
<div class="container col-6">
<form method="POST" action="{{route('orders.store')}}" class="mb-4">
        @csrf
        <h1 class="mt-5 text-center">Create New Order</h1>

        <div class="form-group">
            <label for="exampleInputPassword1">Users</label>
            <select name="client_id" class="form-control">

                @foreach($clients as $client)
                    <option value="{{$client->id}}"> {{ $client->user->name}}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group mt-2">
            <label >Medicine Name</label>
            <input name="name" type="text" class="form-control">
        </div>
        <div class="form-group mt-2">
            <label >Medicine Quantity</label>
            <input name="quantity" type="number" class="form-control">
        </div>
        <div class="form-group mt-2">
            <label >Medicine Type</label>
            <input name="type" type="text" class="form-control">
        </div>
        <div class="form-group mt-2">
            <label >Medicine Price</label>
            <input name="price" type="text" class="form-control">
        </div>

        <div class="form-group mt-2">
        <a href="{{route('stripe.stripe')}}" class="btn btn-primary">Enter Visa Card Number</a>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
    
@endsection