@extends('layouts.app')

@section('content')
<form class="table m-3 col-lg-3" method="post" action="{{route('pharmacy.update',['ID'=>$pharmacy->id])}}">
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
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" value={{$pharmacy->name}}>
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">AreaID</label>
    <input type="text" name="area_id" class="form-control" id="exampleInputEmail1" value = {{$pharmacy->area_id}}>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection