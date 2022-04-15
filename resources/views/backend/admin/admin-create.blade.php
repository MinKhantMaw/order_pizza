@extends('backend.layouts.app')
@section('title', 'Admin Account Create')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12 offset-2 mt-5">
                        <div class="col-md-9">
                            <a href="{{ route('admin.admin-list') }}"><i class="fas fa-arrow-alt-circle-left text-dark ">
                                    Back</i></a>
                            <div class="card">
                                <div class="card-header p-2">
                                    <legend class="text-center">Create Admin</legend>
                                </div>
                                <div>
                                    <span>
                                        @if ($errors->any())
                                            <div class="alert alert-danger m-2">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <form action="{{route('admin.admin-add')}}" method="post" class="form-horizontal"
                                                enctype="multipart/form-data" method="POST">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{old('name')}}" placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" name="email" value="{{old('email')}}"
                                                            placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" name="password" value=""
                                                            placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Confirm Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" name="confirm_password"
                                                            value="" placeholder="Confirm Password">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" class="btn bg-dark text-white">Create</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
