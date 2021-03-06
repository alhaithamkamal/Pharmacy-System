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

                    @if (Auth::user()->hasRole('admin'))
                      <th>Creator Type</th>
                      <th>Assigned Pharmacy</th>
                    @endif

                    <th >Actions On Orders</th>
                  </tr>
                </thead>
                    
                  <tbody>
                    @foreach ($orders as $order)
                  <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->client->user->name}}</td>
                    
                    <td>{{ (string) $order->address}}</td>
                    <td>{{ $order->created_at->format('d-m-Y')}}</td>

                    @if (Auth::user()->hasRole('doctor'))
                      <td>{{$order->doctor->user->name}}</td>
                    @else
                      <td></td>
                    @endif
                    
                    <td>{{ $order->is_insured}}</td>
                    <td>{{ $order->status}}</td>

                    @if (Auth::user()->hasRole('admin'))
                      <td>{{$order->creator_type}}</td>
                      <td>{{$order->pharmacy->user->name}}</td>
                    @endif

                    <td>
                      <div class="row">
                        <a href="{{route('orders.show',['order' => $order->id])}}" class="btn btn-success btn-sm mr-2">Show</a>
                        
                        @if ($order->status == 'watingForUserConfirmation')
                          <a href="#" class="btn btn-secondary btn-sm disabled ml-2">Edit</a>
                        @else
                          <a href="{{route('orders.edit', ['order' => $order->id])}}" class="btn btn-primary btn-sm ml-2">Edit</a>
                        @endif
                        
                        <form method="POST" action="{{route('orders.destroy',['order' => $order->id])}}" class="">
                          @csrf  
                          @method('DELETE')
                          <button class="btn btn-secondary btn-sm ml-2" onclick="return confirm ('are you sure?')">Delete</button>
                        </form>
                      </div>
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