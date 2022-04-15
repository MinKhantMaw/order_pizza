@extends('backend.layouts.app')
@section('title', 'Pizza Edit')
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
                                    <legend class="text-center">Edit Pizza</legend>
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
                                            <form action="{{ route('admin.pizza-update',$pizza->pizza_id) }}"
                                                method="post" class="form-horizontal" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group row">
                                                    <div class="col-sm-10 text-center">
                                                        <img src="{{ asset('image/' . $pizza->image) }}" alt=""
                                                            class="img-thumbnail" width="150px">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ $pizza->pizza_name }}"
                                                            placeholder="Enter Pizza Name">
                                                    </div>
                                                </div>
                                                 <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Image</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" class="form-control" name="image"
                                                            placeholder="Choose Pizza Image">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Price</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="price"
                                                            value="{{ $pizza->price }}" placeholder="Enter Pizza Name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Publish
                                                        Status</label>
                                                    <div class="col-sm-10">
                                                        <select name="publish" id="" class="form-control">


                                                            @if ($pizza->publish_status == 0)
                                                                <option value="0" selected>Publish</option>
                                                                <option value="1">Unpublish</option>
                                                            @else
                                                                <option value="0" selected>Publish</option>
                                                                <option value="1" selected>Unpublish</option>
                                                            @endif
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">
                                                        Category</label>
                                                    <div class="col-sm-10">
                                                        <select name="category" id="" class="form-control">
                                                            <option value="">{{ $pizza->category_name }}</option>
                                                            @foreach ($category as $category)
                                                                @if ($category->category_id != $pizza->category_id)
                                                                    <option value="{{ $category->category_id }}">
                                                                        {{ $category->category_name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Discount Price</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="discount"
                                                            value="{{ $pizza->discount_price }}"
                                                            placeholder="Enter Discount Price">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Buy 1 Get
                                                        1</label>
                                                    <div class="col-sm-10">

                                                        @if ($pizza->buy_one_get_one_status == 0)
                                                            <input type="radio" name="buyOnegetOne" value="0"
                                                                class="form-input-check" checked> Yes
                                                            <input type="radio" name="buyOnegetOne" value="1"
                                                                class="form-input-check"> No
                                                        @else
                                                            <input type="radio" name="buyOnegetOne" value="0"
                                                                class="form-input-check"> Yes
                                                            <input type="radio" name="buyOnegetOne" value="1"
                                                                class="form-input-check " checked> No
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Waiting Time</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" name="waitingTime"
                                                            value="{{ $pizza->waiting_time }}"
                                                            placeholder="Waiting Time">

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Description</label>
                                                    <div class="col-sm-10">
                                                        <textarea type="text" class="form-control" name="description" value=""
                                                            placeholder="Description">{{ $pizza->description }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" class="btn bg-dark text-white">Update</button>
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
