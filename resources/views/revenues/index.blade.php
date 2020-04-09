@extends('layouts.app')
@section('content')

@if (auth()->user()->role_id ==0) 
    <table class="table ml-3">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Pharmacy_Avatar</th>
      <th scope="col">Pharmacy_Name</th>
      <th scope="col">Total Orders</th>
      <th scope="col">Total Revenue</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($revenues as $revenue)
    <tr>
      <th scope="row">{{$revenue->id}}</th>
      <td><img src="{{assets('uploads/images' . $revenue->user->image)}}"/></td>
      <td>{{$revenue->pharmacy_name}}</td>
      <td>{{$revenue->total_orders}}</td>
      <td>{{$revenue->total_revenue}}</td>
      <td>
      <a href="{{route('revenue.edit',['revenueId'=>$revenue->id])}}" class="btn btn-success">Edit</a>
      <a href="{{route('revenue.delete',['delId'=>$revenue->id])}}"  onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>

@elseif(auth()->user()->role_id == 1)
  <div class="container m-5 ">
    <div class="card ">
        <div class="card-header text-center bg-primary text-light">
            Pharmacy Total Revenue
        </div>
         {{$revenue = Revenue::where('pharmacy_name', auth->user()->name)->first();}}
        <div class="card-body">
            <h5 class="card-title"><b>Pharmacy Name</b>{{$revenue->pharmacy_name}}</h5>
            <p class="card-text">Total Revenue: </p> {{$revenue->total_revenue}} </p>
            
        </div>
    </div>

@endif
@endsection
