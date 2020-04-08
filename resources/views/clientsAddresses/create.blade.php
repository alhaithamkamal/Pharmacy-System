@extends('layouts.app')

@section('content')
	

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create User Addresses</h1>
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
        <div class="col-12" style="margin-left: 19px;">
          <div class="card card-info">
            <div class="card-header">
              <h1 class="card-title" style="font-size:1.3rem !important;">User Addresses Form</h1>
            </div>
          <div class="card-body">
            <form method="POST" action="{{route('clientsAddresses.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row" style="margin:20px;">
                  <div class="col-lg-6">
                  <h4 class="mt-4 mb-2">User National ID</h4>
                  <div class="input-group">
                    <select class="form-control select2" name="client_id" style="width: 100%;">
                      @foreach($clients as $client)
                         <option value="{{$client->id}}">{{$client->user->national_id}}</option>
                      @endforeach
                    </select>
                  </div>
                <!-- /.form-group -->
                    @error('national_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <!-- /.col-lg-6 -->
                  <div class="col-lg-6">
                  <h4 class="mt-4 mb-2">Area Name</h4>
                  <div class="input-group">
                    <select class="form-control select2" name="area_id" style="width: 100%;">
                        @foreach($areas as $area)
                           <option value="{{$area->id}}">{{$area->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <!-- /.form-group -->
                    @error('area')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            

            <div class="row" style="margin:20px;">
               
               <div class="col-lg-6">
               <h4 class="mt-4 mb-2">Street Name</h4>
                 <div class="input-group">
                   <input type="text" class="form-control form-control-lg"  name="street_name" value="{{old('street_name')}}" placeholder="street name">
                 </div>
                 <!-- /input-group -->
                  @error('street_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
               </div>
               <!-- /.col-lg-6 -->
               <div class="col-lg-6">
               <h4 class="mt-4 mb-2">Building Number</h4>
                 <div class="input-group">
                   <input type="number" class="form-control form-control-lg"  name="building_number" value="{{old('building_number')}}" placeholder="building number">
                 </div>
                 <!-- /input-group -->
                  @error('building_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
               </div>
               <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->


            <div class="row" style="margin:20px;">
               
               <div class="col-lg-6">
               <h4 class="mt-4 mb-2">Floor Number</h4>
                 <div class="input-group">
                   <input type="number" class="form-control form-control-lg"  name="floor_number" value="{{old('floor_number')}}" placeholder="floor number">
                 </div>
                 <!-- /input-group -->
                  @error('floor_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
               </div>
               <!-- /.col-lg-6 -->
               <div class="col-lg-6">
               <h4 class="mt-4 mb-2">Flat Number</h4>
                 <div class="input-group">
                   <input type="number" class="form-control form-control-lg"  name="flat_number" value="{{old('flat_number')}}" placeholder="flat number">
                 </div>
                 <!-- /input-group -->
                  @error('flat_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
               </div>
               <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            

            <div class="row" style="margin:20px;">
                             
               <div class="col-lg-6">
               <h4 class="mt-4 mb-2">Main Address</h4>
                 <div class="form-group">
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="is_main" id="main" value="" {{(old('is_main')) ? 'checked' : ''}}>
                          <label class="form-check-label">main</label>
                      </div>
                  </div>
                 <!-- /input-group -->
                  @error('main')
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

