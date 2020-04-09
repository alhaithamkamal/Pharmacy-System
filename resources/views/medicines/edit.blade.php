@extends('layouts.app')

@section('content')
<form class="table m-3 col-lg-3" method="post" action="{{route('medicine.update',['ID'=>$medicine->id])}}">
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
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" value={{$medicine->name}}>
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Quantity</label>
    <input type="text" name="quantity" class="form-control" id="exampleInputEmail1" value = {{$medicine->quantity}}>
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Type</label>
    <input type="text" name="type" class="form-control" id="exampleInputEmail1" value={{$medicine->type}}>
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input type="text" name="price" class="form-control" id="exampleInputEmail1" value={{$medicine->price}}>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection