@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Clients Addresses</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Clients Addresses</li>
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
            <a class="btn btn-primary" href="{{route('clientsAddresses.create')}}">Add Client Address</a>
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
              <table id="address" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>National ID</th>
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

<!-- Delete Confirm Model Box -->
<div id="DeleteAddressModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content bg-default">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Delete <span id="jcId">Address</span></h4>
            </div>
            <div class="modal-body">
                <h5 style="text-alignment:left;">Are you sure you want to delete this address?</h5>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-success" data-dismiss="modal">Cancel</button>
                <button type="button" id="SubmitDeleteAddressForm" class="btn btn-outline-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- /.Delete Confirm Model Box -->

@endsection

@section('datatable_script')
<script>
  $(document).ready( function () {
    var table = $('#address').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('clientsAddresses.index') }}",
        columns: [
            {data: 'national_id', name: 'national_id'},
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
    
        // Delete address Ajax request. 
        var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
            console.log(deleteID);
            
        })

        $('#SubmitDeleteAddressForm').click(function(e) {
            e.preventDefault();
            var id = deleteID;
            var deleteurl = '{{route('clientsAddresses.destroy', ['clientAddress'=> ':id'])}}';
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
                  $('#SubmitDeleteAddressForm').text('Deleting...');
                },
                success: function(result) {
                  setTimeout(function(){
                    $('#DeleteAddressModal').modal('hide');
                    $('#address').DataTable().ajax.reload();
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


</script>
@endsection
