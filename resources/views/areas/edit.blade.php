@extends('layouts.app')

@section('content')
	

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Area</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Edit Area</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

        <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12" style="margin-left: 19px;">
          <div class="card card-info">
            <div class="card-header">
              <h1 class="card-title" style="font-size:1.3rem !important;">Area Form</h1>
            </div>
          <div class="card-body">

            <form method="POST" action="{{route('areas.update',['area'=> $area->id])}}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }} 
            <div class="row" style="margin:20px;">
                  <div class="col-lg-6">
                  <h4 class="mt-4 mb-2">Area name</h4>

                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                      </div>
                      <input type="text" class="form-control form-control-lg" name="name" value="{{old('name',$area->name)}}" placeholder="AreaName">
                    </div>
                    <!-- /input-group -->
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            
                <button type="submit" class="btn btn-info float-right">Submit</button>

            </div>
            <!-- /.card-body -->
            </form>
          </div>
          <!-- /.card -->

        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    

@endsection