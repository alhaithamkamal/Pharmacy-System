@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Permissions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Permissions</li>
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
            <a class="btn btn-primary" href="{{route('permissions.create')}}">Add new permission</a>
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
              <table id="permission-table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Permission Name</th>
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
<div id="DeletePermissionModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content bg-default">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Delete <span id="jcId">Permission</span></h4>
            </div>
            <div class="modal-body">
                <h5 style="text-alignment:left;">Are you sure you want to delete this permission?</h5>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-success" data-dismiss="modal">Cancel</button>
                <button type="button" id="SubmitDeletePermissionForm" class="btn btn-outline-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- /.Delete Confirm Model Box -->

@endsection

@section('datatable_script')
<script>

  $(document).ready( function () {

    var table = $('#permission-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('permissions.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: true, searchable: true},
        ],
      
    });

          // Delete area Ajax request.
          var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
            console.log(deleteID);
            
        })

        $('#SubmitDeletePermissionForm').click(function(e) {
            e.preventDefault();
            var id = deleteID;
            var deleteurl = '{{route('permissions.destroy', ['permission'=> ':id'])}}';
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
                  $('#SubmitDeletePermissionForm').text('Deleting...');
                },
                success: function(result) {
                  setTimeout(function(){
                    $('#DeletePermissionModal').modal('hide');
                    $('#permission-table').DataTable().ajax.reload();
                    $('#message').attr('class',"alert alert-success");
                    $('#message').html('client address deleted succussfully');
                  }, 2000);

                 
                },
                error: function (data) {
                  $('#message').attr('class',"alert alert-danger");
                  $('#message').html('Failed to delete this address');
               }
            });
        });
    
  
  });

//  toastr 

</script>
@endsection
