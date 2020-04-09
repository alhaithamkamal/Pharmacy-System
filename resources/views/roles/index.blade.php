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
              <table id="role-table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Role Name</th>
                    <th>Permissions</th>
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
    
  <!-- Delete Area Modal -->
  <div class="modal" id="DeletePermissionModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Permissions Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h4>Are you sure want to delete this role with permissions?</h4>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="SubmitDeletePermissionForm">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('datatable_script')
<script>

  $(document).ready( function () {

    var table = $('#role-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('roles.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'permissions', name: 'permissions'},
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
            var deleteurl = '{{route('roles.destroy', ['role'=> ':id'])}}';
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
                //  Toastr::success('Client deleted successfully  :)','Success');
                    //  toastr()->success('Client deleted successfully ');
                    //alert('yess');
                  setTimeout(function(){
                    $('#DeletePermissionModal').modal('hide');
                    $('#role-table').DataTable().ajax.reload();
                  }, 2000);

                 
                },
                error: function (data) {
                //  alert('noo');
               //toastr()->error('can\'t delete this client');
               }
            });
        });
    
  
  });

//  toastr 

</script>
@endsection
