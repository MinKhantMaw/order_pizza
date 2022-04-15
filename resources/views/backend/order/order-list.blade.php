@extends('backend.layouts.app')
@section('title', 'Order List')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Total Order- {{ $order_list->total() }}</h3>

                                <div class="card-tools">
                                    <form action="{{route('admin.order-search')}}" method="GET">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="search_order" class="form-control float-right"
                                                placeholder="Search">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer Name</th>
                                            <th>Pizza Name</th>
                                            <th>Pizza Count</th>
                                            <th>Order Time</th>
                                            <th>Payment</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order_list as $list)
                                            <tr>
                                                <td>{{ $list->order_id }}</td>
                                                <td>{{ $list->customer_name }}</td>
                                                <td>{{ $list->pizza_name }}</td>
                                                <td>{{ $list->count }}</td>
                                                <td>{{ $list->order_time }}</td>
                                                <td>
                                                    @if ($list->payment_status == 1)
                                                        <span class="badge badge-danger">Cash on delivery</span>
                                                    @else
                                                        <span class="badge badge-success">Kpay</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm bg-dark text-white"><i
                                                            class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm bg-danger text-white"><i
                                                            class="fas fa-trash-alt"></i></button>
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
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
