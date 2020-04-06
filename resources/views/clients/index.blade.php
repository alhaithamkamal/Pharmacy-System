@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
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
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>gender</th>
                    <th>Email</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                  <tbody> 
                  </tbody>
              </table>
            </div>
           
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection

@section('datatable_script')
        <script>
              $(document).ready( function () {
                console.log('hello');
                var table = $('#example1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('clients.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'gender', name: 'gender'},
                        {data: 'mobile', name: 'mobile'},
                        {data: 'action', name: 'action', orderable: true, searchable: true},
                    ]
                });
                
              });
            </script>
@endsection