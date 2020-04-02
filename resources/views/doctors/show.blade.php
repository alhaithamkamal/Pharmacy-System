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
              <h3 class="card-title">DataTable with default features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card text-center">
  <div class="card-header">
  <h3 class="card-title">{{$doctor->name}}</h3>
  </div>
  <div class="card-body">
   
    <p class="card-text">{{$doctor->national_id}}</p>
    
    <p class="card-text">{{ $doctor->email ? $doctor->email : 'not exist'}}</p>
    <p class="card-text">{{ $doctor->created_at ? $doctor->created_at : 'not exist'}}</p>
    
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  <div class="card-footer text-muted">
    
  </div>
</div>
              
                 
                 
@endsection