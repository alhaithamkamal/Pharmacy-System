@extends('layouts.app')

@section('content')
<div class="container col-6">
<form method="POST" action="{{route('orders.update', ['order' => $order->id])}}" class="mb-4">
        @csrf
        @method('PUT')

        <h1 class="mt-5 text-center">Edit order</h1>

        <div class="form-group">
            <label for="exampleInputPassword1">Users</label>
            <select name="client_id" class="form-control">

                @foreach($clients as $client)
                    <option value="{{$client->id}}"> {{ $client->user->name}}</option>
                @endforeach
            </select>
        </div>

        @foreach ($medicines as $medicine)
            <div class="form-group mt-2">
                <label >Medicine Name</label>
            <input name="name" type="text" class="form-control" value="{{$medicine->name}}">
            </div>
            <div class="form-group mt-2">
                <label >Medicine Quantity</label>
            <input name="quantity" type="number" class="form-control" value="{{$medicine->quantity}}">
            </div>
            <div class="form-group mt-2">
                <label >Medicine Type</label>
            <input name="type" type="text" class="form-control" value="{{$medicine->type}}">
            </div>
            <div class="form-group mt-2">
                <label >Medicine Price</label>
            <input name="price" type="text" class="form-control" value="{{$medicine->price}}">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </form>
</div>
    
@endsection