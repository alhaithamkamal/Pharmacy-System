@extends('layouts.app')

@section('content')
	

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Client : {{$clientAddress->client->user->name}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Show Client Address</li>
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
                <h1 class="card-title" style="font-size:1.3rem !important;">Show Client Address</h1>
                </div>
            <div class="card-body">
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Client Name : 
                        <span style="color: black;">{{$clientAddress->client->user->name}}</span>
                    </h2>  
                </div>
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Area Name : 
                        <span style="color: black;">{{$clientAddress->area->name}}</span>
                    </h2>     
                </div>
                
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Street Name : 
                        <span style="color: black;">{{$clientAddress->street_name}}</span>
                    </h2>     
                </div>
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Building Number :
                        <span style="color: black;">{{$clientAddress->building_number}}</span>
                    </h2>     
                </div>
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Floor Number : 
                        <span style="color: black;">{{$clientAddress->floor_number}}</span>
                    </h2>     
                </div>
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Flat Name :
                        <span style="color: black;">
                        {{$clientAddress->falt_number}}</span>
                    </h2>     
                </div>
                @if($clientAddress->is_main)
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;"> This Address is the main
                    </h2>     
                </div>
                @endif
            <!-- /.row -->
            <a class="btn btn-info float-right" href="{{route('clientsAddresses.index')}}">Back >></a>

            </div>
            <!-- /.card -->

        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    

@endsection