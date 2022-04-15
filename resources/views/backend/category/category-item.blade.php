@extends('backend.layouts.app')
@section('title', 'Category Item List')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="m-3">
                            <a href="{{route('admin.category-list')}}" class="text-dark text-decoration-none"><i class="fas fa-arrow-circle-left fs-6"></i> Back</a>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <b class="btn btn-sm btn-dark">Total Pizza-{{ $pizza->total() }}</b>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Piza Name</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($pizza as $item)
                                            <tr>
                                                <td>{{$item->pizza_id}}</td>
                                                <td>
                                                    <img src="{{ asset('image/' . $item['image']) }}"
                                                        class="img-thumbnail rounded" width="100px">
                                                </td>
                                                <td>{{ $item->pizza_name }}</td>
                                                <td>
                                                    {{ $item->price }} Kyats
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="my-2 ms-1">
                                    {{-- {{ $category->links() }} --}}
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
