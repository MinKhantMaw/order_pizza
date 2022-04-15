@extends('backend.layouts.app')
@section('title', 'Pizza Added')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12 offset-2 mt-5">
                        <div class="col-md-9">
                            <a href="{{ route('admin.pizza-list') }}"><i class="fas fa-arrow-alt-circle-left text-dark ">
                                    Back</i></a>

                            <div class="card">
                                <div class="card-header p-2">
                                    <legend class="text-center">Add Pizza</legend>
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
                                            <form action="{{ route('admin.pizza-add') }}" method="post"
                                                class="form-horizontal" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ old('name') }}" placeholder="Enter Pizza Name">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Image</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" class="form-control" name="image" value=""
                                                            placeholder="">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Price</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="price" value=""
                                                            placeholder="Enter Pizza Name">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Publish
                                                        Status</label>
                                                    <div class="col-sm-10">
                                                        <select name="publish" id="" class="form-control">
                                                            <option value="">Choose Option</option>
                                                            <option value="0">Publish</option>
                                                            <option value="1">Unpublish</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">
                                                        Category</label>
                                                    <div class="col-sm-10">
                                                        <select name="category" id="" class="form-control">
                                                            <option value="">Choose Category</option>
                                                            @foreach ($category as $category)
                                                                <option value="{{ $category->category_id }}">
                                                                    {{ $category->category_name }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Discount Price</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="discount" value=""
                                                            placeholder="Enter Discount Price">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Buy 1 Get
                                                        1</label>
                                                    <div class="col-sm-10">
                                                        <input type="radio" name="buyOnegetOne" value="0"
                                                            class="form-input-check"> Yes
                                                        <input type="radio" name="buyOnegetOne" value="1"
                                                            class="form-input-check"> No

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Waiting Time</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" name="waitingTime"
                                                            value="{{ old('waitingTime') }}" placeholder="Waiting Time">

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Description</label>
                                                    <div class="col-sm-10">
                                                        <textarea type="text" class="form-control" name="description" value="" placeholder="Description"> </textarea>

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
