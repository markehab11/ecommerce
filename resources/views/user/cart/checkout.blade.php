@extends('user.layouts.app')
@section('content')

@if (Session::has('cart'))
    @if(count($products)>0)
        <div class="checkout-area pt-60 pb-30">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <form action="{{route('checkout.update')}}" method="POST">
                            <div class="checkbox-form">
                                <h3>Billing detailss</h3>


                                <div class="row">

                                        @csrf
                                        @method('PUT')
                                        {{-- <div class="col-md-12">
                                            <div class="country-select clearfix">
                                                <label>Country <span class="required">*</span></label>
                                                <select class="nice-select wide">
                                                <option data-display="Bangladesh">Bangladesh</option>
                                                <option value="uk">London</option>
                                                <option value="rou">Romania</option>
                                                <option value="fr">French</option>
                                                <option value="de">Germany</option>
                                                <option value="aus">Australia</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>First Name <span class="required">*</span></label>
                                                <input placeholder="" type="text" value="{{auth()->user()->name}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Last Name <span class="required">*</span></label>
                                                <input placeholder="" type="text" value="{{auth()->user()->last_name}}" name='last_name' required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Address <span class="required">*</span></label>
                                                <input name='street' placeholder="Street address" type="text" value="{{auth()->user()->details ? auth()->user()->details->street : ''}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Apartment <span class="required">*</span></label>
                                                <input name='apartment' placeholder="Apartment, suite, unit etc. (optional)" type="text" value="{{auth()->user()->details ? auth()->user()->details->apartment : ''}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Town / City <span class="required">*</span></label>
                                                <input name='city' type="text" value="{{auth()->user()->details ? auth()->user()->details->city : ''}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>State / Country </label>
                                                <input name='state' placeholder="" type="text" value="Egypt" required disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Postcode / Zip <span class="required">*</span></label>
                                                <input name='postcode' placeholder="" type="text" value="{{auth()->user()->details ? auth()->user()->details->postal_code : ''}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Email Address <span class="required">*</span></label>
                                                <input  placeholder="" type="email" value="{{auth()->user()->email}}" required disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Phone  <span class="required">*</span></label>
                                                <input name='phone_number' type="text" value="{{auth()->user()->phone_number}}" required dis>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <button type="submit" class="form-control">Update</button>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name">Product</th>
                                            <th class="cart-product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)

                                        <tr class="cart_item">
                                            <td class="cart-product-name">{{Illuminate\Support\Str::limit($product['item']->title,20)}} <strong class="product-quantity"> ×   {{$product['qty']}}</strong></td>
                                            <td class="cart-product-total"><span class="amount">{{$product['price']}} EGP</span></td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">0</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount">{{$totalPrice}} EGP</span></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                      <div class="card">
                                        <div class="card-header" id="#payment-1">
                                          <h5 class="panel-title">
                                            <a class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                              Direct Bank Transfer.
                                            </a>
                                          </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                          <div class="card-body">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="card">
                                        <div class="card-header" id="#payment-2">
                                          <h5 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                              Cheque Payment
                                            </a>
                                          </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                          <div class="card-body">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="card">
                                        <div class="card-header" id="#payment-3">
                                          <h5 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                              PayPal
                                            </a>
                                          </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                                          <div class="card-body">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="order-button-payment">
                                        <form method="POST" action="{{route('order.store')}}">
                                            @csrf
                                            <input value="Place order" type="submit">
                                        </form>

                                    </div>
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

@endsection
