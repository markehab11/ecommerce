@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">App Data /</span> Orders</h4>

        <div class="card">
            <div class="table-header d-flex align-items-center">
                <h5 class="card-header">Orders</h5>
            </div>
            <div class="card-body pt-0">
                <div class="text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Total</th>
                                <th>Phone Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="payment_body" class="table-border-bottom-0">
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->user->name }} {{$payment->user->last_name}}</td>
                                    <th>{{ $payment->amount }} LE</th>
                                    <th>{{ $payment->user->phone_number }}</th>

                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $payment->id }}">
                                            <i class='bx bx-show' ></i>  Show
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $payment->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">#{{ $payment->id }} {{ $payment->user->name }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div id="" class="modal-body">
                                                        <h5><strong>Details :</strong></h5>
                                                        <p class="m-0"><strong>Name :</strong> {{$payment->user->name}} {{$payment->user->last_name}}</p>
                                                        <p class="m-0"><strong>Phone Number :</strong> {{$payment->user->phone_number}}</p>
                                                        <p class="m-0"><strong>Address :</strong> {{$payment->user->details->state}} ,{{$payment->user->details->city}} ,{{$payment->user->details->street}} ,{{$payment->user->details->apartment}}</p>
                                                        <p class="m-0"><strong>Postal Code :</strong> {{$payment->user->details->postal_code}}</p>

                                                        <hr>
                                                        <h5><strong>Items :</strong></h5>
                                                        <div class="container p-0">
                                                            <div class="row px-0">
                                                                <div class="col-3 pe-0"><strong>ID</strong></div>
                                                                <div class="col-3 p-0"><strong>Item</strong></div>
                                                                <div class="col-3 text-end"><strong>Qty</strong></div>
                                                                <div class="col-3 text-center"><strong>Price</strong></div>
                                                            </div>
                                                            @foreach ($payment->orders as $order )
                                                                <div class="row px-0">
                                                                    <div class="col"><span>#{{$order->product->id    }}</span></div>

                                                                    <div class="col-3 p-0"><a href="{{route('admin.products.index')}}"><p><i class='bx bx-checkbox-minus'></i>{{Illuminate\Support\Str::limit($order->product->title,20)}}</p></a></div>
                                                                    <div class="col-3 text-end"><span>{{$order->qty}}x</span></div>
                                                                        <?php
                                                                            $oldval = intval($order->product->price);
                                                                            $pernc  = intval($order->product->discount)/100;
                                                                            $res = $oldval-($oldval*$pernc);
                                                                        ?>
                                                                    <div class="col-3 text-center"><span>{{$order->qty*$res}} LE</span></div>
                                                                </div>
                                                            @endforeach


                                                        </div>
                                                        <hr>
                                                        <h5 class="pe-4 "><strong>Total :</strong> <span style="float: right;">{{$payment->amount}} LE</span></h5>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                            <button class="btn btn-primary print_icon"><i class='bx bxs-printer' ></i></button>
                                                            <script>
                                                            </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-0">
                {{ $payments->links('pagination::bootstrap-5') }}
            </div>
        </div>



    </div>
@endsection
