@extends('layouts.app')

@section('content')

<div class="container col-12">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orders Table</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body text-center">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Order User Name</th>
                    <th>Delivery Address</th>
                    <th>Creation Date</th>
                    <th>Doctor Name</th>
                    <th>Is_insured</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                  <tbody>
                    
                    @foreach ($orders as $order)
                  <tr>
                    <td>{{ $order['id'] }}</td>
                    <td>{{ $order['user_name'] }}</td>
                    <td>{{ $order['user_address'] }}</td>
                    <td>{{ $order['created_at'] }}</td>
                    <td>{{ $order['doctor_name'] }}</td>
                    <td>{{ $order['user_is_insured'] }}</td>
                    <td>{{ $order['status']}}</td>
                    <td>
                    <a href="" class="btn btn-primary mr-2">Edit</a>
                    <a href="{{route('orders.index')}}" class="btn btn-secondary">Delete</a>

                    </td>
                  </tr>
                  @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

@endsection