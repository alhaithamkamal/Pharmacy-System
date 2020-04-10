@extends('layouts.app')

@section('content')
	

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Client : {{$client->user->name}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Show Client</li>
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
                <h1 class="card-title" style="font-size:1.3rem !important;">Show Client</h1>
                </div>
            <div class="card-body">
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">National ID : 
                        <span style="color: black;">{{$client->user->national_id}}</span>
                    </h2>  
                </div>
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Name : 
                        <span style="color: black;">{{$client->user->name}}</span>
                    </h2>     
                </div>
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Image :</h2>                   
                </div>
                <div class="row" style="margin:20px;">
                    <img src="{{  asset('storage/'.$client->user->image) }}" width="200" height="200" style="margin-bottom: 5px;">
                </div>
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Email : 
                        <span style="color: black;">{{$client->user->email}}</span>
                    </h2>     
                </div>
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Gender :
                        <span style="color: black;">{{$client->gender}}</span>
                    </h2>     
                </div>
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Mobile : 
                        <span style="color: black;">{{$client->mobile}}</span>
                    </h2>     
                </div>
                <div class="row" style="margin:20px;">
                    <h2 class="mt-4 mb-2" style="color: #36a0ae;">Birthdate :
                        <span style="color: black;">
                        {{$client->birthdate}}</span>
                    </h2>     
                </div>
                
            <!-- /.row -->
            <a class="btn btn-info float-right" href="{{route('clients.index')}}">Back >></a>

            </div>
            <!-- /.card -->

        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    

@endsection