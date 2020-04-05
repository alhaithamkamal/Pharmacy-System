@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DoctorsTables</h1>
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
                    <th>Name</th>
                    <th>Email</th>
                    <!-- <th></th> -->
                    <th>national id</th>
                    <th>created at</th>
                    <th>Ban</th>
                  </tr>
                </thead>
                  <tbody>
                  @foreach($doctors as $doctor)
                  <tr>
                    <td>
                    <a href="{{ route('doctors.show',['doctor'=>$doctor->id]) }}">{{ $doctor->name }}</a>
                    </td>
                    <td>
                    {{ $doctor->email }}
                    </td>
                    <td>{{ $doctor->national_id }}</td>
                    <td> {{ $doctor->created_at }}</td>
                    <td>
<!-- <input type="checkbox" data-id="{{ $doctor->id }}" name="status" class="js-switch" {{ $doctor->status == 1 ? 'checked' : '' }}> -->
null
</td>

                    
                  </tr>
                  @endforeach
                  @foreach($users as $user)
                  <tr>
                    <td>
                    <a href="{{ route('doctors.show',['doctor'=>$doctor->id]) }}">{{ $user->name }}</a>
                    </td>
                    <td>
                    {{ $user->email }}
                    </td>
                    <td>{{ $doctor->id }}</td>
                    <td> {{ $doctor->created_at }}</td>
                    <td>
<input type="checkbox" data-id="{{ $user->id }}" name="status" class="js-switch" {{ $user->status == 1 ? 'checked' : '' }}>
</td>

                    
                  </tr>
                  @endforeach
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
    <script>let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
    let switchery = new Switchery(html,  { size: 'small' });
});
$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let userId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('users.update.status') }}',
            data: {'status': status, 'user_id': userId},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
});

</script>

@endsection