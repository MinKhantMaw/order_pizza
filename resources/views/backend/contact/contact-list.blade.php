@extends('backend.layouts.app')
@section('title', 'Contact List')
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
                            <div class="card-header bg-mute">
                                <h3 class="card-title">
                                    <span class="text-dark ">Contact & Suggesstion Message</span>
                                </h3>
                                <div class="card-tools">
                                    <form action="{{ route('admin.contact-search') }}" method="POST">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 150px;">
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
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($status == 1)
                                            @foreach ($contact as $item)
                                                <tr>

                                                    <td class="text-primary ">{{ $item->user_name }}</td>
                                                    <td class="text-muted fw-bold ">{{ $item->email }}</td>
                                                    <td class="text-info fw-bold ">{{ $item->phone }}</td>
                                                    <td class="text-muted fw-bold">{{ $item->message }}</td>
                                                    <td>
                                                        <a href="{{route('admin.contact-delete',$item->contact_id)}}"><i class="fas fa-trash text-danger"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <td colspan="5">You have no data.</td>
                                        </tr>
                                        @endif

                                    </tbody>
                                </table>
                                <div class="m-2">{{ $contact->links() }}</div>
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
