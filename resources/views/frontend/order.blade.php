@extends('frontend.layouts.app')
@section('title', 'Pizza Order Page')
@section('content')
    <div class="row mt-5 d-flex justify-content-center">

        <div class="col-4 ">
            <img src="{{ asset('image/' . $pizza->image) }}" class="img-thumbnail" width="100%"> <br>
            <a href="{{ route('user.index') }}" class="btn btn-dark btn-sm text-white mt-1">
                <i class="fa-solid fa-arrow-left rounded shadow"> Back</i>
            </a>
        </div>
        <div class="col-6">
            @if(session('totalTime'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    Order Success ! Please Wait {{Session::get('totalTime')}} Minutes
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </div>
            @endif
            <div class="">
                <h5>Name</h5>
                <p> {{ $pizza->pizza_name }}</p>
            </div>
            <hr>
            <div class="">
                <h5>Price</h5>
                <p> {{ $pizza->price - $pizza->discount_price }} Kyats</p>
            </div>
            <hr>
            <div class="">
                <h5>Waiting Time</h5>
                <p>{{ $pizza->waiting_time }} Minus</p>
            </div>
            <hr>
            <form action="{{ route('user.order-create') }}" method="POST">
                @csrf
                <div class="">
                    <h5>Add Pizza</h5>
                    <input type="number" name="pizzaCount" class="form-control" placeholder="Pizza want count">
                    @if($errors->has('pizzaCount'))
                        <div class="text-danger">
                            {{ $errors->first('pizzaCount') }}
                        </div>

                    @endif
                </div>
                <hr>
                <h5>Payment Choose</h5>
                <div class="form-check form-check-inline">
                    <input type="radio" name="payment" class="form-check-input" value="1">
                    <label for="">Chsh on Deliver</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="payment" class="form-check-input" value="0">
                    <label for="">Kpay</label>
                </div>
                @if($errors->has('payment'))
                    <div class="text-danger">
                        {{ $errors->first('payment') }}
                    </div>
                @endif
                <br>
                <button  type="submit" class="btn btn-primary  mt-2 ">
                    <i class="fas fa-shopping-cart"></i> Order
                </button>
            </form>
        </div>
    </div>
@endsection
