@extends('layouts.app')

@section('content')
<form class="table m-3 col-lg-3" method="post" action="{{route('revenue.store')}}" enctype="multipart/form-data">
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
  <select class="custom-select" name="pharmacy_name">
  @foreach($pharmacies as $pharmacy)
  <option value="{{$pharmacy->user->name}}">{{$pharmacy->user->name}}</option>
  @endforeach
  </select>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Total Orders</label>
    <input type="text" name="total_orders" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter # of Orders">
</div>
   <div class="form-group">
    <label for="exampleInputEmail1">Total Revenue</label>
    <input type="text" name="total_revenue" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Revenue">
 </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection