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
            <input name="" type="text" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-2">
            <label >Medicine Quantity</label>
            <input name="" type="number" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-2">
            <label >Medicine Type</label>
            <input name="" type="text" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-2">
            <label >Medicine Price</label>
            <input name="" type="text" class="form-control" aria-describedby="emailHelp">
        </div>

        <div class="form-group mt-2">
            <label >Visa Code Number</label>
            <input name="" type="text" class="form-control" aria-describedby="emailHelp">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
    
@endsection