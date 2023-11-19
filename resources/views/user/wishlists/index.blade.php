@extends('user.layouts.app')
@section('content')
<div class="wishlist-area pt-60 pb-60">
    <div class="container">
        @if (count($wishlist)>0)
        <div class="row">
            <div class="col-12">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="li-product-remove">remove</th>
                                    <th class="li-product-thumbnail">images</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="li-product-price">Unit Price</th>
                                    <th class="li-product-stock-status">Stock Status</th>
                                    <th class="li-product-add-cart">add to cart</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlist as $item)
                                <tr>
                                    <td class="li-product-remove">
                                        <form action="{{route('wishlist.destroy',$item->product->id)}}" method="POST" id="{{$item->product->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="text" hidden name="id" value="{{$item->product->id}}">

                                            <button class="remove-btn"><i class="fa fa-times"></i></button>
                                        </form>
                                    </td>
                                    <td class="li-product-thumbnail"><a href="#"><img  width="50" src="/images/{{$item->product->images->first()->image}}" alt=""></a></td>
                                    <td class="li-product-name"><a href="#">{{$item->product->title}}</a></td>
                                    <td class="li-product-price"><span class="amount">{{$item->product->price}} EGP</span></td>
                                    <td class="li-product-stock-status"><span class=" {{($item->product->stock > 0)?'in-stock':'out-stock' }}">{{($item->product->stock > 0)?'In Stock':'Out of stock' }}</span></td>
                                    <td class="li-product-add-cart"><a href="#">add to cart</a></td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
