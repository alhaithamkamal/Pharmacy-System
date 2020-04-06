@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Starter Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

        <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          
          
          <!-- Horizontal Form -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Add Doctor</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('doctors.update',['doctor'=>$doctor->national_id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

              <div class="card-body">
              <!-- name -->
              <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                          <input name="name" type="name" class="form-control" id="name" placeholder="name" value="{{$doctor->name}}">
                      </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                          <input name="email" type="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{$doctor->email}}">
                      </div>
                </div>
                
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">National ID</label>
                      <div class="col-sm-10">
                          <input name="national_id" type="number" class="form-control" id="national_id" placeholder="national_id" value="{{$doctor->national_id}}>
                      </div>
                </div>
                
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Avatar image</label>
                      <div class="col-sm-10">
                          <input name="image" type="file" class="py-3" id="image" placeholder="image" accept="image/*">
                      </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Remember me</label>
                      </div>
                    </div>
                </div>
              </div>
                <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info">edit</button>
                <button type="submit" class="btn btn-default float-right">Cancel</button>
              </div>
                <!-- /.card-footer -->
            </form>
          </div>
          <!-- /.card -->

        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    

@endsection