@extends('layouts.app')

@section('content')
<table class="table ml-3">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">QUANTITY</th>
      <th scope="col">TYPE</th>
      <th scope="col">PRICE</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($medicines as $medicine)
    <tr>
      <th scope="row">{{$medicine->id}}</th>
      <td>{{$medicine->name}}</td>
      <td>{{$medicine->quantity}}</td>
      <td>{{$medicine->type}}</td>
      <td>{{$medicine->price}}</td>
      <td><a href="{{route('medicine.edit',['medicineId'=>$medicine->id])}}" class="btn btn-success">Edit</a>
      <a href="{{route('medicine.delete',['id'=>$medicine->id])}}"  onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection