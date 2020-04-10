@extends('layouts.app')

@section('content')
	

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Area</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Show Area</li>
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
                <h1 class="card-title" style="font-size:1.3rem !important;">Show Area</h1>
                </div>
            <div class="card-body">
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Area ID : 
                        <span style="color: black;">{{$area->id}}</span>
                    </h2>     
                </div>
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;"> Area Name : 
                        <span style="color: black;">{{$area->name}}</span>
                    </h2>  
                </div>
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Created At : 
                        <span style="color: black;">{{$area->created_at}}</span>
                    </h2>     
                </div>
                @if($area->updated_at)
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Updated At : 
                        <span style="color: black;">{{$area->updated_at}}</span>
                    </h2>     
                </div>  
                @endif          
                
                
            <!-- /.row -->
            <a class="btn btn-info float-right" href="{{route('areas.index')}}">Back >></a>

            </div>
            <!-- /.card -->

        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    

@endsection