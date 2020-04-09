@extends('layouts.app')

@section('content')
<form class="table m-3 col-lg-3" method="post" action="{{route('medicine.store')}}">
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
    <label for="exampleInputEmail1">Name</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Quantity</label>
    <input type="text" name="quantity" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Quantity">
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Type</label>
    <input type="text" name="type" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Type">
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input type="text" name="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Price">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection