@extends('user.layouts.app')
@section('content')
<div class="content-wraper pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Begin Li's Banner Area -->
                <div class="single-banner shop-page-banner">
                    <a href="#">
                        <img src="/assets/user/images/bg-banner/2.jpg" alt="Li's Static Banner">
                    </a>
                </div>
                <!-- Li's Banner Area End Here -->
                <!-- shop-top-bar start -->
                <div class="shop-top-bar mt-30">
                    <div class="shop-bar-inner">
                        <div class="product-view-mode">
                            <!-- shop-item-filter-list start -->
                            <ul class="nav shop-item-filter-list" role="tablist">
                                <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th-list"></i></a></li>
                            </ul>
                            <!-- shop-item-filter-list end -->
                        </div>
                        <div class="toolbar-amount">
                            <span>Showing {{ $single_cat->firstItem() }} to {{ $single_cat->lastItem() }}
                                of  {{$single_cat->total()}}</span>
                        </div>
                    </div>
                    <!-- product-select-box start -->
                    <div class="product-select-box">
                        <div class="product-short">
                            <p>Sort by :</p>

                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle sort-box" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                @if (isset($_GET['sort']))
                                        @if ($_GET['sort'] == 'name_asc')
                                            Name (A - Z)
                                        @elseif ($_GET['sort'] == 'name_desc')
                                        Name (Z - A)
                                        @elseif ($_GET['sort'] == 'price_asc')
                                        Price (Low &gt; High)
                                        @elseif ($_GET['sort'] == 'price_desc')
                                        Price (High &gt; Low)
                                        @else
                                        Relevance
                                        @endif
                                @else
                                Relevance
                                @endif

                                </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{URL::current()}}">Relevance</a>
                                <a class="dropdown-item" href="{{URL::current().'?sort=name_asc' }}">Name (A - Z)</a>
                                <a class="dropdown-item" href="{{URL::current().'?sort=name_desc' }}">Name (Z - A)</a>
                                <a class="dropdown-item" href="{{URL::current().'?sort=price_asc' }}">Price (Low &gt; High)</a>
                                <a class="dropdown-item" href="{{URL::current().'?sort=price_desc' }}">Price (High &gt; Low)</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- product-select-box end -->
                </div>
                <!-- shop-top-bar end -->
                <!-- shop-products-wrapper start -->
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="product-area shop-product-area">
                                <div class="row">
                                    @foreach ($single_cat as $product)

                                    <div class="col-lg-3 col-md-4 col-sm-6 mt-40">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{route('product.show',$product->id)}}">
                                                    <img src="/images/{{$product->images->first()->image}}" alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="product-details.html">{{$product->seller->shop->name}}</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="{{route('product.show',$product->id)}}">{{$product->title}}</a></h4>
                                                    <?php
                                                    $oldval = intval($product->price);
                                                    $pernc  = intval($product->discount)/100;
                                                    $res = $oldval-($oldval*$pernc);
                                                ?>

                                                @if ($product->discount)
                                                    <div class="price-box">
                                                        <span class="new-price new-price-2"><sup>EGP</sup>{{$res}}</span>
                                                        <span class="old-price">{{$oldval}} EGP</span>
                                                        <span class="discount-percentage">-{{intval($product->discount)}}%</span>
                                                    </div>
                                                    @else
                                                    <div class="price-box">
                                                        <span class="new-price">{{$product->price}} EGP</span>
                                                    </div>
                                                @endif
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active">
                                                            <form action="{{route('cart.add')}}" method="POST">
                                                                @csrf
                                                                <input type="text" hidden name="qty" value="1">
                                                                <input type="text" hidden name="id" value="{{$product->id}}">
                                                                <button>Add to cart</button>
                                                            </form>

                                                        </li>

                                                        @auth
                                                        <li>
                                                            @if (auth()->user()->check_wishlist($product->id))
                                                                <form action="{{route('wishlist.destroy',$product->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="text" hidden name="id" value="{{$product->id}}">
                                                                        <button class="links-details" href="single-product.html"><i class="fa fa-heart"></i></button>

                                                                </form>
                                                            @else
                                                                <form action="{{route('wishlist.store')}}" method="POST">
                                                                    @csrf
                                                                    <input type="text" hidden name="id" value="{{$product->id}}">
                                                                        <button class="links-details" href="single-product.html"><i class="fa fa-heart-o"></i></button>

                                                                </form>
                                                            @endif
                                                        </li>
                                                        @endauth

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div id="list-view" class="tab-pane product-list-view fade" role="tabpanel">
                            <div class="row">
                                <div class="col">
                                    @foreach ($single_cat as $product)

                                    <div class="row product-layout-list">
                                        <div class="col-lg-3 col-md-5 ">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="/images/{{$product->images->first()->image}}" alt="Li's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-7">
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="product-details.html">{{$product->seller->shop->name}}</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="single-product.html">{{$product->title}}</a></h4>
                                                    <?php
                                                    $oldval = intval($product->price);
                                                    $pernc  = intval($product->discount)/100;
                                                    $res = $oldval-($oldval*$pernc);
                                                ?>

                                                @if ($product->discount)
                                                    <div class="price-box">
                                                        <span class="new-price new-price-2"><sup>EGP</sup>{{$res}}</span>
                                                        <span class="old-price">{{$oldval}} EGP</span>
                                                        <span class="discount-percentage">-{{intval($product->discount)}}%</span>
                                                    </div>
                                                    @else
                                                    <div class="price-box">
                                                        <span class="new-price">{{$product->price}} EGP</span>
                                                    </div>
                                                @endif
                                                    <p>{{$product->desc}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="shop-add-action mb-xs-30">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active">
                                                        <form action="{{route('cart.add')}}" method="POST">
                                                            @csrf
                                                            <input type="text" hidden name="id" value="{{$product->id}}">
                                                            <button>Add to cart</button>

                                                        </form>

                                                    </li>
                                                    <li class="wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a></li>
                                                    <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i>Quick view</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="paginatoin-area">
                            <div class="row">
                                <div class="col show_pages">

                                    <p>Showing {{ $single_cat->firstItem() }} to {{ $single_cat->lastItem() }}
                                        of  {{$single_cat->total()}} </p>
                                </div>
                                <div class="col">

                                    {{$single_cat->links('pagination::bootstrap-4')}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shop-products-wrapper end -->
            </div>
        </div>
    </div>
</div>




@endsection
