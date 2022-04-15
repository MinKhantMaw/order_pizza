@extends('backend.layouts.app')
@section('title', 'Category Added')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-8 offset-3 mt-5">
                        <div class="col-md-9">
                             <a href="{{route('admin.category-list')}}"><i class="fas fa-arrow-alt-circle-left text-dark "> Back</i></a>
                            <div class="card">
                                <div class="card-header p-2">
                                    <legend class="text-center">Add Category</legend>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <form action="{{ route('admin.create-category') }}" method="post"
                                                class="form-horizontal">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{old('name')}}"placeholder="Enter Category Name">
                                                        @if ($errors->has('name'))
                                                            <p class="text-danger">{{ $errors->first() }}</p>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" class="btn bg-dark text-white">Added</button>
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
