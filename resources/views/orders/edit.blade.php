@extends('layouts.app')

@section('content')
<div class="container col-6">
<form method="POST" action="{{route('orders.update', ['order' => $order->id])}}" class="mb-4">
        @csrf
        @method('PUT')

        <h1 class="mt-5 text-center">Edit order</h1>
        <div class="form-group">
            <label for="exampleInputPassword1">Users</label>
            <select name="user_id" class="form-control">
                @foreach($clients as $client)
                    <option value="{{$client->id}}"> {{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-2">
            <label >Medicine Name</label>
        <input name="" type="text" class="form-control" aria-describedby="emailHelp" value="">
        </div>
        <div class="form-group mt-2">
            <label >Medicine Quantity</label>
            <input name="" type="number" class="form-control" aria-describedby="emailHelp" value="">
        </div>
        <div class="form-group mt-2">
            <label >Medicine Type</label>
            <input name="" type="text" class="form-control" aria-describedby="emailHelp" value="">
        </div>
        <div class="form-group mt-2">
            <label >Medicine Price</label>
            <input name="" type="text" class="form-control" aria-describedby="emailHelp" value="">
        </div>

        <div class="form-group mt-2">
            <label >Visa Code Number</label>
            <input name="" type="text" class="form-control" aria-describedby="emailHelp">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
    
@endsection