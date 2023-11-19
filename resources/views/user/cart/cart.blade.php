@extends('user.layouts.app')
@section('content')
<div class="container">
    @if (Session::has('cart'))
    @if(count(request()->session()->get('cart')->items)>0)
            <div class="Shopping-cart-area pt-60 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-12">

                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="li-product-remove">Remove</th>
                                                <th class="li-product-thumbnail">Image</th>
                                                <th class="cart-product-name">Name</th>
                                                <th class="li-product-price">Price</th>
                                                <th class="li-product-quantity">Qty</th>
                                                <th class="li-product-subtotal">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (request()->session()->get('cart')->items as $product )
                                            <tr>
                                                <td class="li-product-remove">
                                                    <form action="{{route('cart.remove')}}" method="POST">
                                                        @csrf
                                                        <input type="text" hidden name="id" value="{{$product['item']['id']}}">
                                                        <button class="remove-btn"><i class="fa fa-times"></i></button>
                                                    </form>
                                                </td>
                                                <td class="li-product-thumbnail"><a href="#"><img  width="100" src="/images/{{$product['item']->images->first()->image}}" alt="Li's Product Image"></a></td>
                                                <td class="li-product-name"><a href="#">{{Illuminate\Support\Str::limit($product['item']['title'],20)}}</a></td>
                                                <td class="li-product-price"><span class="amount">{{$product['item']['price']}} EGP</span></td>
                                                <td class="quantity">
                                                    <label>Qty</label>
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" value="{{$product['qty']}}" type="text">
                                                        <form action="{{route('cart.dec')}}" method="POST">
                                                            @csrf
                                                            <input type="text" hidden name="id" value="{{$product['item']['id']}}">
                                                            <button type="submit" class="dec qtybutton"><i class="fa fa-angle-down"></i></button>
                                                        </form>

                                                        <form action="{{route('cart.inc')}}" method="POST">
                                                            @csrf
                                                            <input type="text" hidden name="id" value="{{$product['item']['id']}}">
                                                            <button type="submit" class="inc qtybutton"><i class="fa fa-angle-up"></i></button>
                                                        </form>
                                                </div>
                                                </td>
                                                <td class="product-subtotal"><span class="amount">{{$product['price']}} EGP</span></td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="coupon-all">

                                            <div class="coupon2">
                                                <input class="button" name="update_cart" value="Update cart" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 ml-auto cart-container-box">
                                        <div class="cart-page-total">
                                            <h2>Total</h2>
                                            <ul>
                                                <li>Subtotal <span>0 EGP</span></li>
                                                <li>Total <span>{{request()->session()->get('cart')->totalPrice}} EGP</span></li>
                                            </ul>
                                            <a href="{{route('checkout.index')}}">Check Out</a>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="cart_empty">
                <div class="row">
                    <div class="col text-center empty-cart">
                        <span>
                            <img src="/assets/user/images/cart.svg" width="400px"/>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center cart-desc">

                        <h3>Your shopping cart is empty</h3>
                        <p>Return to the store to add items for your delivery slot. Before proceed to checkout you must add some products to your shopping cart. You will find a lot of interesting products on our shop page.</p>
                    </div>

                </div>
                <div class="row">
                    <div class="col text-center">
                        <div class="ex_btn d-flex justify-content-center pb-10">
                            <a href="/" class="li-button li-button-dark li-button-fullwidth li-button-sm w-50" >
                                <span>Explore Products</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="cart_empty">
            <div class="row">
                <div class="col text-center empty-cart">
                    <span>
                        <img src="/assets/user/images/cart.svg" width="400px"/>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col text-center cart-desc">

                    <h3>Your shopping cart is empty</h3>
                    <p>Return to the store to add items for your delivery slot. Before proceed to checkout you must add some products to your shopping cart. You will find a lot of interesting products on our shop page.</p>
                </div>

            </div>
            <div class="row">
                <div class="col text-center">
                    <div class="ex_btn d-flex justify-content-center pb-10">
                        <a href="/" class="li-button li-button-dark li-button-fullwidth li-button-sm w-50" >
                            <span>Explore Products</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
