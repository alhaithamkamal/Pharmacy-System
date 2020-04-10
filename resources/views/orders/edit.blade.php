@extends('layouts.app')

@section('content')
<div class="container col-6">
<form method="POST" action="{{route('orders.update', ['order' => $order->id])}}" class="mb-4">
        @csrf
        @method('PUT')

        <h1 class="mt-5 text-center">Edit Order Add Medicines</h1>

        @foreach ($medicines as $medicine)
            <div class="form-group mt-2">
                <label >Medicine Name</label>
            <input name="name" type="text" class="form-control" value="{{$medicine ? $medicine->name : ''}}">
            </div>
            <div class="form-group mt-2">
                <label >Medicine Quantity</label>
            <input name="quantity" type="number" class="form-control" value="{{$medicine ? $medicine->quantity : ''}}">
            </div>
            <div class="form-group mt-2">
                <label >Medicine Type</label>
            <input name="type" type="text" class="form-control" value="{{$medicine ? $medicine->type : ''}}">
            </div>
            <div class="form-group mt-2">
                <label >Medicine Price</label>
            <input name="price" type="text" class="form-control" value="{{$medicine ? $medicine->price : ''}}">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </form>
</div>
    
@endsection