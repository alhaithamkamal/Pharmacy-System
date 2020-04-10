@extends('layouts.app')

@section('content')
<form class="table m-3" method="post" action="{{route('pharmacy.store')}}" enctype="multipart/form-data">
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
    <input type="text" name="name" class="form-control" placeholder="Enter Name">
  </div>
  <div class="form-group col-lg-3 m-3">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email">
  </div>
  <div class="form-group col-lg-3 m-3">
    <label>NationalID</label>
    <input type="text" name="national_id" class="form-control" placeholder="Enter NationalID">
  </div>
  <div class="form-group col-lg-3 m-3">
  <label for="img">Select image:</label>
  <input type="file" id="img" name="image" accept="image">
  </div>
  <div class="form-group col-lg-3 m-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" placeholder="Enter Password">
   </div>
   <div class="form-group col-lg-3 m-3">
    <label>AreaID</label>
    <input type="text" name="area_id" class="form-control" placeholder="Enter AreaID">
   </div>
   <div class="form-group col-lg-3 m-3">
    <label>RoleID</label>
    <input type="text" name="role_id" class="form-control" placeholder="Enter RoleID">
   </div>
  <button type="submit" class="btn btn-primary m-3">Submit</button>
</form>
@endsection