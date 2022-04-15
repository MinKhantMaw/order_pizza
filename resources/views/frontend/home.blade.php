@extends('frontend.layouts.app')
@section('title', 'Pizza Order System')
@section('content')
    <div class="container px-4 px-lg-5" id="home">
        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5">
            <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" id="code-lab-pizza"
                    src="https://www.pizzamarumyanmar.com/wp-content/uploads/2019/04/chigago.jpg" alt="..." /></div>
            <div class="col-lg-5" id="about">
                <h1 class="font-weight-light">CODE LAB Pizza</h1>
                <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it
                    makes a great use of the standard Bootstrap core components. Feel free to use this template for any
                    project you want!</p>
                <a class="btn btn-primary" href="#!">Enjoy!</a>
            </div>
        </div>

        <!-- Content Row-->
        <div class="d-flex justify-content-around">
            <div class="col-3 me-5">
                <div class="">
                    <div class="py-5 text-center">
                        <form class="d-flex me-4" method="GET" action="{{ route('user.pizza-search') }}">
                            @csrf
                            <input class="form-control me-2" name="search_pizza" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-dark" type="submit"> <i class="fas fa-search"></i> </button>
                        </form>

                        <div class="">
                            <div class="m-2 p-2">
                                <a href="{{ route('user.index') }}" class="text-decoration-none text-dark">All</a>
                            </div>

                            @foreach ($category as $list)
                                <div class="m-2 p-2">
                                    <a href="{{ route('user.category-search', $list->category_id) }}"
                                        class="text-decoration-none text-dark">{{ $list->category_name }}</a>
                                </div>
                            @endforeach

                        </div>
                        <hr>
                        <form action="{{route('user.price-search')}}" method="GET">
                            @csrf
                            <div class="text-center m-4 p-2">
                                <h3 class="mb-3">Min - Max Amount</h3>
                                    <input type="number" name="min_price" id="" class="form-control" placeholder="minimum price"> -
                                    <input type="number" name="max_price" id="" class="form-control" placeholder="maximun price">
                            </div>
                            <button type="submit" class="btn btn-sm btn-dark text-white rounded"> <i class="fas fa-search-dollar"></i> Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="row gx-4 gx-lg-5" id="pizza">
                    @if ($status == 0)
                        <h4 class="text-danger">This item is not avabile</h4>
                    @else
                        @foreach ($pizza as $list)
                            <div class="col-md-4 mb-5">
                                <div class="card h-100">
                                    <!-- Sale badge-->
                                    @if ($list->buy_one_get_one_status == 0)
                                        <div class="badge bg-dark text-white position-absolute"
                                            style="top: 0.3rem; right: 0.3rem">
                                            Buy1Get1
                                        </div>
                                    @endif
                                    <!-- Product image-->
                                    <img class="card-img-top" src="{{ asset('image/' . $list->image) }}" alt="..."
                                        width="150px" />
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">{{ $list->pizza_name }}</h5>
                                            <!-- Product price-->
                                            {{-- <span class="text-muted text-decoration-line-through">$20.00</span> $18.00 --}}
                                            <span class="text-dark fw-bold">{{ $list->price }} Kyats</span>
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center">
                                            <a href="{{ route('user.pizza-detail', $list->pizza_id) }}"
                                                class="btn btn-outline-dark mt-auto">
                                                More Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class="">
                    <span>{{ $pizza->links() }}</span>
                </div>
            </div>

        </div>
        <div class="text-center d-flex justify-content-center align-items-center bg-lime-100" id="contact">
            <div class="col-4 border shadow-sm ps-3 pt-3 pe-3 pb-2 mb-3">
                @if (Session::has('create'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <strong>{{ Session::get('create') }}</strong>
                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                <h3>Contact Us</h3>

                <form action="{{ route('user.contact-create') }}" class="my-4" method="post">
                    @csrf
                    <input type="text" name="name" id="" class="form-control my-3" placeholder="Name">
                    @if ($errors->has('name'))
                        <div class="text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <input type="email" name="email" id="" class="form-control my-3" placeholder="Email">
                    @if ($errors->has('email'))
                        <div class="text-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <input type="phone" name="phone" class="form-control my-3" placeholder="Phone">
                    @if ($errors->has('phone'))
                        <div class="text-danger">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <textarea class="form-control my-3" name="message" id="exampleFormControlTextarea1" rows="3" placeholder="Message">
                    </textarea>
                    @if ($errors->has('message'))
                        <div class="text-danger">
                            {{ $errors->first('message') }}
                        </div>
                    @endif
                    <button type="submit" class="btn btn-outline-dark">Send <i class="fas fa-arrow-right"></i></button>
                </form>
            </div>
        </div>
    @endsection
