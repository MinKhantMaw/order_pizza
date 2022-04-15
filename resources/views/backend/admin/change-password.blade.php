@extends('backend.layouts.app')
@section('title', 'Change Password')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12 offset-2  mt-5">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <legend class="text-center">Change Password</legend>
                                </div>
                                <div class="card-body">
                                    @if (Session::has('notMatch'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                            <strong>{{ Session::get('notMatch') }}</strong>
                                            <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (Session::has('notSame'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                            <strong>{{ Session::get('notSame') }}</strong>
                                            <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (Session::has('short'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                            <strong>{{ Session::get('short') }}</strong>
                                            <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (Session::has('success'))
                                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                            <strong>{{ Session::get('success') }}</strong>
                                            <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <form class="form-horizontal"
                                                action="{{ route('admin.update-password', Auth()->user()->id) }}"
                                                method="post">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class=" col-form-label">Old
                                                        Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" name="old_password"
                                                            value="" placeholder="">
                                                        @if ($errors->has('old_password'))
                                                            <p class="text-danger">{{ $errors->first('old_password') }}
                                                            </p>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <label class=" col-form-label">New Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" name="new_password"
                                                            value="" placeholder="">
                                                        @if ($errors->has('new_password'))
                                                            <p class="text-danger">{{ $errors->first('new_password') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class=" col-form-label">Confirm
                                                        Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control"
                                                            name="confirm_password" value="" placeholder="">
                                                        @if ($errors->has('confirm_password'))
                                                            <p class="text-danger">
                                                                {{ $errors->first('confirm_password') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="d-flex ">
                                                    <div class="">
                                                        <button type="submit" class="btn  btn-primary">Confirm</button>
                                                    </div>
                                                    <div class="ms-2">
                                                        <a href="{{ route('admin.index') }}" type="submit"
                                                            class="btn  btn-danger">Cancel</a>
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
