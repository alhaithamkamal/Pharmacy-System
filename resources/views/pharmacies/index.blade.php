@extends('layouts.app')
@section('content')
<table class="table ml-3">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Avatar</th>
      <th scope="col">NAME</th>
      <th scope="col">AreaID</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($pharmacies as $pharmacy)
    <tr>
      <td scope="row">{{$pharmacy->id}}</td>
      <td scope="row"><img src="{{asset('storage/images/' . $pharmacy->user->image)}}" width="50px" height="50px" alt="image"/></td>
      <td>{{$pharmacy->user->name}}</td>
      <td>{{$pharmacy->area_id}}</td>
      <td>
      @can('update pharmacy')
        <a href="{{route('pharmacy.edit',['pharmacyId'=>$pharmacy->id])}}" class="btn btn-success">Edit</a>
      @endcan
      @can('delete pharmacy')
        <a href="{{route('pharmacy.delete',['delId'=>$pharmacy->id])}}"  onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a></td>
      @endcan
    </tr>
    @endforeach
  </tbody>
</table>
@endsection