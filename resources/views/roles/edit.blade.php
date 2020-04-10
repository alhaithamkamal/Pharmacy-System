@extends('layouts.app')

@section('content')
	
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Role with Permissions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Role with Permissions</li>
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
              <h1 class="card-title" style="font-size:1.3rem !important;">Role with Permissions Form</h1>
            </div>
          <div class="card-body">

            <form method="POST" action="{{route('roles.update',['role'=> $role->id])}}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }} 
            <div class="row" style="margin:20px;">
                  <div class="col-lg-6">
                  <h4 class="mt-4 mb-2">role name</h4>

                  <div class="input-group">
                      <select class="form-control select2" name="role_id" style="width: 100%;">
                      <option value="{{$role->id}}" selected>{{$role->name}}</option>
                      @foreach($roles as $role1)
                        @if($role->id !== $role1->id)
                         <option value="{{$role1->id}}">{{$role1->name}}</option>
                        @endif
                      @endforeach
                    </select>
                    </div>
                    <!-- /input-group -->
                    @error('role_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            
            <div class="row" style="margin:20px;">
                  <div class="col-lg-12">
                    <h4 class="mt-4 mb-2">Permission name</h4>
                    <div class="input-group">
                      <select class="select2bs4" multiple="multiple" name="permissions[]"
                            style="width: 100%; ">
                            @foreach($permissions as $permission)
                        <option value="{{$permission->id}}" 
                              @foreach($rolePermissions as $p)
                               @if($permission->id == $p->id)selected="selected"
                               @endif @endforeach>{{$permission->name}}</option>
                            @endforeach
                        </select>
                    </div>
   
                      
                    <!-- /input-group -->
                    @error('permissions')
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