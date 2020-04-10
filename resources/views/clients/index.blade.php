@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Clients</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Clients</li>
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
              <a class="btn btn-primary" href="{{route('clients.create')}}">Add Client</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div id="message"></div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>National ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Mobile</th>
                    <th>Birth Date</th>
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

<!-- Delete Confirm Model Box -->
<div id="DeleteClientModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content bg-default">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Delete <span id="jcId">Client</span></h4>
            </div>
            <div class="modal-body">
                <h5 style="text-alignment:left;">Are you sure you want to delete this client?</h5>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-success" data-dismiss="modal">Cancel</button>
                <button type="button" id="SubmitDelete" class="btn btn-outline-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- /.Delete Confirm Model Box -->

@endsection

@section('datatable_script')
<script>
  $(document).ready( function () {
    var table = $('#example1').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('clients.index') }}",
        columns: [
            {data: 'national_id', name: 'national_id'},
            {data: 'name', name: 'user name'},
            {data: 'email', name: 'email'},
            {data: 'gender', name: 'gender'},
            {data: 'mobile', name: 'mobile'},
            {data: 'birthdate', name: 'birth date'},
            {data: 'last_login_at', name: 'last_login'},
            {data: 'role_id', name: 'role_id'},
            {data: 'image', name: 'image'},
            {data: 'action', name: 'action', orderable: true, searchable: true},
        ]
    });
    
        // Delete client Ajax request.
        var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
            console.log(deleteID);
            
        })

        $('#SubmitDelete').click(function(e) {
            e.preventDefault();
            var id = deleteID;
            var deleteurl = '{{route('clients.destroy', ['client'=> ':id'])}}';
		        deleteurl = deleteurl.replace(':id',id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: deleteurl,
                method: 'post',
                beforeSend:function(){
                  $('#SubmitDelete').text('Deleting...');
                },
                success: function(result) {

                  setTimeout(function(){
                    $('#DeleteClientModal').modal('hide');
                    $('#example1').DataTable().ajax.reload();
                    $('#message').attr('class',"alert alert-success");
                    $('#message').html('Client deleted succussfully');
                 
                  }, 1500);
                 
                },
                error: function (data) {
                  $('#message').attr('class',"alert alert-danger");
                  $('#message').html('Failed to delete this client');
                 
               }
            });
        });

  });


</script>
@endsection
