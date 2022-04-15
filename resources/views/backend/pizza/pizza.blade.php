@extends('backend.layouts.app')
@section('title', 'Pizza List')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if (Session::has('create'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <strong>{{ Session::get('create') }}</strong>
                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('delete'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <strong>{{ Session::get('delete') }}</strong>
                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('update'))
                    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                        <strong>{{ Session::get('update') }}</strong>
                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="{{ route('admin.pizza-create') }}" class="btn btn-sm bg-dark text-white">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <b class="btn btn-sm btn-info ">Total Pizza- {{$pizza->total()}}</b>
                                </h3>
                                <div class="card-tools d-flex ">
                                    <a href="{{route('admin.download-pizza')}}"><button class="btn btn-sm btn-success rounded mt-1 me-2">Download CSV</button></a>
                                    <form action="{{ route('admin.pizza-search') }}" method="POST">
                                        @csrf
                                        <div class="input-group input-group-sm mt-1" style="width: 150px;">
                                            <input type="text" name="search_data" class="form-control float-right"
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
                                            <th>Id</th>
                                            <th>Pizza Name</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Publish Status</th>
                                            <th>Buy 1 Get 1 Status</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($status == 0)
                                            <tr style="font-size:20px">
                                                <td colspan="7" class="text-danger">You have no data</td>
                                            </tr>
                                        @else
                                            @foreach ($pizza as $item)
                                                <tr>
                                                    <td>{{$item['pizza_id']}}</td>
                                                    <td>{{ $item['pizza_name'] }}</td>
                                                    <td>
                                                        <img src="{{ asset('image/' . $item['image']) }}"
                                                            class="img-thumbnail" width="100px">
                                                    </td>
                                                    <td>{{ $item['price'] }} kyats</td>
                                                    <td>
                                                        @if ($item['publish_status'] == 0)
                                                            <span class="text-success fs-5">Publish</span>
                                                        @elseif ($item['publish_status'] == 1)
                                                            <span class="text-danger fs-5">Unpublish</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item['buy_one_get_one_status'] == 0)
                                                            <span class="text-success fs-5">Yes</span>
                                                        @elseif ($item['buy_one_get_one_status'] == 1)
                                                            <span class="text-danger fs-5">No</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.pizza-edit', $item['pizza_id']) }} "
                                                            class="text-decoration-none">
                                                            <button class="btn btn-sm bg-dark text-white ">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('admin.pizza-delete', $item['pizza_id']) }}"
                                                            class="text-decoration-none">
                                                            <button class="btn btn-sm bg-danger text-white">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('admin.pizza-detail', $item['pizza_id']) }}">
                                                            <button class="btn btn-sm btn-primary text-white">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="my-2 ms-1">
                                    {{ $pizza->links() }}
                                </div>
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
