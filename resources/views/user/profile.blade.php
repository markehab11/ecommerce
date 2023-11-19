@extends('user.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab"
                            aria-controls="orders" aria-selected="false">My Orders</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                            aria-controls="settings" aria-selected="false">Settings</a>
                    </li> --}}
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="py-3 pl-3 pro-tab">
                            <div class="details">
                                <p><strong>Name :</strong> {{ auth()->user()->name }} {{ auth()->user()->last_name }} </p>
                                <p><strong>Phone number :</strong> {{ auth()->user()->phone_number }} </p>
                                <p><strong>Email :</strong> {{ auth()->user()->email }} </p>
                            </div>
                            <button class="btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                        <div class="py-3 pl-3 container">
                            <div class="row">
                                <div class="col">
                                    <div id="accordion">
                                        @foreach (auth()->user()->payments as $payment)
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link text-black" data-toggle="collapse" data-target="#collapseOne{{$payment->id}}"
                                                        aria-expanded="true" aria-controls="collapseOne{{$payment->id}}">
                                                        Order #{{$payment->id}}
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapseOne{{$payment->id}}" class="collapse" aria-labelledby="headingOne"
                                                data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-lg-8 col-12">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        @foreach ($payment->orders as $order )
                                                                        <div class="col-lg-6 col-12">
                                                                            <div class="text-box py-2 d-flex">
                                                                                <img width="100" src="/images/{{$order->product->images->first()->image}}" alt="">
                                                                                <p class="pl-3 m-0"><strong></strong>{{Illuminate\Support\Str::limit($order->product->title,50)}}</p>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-12">
                                                                <div class="button-box">
                                                                    <button type="submit" class="btn btn-success form-control">Track order</button>
                                                                    <button type="submit" class="form-control mt-2">View order details</button>
                                                                    <button type="submit" class="btn form-control mt-2">Get invoice</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                        <div class="py-3 pl-3 text-center">
                            <p>Settings</p>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
