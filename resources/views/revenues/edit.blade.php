@extends('layouts.app')

@section('content')
<form class="table m-3 col-lg-3" method="post" action="{{route('revenue.update',['ID'=>$revenue->id])}}">
  @csrf
  @if($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach($errors->all() as $error)
    <li>
      {{$error}}
    </li>
    @endforeach
  </ul>
</div>
@endif
  <div class="form-group">
    <label for="exampleInputEmail1">Pharmacy Name</label>
    <input type="text" name="pharmacy_name" class="form-control" id="exampleInputEmail1" value={{$revenue->pharmacy_name}}>
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Total Orders</label>
    <input type="text" name="total_orders" class="form-control" id="exampleInputEmail1" value = {{$revenue->total_orders}}>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Total Revenue</label>
    <input type="text" name="total_revenue" class="form-control" id="exampleInputEmail1" value = {{$revenue->total_revenue}}>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection