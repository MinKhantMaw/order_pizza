@extends('backend.layouts.app')
@section('title', 'Pizza Details')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12 offset-2 mt-5">
                        <div class="col-md-9">
                            <a href="{{ route('admin.pizza-list') }}"><i class="fas fa-arrow-alt-circle-left text-dark ">
                                    Back</i></a>
                            <div class="card shadow">
                                <div class="card-header p-2">
                                    <legend class="text-center">Details about</legend>
                                </div>
                                <div class="card-body ">
                                    <div class="">
                                        <div class="ms-3 ">
                                            <img src="{{ asset('/image/' . $pizza->image) }}"
                                                class="img-thumbnail rounded-circle" width="150px" height="150px">
                                        </div>
                                        <div class="fs-5">
                                            <label for="">Name :: {{ $pizza->pizza_name }} </label>
                                        </div>
                                        <div class="fs-5">
                                            <label for="">Price:: {{ $pizza->price }} </label>
                                        </div>
                                        <div class="fs-5">
                                            <label for="">Publish::
                                                @if ($pizza->publish_status == 0)
                                                    <span class="text-success">Yes</span>
                                                @else
                                                    <span class="text-danger">No</span>
                                                @endif
                                            </label>
                                        </div>
                                        <div class="fs-5">
                                            <label for="" value="{{$pizza->category_id}}">
                                               Category:: {{$pizza->category_name}}
                                            </label>
                                            <div class="fs-5">
                                                <label for="">Buy1Get1 ::
                                                    @if ($pizza->buy_one_get_one_status == 0)
                                                        <span class="text-success">Yes</span>
                                                    @else
                                                        <span class="text-danger">No</span>
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="fs-5">
                                                <label for="">Discount ::{{ $pizza->discount_price }} <span
                                                        class="">Kyats</span> </label>
                                            </div>
                                            <div class="fs-5">
                                                <label for="">Waiting Time ::{{ $pizza->waiting_time }} minus </label>
                                            </div>
                                            <div class="fs-5">
                                                <label for="">Description ::{{ $pizza->description }} </label>
                                            </div>
                                            <div class="fs-5">
                                                <label for="">Created_at :: {{ $pizza->created_at }}</label>
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
