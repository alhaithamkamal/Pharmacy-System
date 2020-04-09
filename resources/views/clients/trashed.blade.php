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
                    <th>National ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Mobile</th>
                    <th>Birth Date</th>
                    <th>is_insured</th>
                    <th>last login</th>
                    <th>Role</th>
                    <th>Image</th>
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
<!-- Restore Confirm Model Box -->
<div id="restoreModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content bg-default">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Restore <span id="jcId">Job</span></h4>
                </div>
                <div class="modal-body">
                    <h5 style="text-alignment:left;">Are you sure you want to restore this job?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-success" data-dismiss="modal">Cancel</button>
                    <button type="button" name="restore_btn" id="restore_btn" class="btn btn-outline-danger">Restore</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.Restore Confirm Model Box -->

@endsection

@section('datatable_script')
<script>
  $(document).ready( function () {
    var table = $('#example1').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('clients.trashed') }}",
        columns: [
            {data: 'national_id', name: 'national_id'},
            {data: 'name', name: 'user name'},
            {data: 'email', name: 'email'},
            {data: 'gender', name: 'gender'},
            {data: 'mobile', name: 'mobile'},
            {data: 'birthdate', name: 'birth date'},
            {data: 'is_insured', name: 'is_insured'},
            {data: 'last_login_at', name: 'last_login'},
            {data: 'role_id', name: 'role_id'},
            {data: 'image', name: 'image'},
            {data: 'action', name: 'action', orderable: true, searchable: true},
        ]
    });

    // restore client Ajax request.
    var restoreID;
    $('body').on('click', '#getRestoreId', function(){
        restoreID = $(this).data('id');
        console.log(restoreID);
        
    })

    $("#restore_btn").click(function() {
            var id = restoreID;
            var restoreurl = '{{route('clients.restore', ['client'=> ':id'])}}';
            restoreurl = restoreurl.replace(':id',id);
            console.log(restoreurl);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            type: "post",
            url: restoreurl,
            beforeSend:function(){
              $('#restore_btn').text('restoring...');
            },
            success: function(data) {
              setTimeout(function(){
                $('#restoreModal').modal('hide');
                $('#example1').DataTable().ajax.reload();
              }, 2000);

              
            },
            error: function (data) {
            //toastr()->error('can\'t delete this client');
            }
          
        });
    });
    


  });


</script>
@endsection
