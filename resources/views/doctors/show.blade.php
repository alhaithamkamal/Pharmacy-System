@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DoctorsTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTable</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Doctor info</h3>
            </div>
            <!-- /.card-header -->
            <div class="card text-center">
  <div class="card-header">
  <h3 class="card-title">{{$doctor->user->name}}</h3>
  </div>
  <div class="card-body">
   
    <p class="card-text">{{$doctor->user->national_id}}</p>
    
    <p class="card-text">{{ $doctor->user->email }}</p>

    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-12"><img src="{{asset('storage/'.$doctor->user->image)}}" alt="" class="img-thumbnail"></div>
        </div>
      </div>
    </div>
    
    <p class="card-text">{{ $doctor->created_at ? $doctor->created_at : 'not exist'}}</p>
    
    
  </div>
  <div class="card-footer text-muted">
    
  </div>
</div>
              
                 
                 
@endsection