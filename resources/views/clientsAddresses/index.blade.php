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
              <table id="address" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Area Name</th>
                    <th>Street Name</th>
                    <th>Building Number</th>
                    <th>Floor Number</th>
                    <th>Flat Number</th>
                    <th>Main</th>
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

    <!-- Delete Address Modal -->
    <div class="modal" id="DeleteAddressModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Address Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h4>Are you sure want to delete this Address?</h4>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="SubmitDeleteAddressForm">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('datatable_script')
<script>
  $(document).ready( function () {
    var table = $('#address').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('clientsAddresses.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'client_id', name: 'client name'},
            {data: 'area_id', name: 'area name'},
            {data: 'street_name', name: 'street name'},
            {data: 'building_number', name: 'building number'},
            {data: 'floor_number', name: 'floor number'},
            {data: 'falt_number', name: 'flat number'},
            {data: 'is_main', name: 'main'},
            {data: 'action', name: 'action', orderable: true, searchable: true},
        ]
    });
    
        // Delete product Ajax request.
        var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
            console.log(deleteID);
            
        })

        $('#SubmitDeleteProductForm').click(function(e) {
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
                  $('#SubmitDeleteProductForm').text('Deleting...');
                },
                success: function(result) {
                //  Toastr::success('Client deleted successfully  :)','Success');
                    //  toastr()->success('Client deleted successfully ');

                  setTimeout(function(){
                    $('#DeleteProductModal').modal('hide');
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
