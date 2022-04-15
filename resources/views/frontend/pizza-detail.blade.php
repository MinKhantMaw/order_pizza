@extends('frontend.layouts.app')
@section('title', 'Pizza Details')
@section('content')
    <div class="row mt-5 d-flex justify-content-center">

        <div class="col-4 ">
            <img src="{{ asset('image/' . $pizza->image) }}" class="img-thumbnail" width="100%"> <br>
            <a href="{{route('user.pizza-order',$pizza->pizza_id)}}" class="btn btn-primary float-end mt-2 col-12"><i class="fas fa-shopping-cart"></i> Order</a>
            <a href="{{ route('user.index') }}" class="btn btn-dark btn-sm text-white mt-1">
                <i class="fa-solid fa-arrow-left rounded shadow"> Back</i>
            </a>
        </div>
        <div class="col-6">
            <div class="">
                <h5>Name</h5>
                <p> {{ $pizza->pizza_name }}</p>
            </div>
            <hr>
            <div class="">
                <h5>Price</h5>
                <p> {{ $pizza->price }} Kyats</p>
            </div>
            <hr>
            <div class="">
                <h5>Discount Price</h5>
                <p>{{ $pizza->discount_price }} Kyats</p>
            </div>
            <hr>
            <div class="">
                <h5>Buy1 Get1</h5>
                @if ($pizza->buy_one_get_one_status == 0)
                    <p class="text-success fs-5">Yes</p>
                @else
                    <p class="text-danger fs-5">No</p>
                @endif
            </div>
            <hr>
            <div class="">
                <h5>Waiting Time</h5>
                <p>{{ $pizza->waiting_time }} Minus</p>
            </div>
            <hr>
            <div class="">
                <h5>Description</h5>
                <p>{{ $pizza->description }} </p>
            </div>
            <hr>
            <div class="">
                <h5 class="text-danger">Total Price</h5>
                <p class="text-success fs-5">{{ $pizza->price - $pizza->discount_price }} Kyats </p>
            </div>
            <hr>
        </div>
    </div>
@endsection
