@extends('layouts.app')
@section('content')
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
@endsection