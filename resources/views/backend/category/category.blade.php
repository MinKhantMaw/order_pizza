@extends('backend.layouts.app')
@section('title', 'Category List')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if (Session::has('categorySuccess'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <strong>{{ Session::get('categorySuccess') }}</strong>
                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('deleteCategory'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <strong>{{ Session::get('deleteCategory') }}</strong>
                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                {{-- @if (Session::has('deleteCategory'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <strong>{{ Session::get('deleteCategory') }}</strong>
                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif --}}
                @if (Session::has('categoryUpdate'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <strong>{{ Session::get('categoryUpdate') }}</strong>
                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="{{ route('admin.add-category') }}" class="btn btn-sm btn-outline-dark">Add
                                        Category</a>
                                    <b class="btn btn-sm btn-dark">Total Pizza-{{ $category->total() }}</b>
                                </h3>
                                <div class="card-tools d-flex ">
                                    <a href="{{route('admin.download-category')}}"><button type="submit" class="btn btn-sm btn-success mt-1 me-2 rounded">Download CSV</button></a>

                                    <form action="{{ route('admin.search-category') }}" method="post">
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
                                            <th>Category Name</th>
                                            <th>Product Count</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($status == 0)
                                            <tr class="text-danger fs-5">
                                                <td colspan="3">You have not data.</td>
                                            </tr>
                                        @else
                                            @foreach ($category as $item)
                                                <tr>
                                                    <td>{{ $item->category_name }}</td>
                                                    <td>
                                                        @if ($item->count == 0)
                                                            <a href="#"
                                                                class="text-decoration-none text-danger">{{ $item->count }}</a>
                                                        @else
                                                            <a href="{{ route('admin.category.item', $item->category_id) }}"
                                                                class="text-decoration-none text-success">{{ $item->count }}</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.category-edit', $item->category_id) }}"
                                                            class="btn btn-sm bg-dark text-white"><i
                                                                class="fas fa-edit"></i></a>
                                                        <a href="{{ route('admin.delete-category', $item->category_id) }}"
                                                            class="btn btn-sm bg-danger text-white"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="my-2 ms-1">
                                    {{ $category->links() }}
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
