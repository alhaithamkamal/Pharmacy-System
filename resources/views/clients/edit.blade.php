@extends('layouts.app')

@section('content')
	

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create User</h1>
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
              <h1 class="card-title" style="font-size:1.3rem !important;">User Form</h1>
            </div>
          <div class="card-body">
            <form method="POST" action="{{route('clients.update',['client'=> $client->id])}}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }} 
            <div class="row" style="margin:20px;">
                  <div class="col-lg-6">
                  <h4 class="mt-4 mb-2">User name</h4>

                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                      </div>
                      <input type="text" class="form-control form-control-lg" name="name" 
                      value="{{old('name', $client->user->name)}}" placeholder="Username">
                    </div>
                    <!-- /input-group -->
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <!-- /.col-lg-6 -->
                  <div class="col-lg-6">
                  <h4 class="mt-4 mb-2">Email</h4>

                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                      <input type="email" class="form-control form-control-lg"  name="email" 
                      value="{{old('email',$client->user->email)}}" placeholder="Email">
                    </div>
                    <!-- /input-group -->
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            

            <div class="row" style="margin:20px;">
               
               <div class="col-lg-6">
               <h4 class="mt-4 mb-2">National ID</h4>
                 <div class="input-group">
                   <input type="number" class="form-control form-control-lg"  name="national_id" 
                   value="{{old('national_id',$client->user->national_id)}}" placeholder="National ID">
                 </div>
                 <!-- /input-group -->
                  @error('national_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
               </div>
               <!-- /.col-lg-6 -->
             
            </div>
            <!-- /.row -->
            
            <div class="row" style="margin:20px;">
                <div class="col-lg-6">
                    <h4 class="mt-4 mb-2">Image</h4>
                    <div class="input-group">
                        <img src="{{  asset('storage/'.$client->user->image) }}" width="200" height="200" style="margin-bottom: 5px;">              
                    </div>
                    <br>
                    <div class="custom-file">
                        <label class="custom-file-label form-control-lg" for="exampleInputFile">Choose file</label>
                        <input type="file" class="custom-file-input" name="image" id="exampleInputFile">
                    </div>
                    <!-- /input-group -->
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
               <!-- /.col-lg-6 -->
             
            </div>
            <!-- /.row -->

            <div class="row" style="margin:20px;">
               
               <div class="col-lg-6">
               <h4 class="mt-4 mb-2">Gender</h4>
                 <div class="form-group">
                    <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="male" 
                            {{(old('gender') === 'male' || $client->gender === 'male') ? 'checked' : ''}}>
                            <label class="form-check-label">male</label>
                    </div>
                    <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="female" 
                            {{(old('gender') === 'female' || $client->gender === 'female') ? 'checked' : ''}}>
                            <label class="form-check-label">female</label>
                    </div>
                  </div>
                  
                 <!-- /input-group -->
                  @error('gender')
                        <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
               </div>
               <!-- /.col-lg-6 -->
               
               <div class="col-lg-6">
               <h4 class="mt-4 mb-2">Insurance</h4>
                 <div class="form-group">
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="is_insured" value="0"
                           {{(old('is_insured') || $client->is_insured ) ? 'checked' : ''}}>
                          <label class="form-check-label">insured</label>
                      </div>
                  </div>
                 <!-- /input-group -->
                  @error('is_insured')
                        <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
               </div>
               <!-- /.col-lg-6 -->
             
            </div>
            <!-- /.row -->
            

            <div class="row" style="margin:20px;">
               
                  <div class="col-lg-6">
                  <h4 class="mt-4 mb-2">Birth Date</h4>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                      <input type="text" class="form-control form-control-lg"  name="birthdate"
                       value="{{old('birthdate',$client->birthdate)}}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false">
                    </div>  
                    <!-- /input-group -->
                    @error('birthdate')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <!-- /.col-lg-6 -->
                  <div class="col-lg-6">
                  <h4 class="mt-4 mb-2">Mobile Number</h4>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="number" class="form-control form-control-lg"  name="mobile" value="{{old('mobile',$client->mobile)}}" placeholder="mobile phone">
                  </div>
                  <!-- /input-group -->
                  @error('mobile')
                        <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  </div>
                  <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
                <input type="hidden" name="user_id" value="{{$client->user_id}}">

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