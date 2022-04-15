@extends('backend.layouts.app')
@section('title', 'User List')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                 @if (Session::has('delete'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <strong>{{ Session::get('delete') }}</strong>
                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="{{ route('admin.user-list') }}" class="btn btn-sm btn-primary">User List</a>
                                    <a href="{{ route('admin.admin-list') }}" class="btn btn-sm btn-dark text-white">Admin
                                        List</a>
                                </h3>

                                <div class="card-tools">
                                   <form action="{{route('admin.user-search')}}" method="POST">
                                     @csrf
                                     <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="search_user" class="form-control float-right"
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
                                            <th>ID</th>
                                            <th> Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $list)
                                            <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->name}}</td>
                                                <td>{{$list->email}}</td>
                                                <td>
                                                    <a href="{{route('admin.user-delete',$list->id)}}" class="btn btn-sm bg-danger text-white"><i
                                                            class="fas fa-trash-alt"></i></a>
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
