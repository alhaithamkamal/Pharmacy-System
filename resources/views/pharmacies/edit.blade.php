@extends('layouts.app')

@section('content')
<form class="table m-3" method="post" action="{{route('pharmacy.update',['ID'=>$pharmacy->id])}}" enctype="multipart/form-data">
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
  <div class="form-group col-lg-3 m-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{$pharmacy->user->name}}">
  </div>
  <div class="form-group col-lg-3 m-3">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" name="email" class="form-control" value="{{$pharmacy->user->email}}">
  </div>
  <div class="form-group col-lg-3 m-3">
    <label>NationalID</label>
    <input type="text" name="national_id" class="form-control" value="{{$pharmacy->user->national_id}}">
  </div>
  <div class="form-group col-lg-3 m-3">
  <label for="img">Select image:</label>
  <input type="file" id="img" name="image" accept="image" value="{{$pharmacy->user->image}}">
  </div>
   <div class="form-group col-lg-3 m-3">
    <label>AreaID</label>
    <input type="text" name="area_id" class="form-control" value="{{$pharmacy->area_id}}">
   </div>
   <div class="form-group col-lg-3 m-3">
    <label>RoleID</label>
    <input type="text" name="role_id" class="form-control" value="{{$pharmacy->user->role_id}}">
   </div>
  <button type="submit" class="btn btn-primary m-3">Update</button>
</form>
@endsection