@extends('layouts.app')
@section('content')
<table class="table ml-3">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">AreaID</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($pharmacies as $pharmacy)
    <tr>
      <th scope="row">{{$pharmacy->id}}</th>
      <td>{{$pharmacy->user->name}}</td>
      <td>{{$pharmacy->area_id}}</td>
      <td>
      <a href="{{route('pharmacy.edit',['pharmacyId'=>$pharmacy->id])}}" class="btn btn-success">Edit</a>
      <a href="{{route('pharmacy.delete',['delId'=>$pharmacy->id])}}"  onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection