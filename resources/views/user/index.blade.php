@extends('user.layouts.app')
@section('content')
            <!-- Begin Slider With Category Menu Area -->
            <div class="slider-with-banner">
                <div class="container">
                    <div class="row">
                        <!-- Begin Category Menu Area -->
                        <div class="col-lg-3">
                            <!--Category Menu Start-->
                            <div class="category-menu category-menu-2">
                                <div class="category-heading">
                                    <h2 class="categories-toggle"><span>categories</span></h2>
                                </div>
                                <div id="cate-toggle" class="category-menu-list">
                                    <ul>
                                        @foreach ( $categories as $category)
                                        @if (count($category->subcategories)>0)
                                            <li class="right-menu"><a href="#">{{$category->title}}</a>
                                                <ul class="cat-mega-menu">
                                                    @foreach ( $category->subcategories as $subcategory)
                                                    @if (count($subcategory->products) > 0)
                                                    <li class="right-menu cat-mega-title">
                                                        <a href="{{route('category.show_sub',['category' => $category->id, 'subcategory' => $subcategory->id])}}">{{$subcategory->title}}</a>
                                                        <ul>
                                                            @foreach ( $subcategory->products as $product)
                                                                <li><a href="{{route('product.show',$product->id)}}">{{Illuminate\Support\Str::limit($product->title,20)}}</a></li>
                                                            @endforeach

                                                        </ul>

                                                    </li>
                                                    @endif

                                                    @endforeach


                                                </ul>
                                            </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!--Category Menu End-->
                        </div>
                        <!-- Category Menu Area End Here -->
                        <!-- Begin Slider Area -->
                        <div class="col-lg-6 col-md-8">
                            <div class="slider-area slider-area-3 pt-sm-30 pt-xs-30 pb-xs-30">
                                <div class="slider-active owl-carousel">
                                    <!-- Begin Single Slide Area -->
                                    <div class="single-slide align-center-left animation-style-01 bg-7">
                                        <div class="slider-progress"></div>
                                        <div class="slider-content">
                                            <h5>Sale Offer <span>-20% Off</span> This Week</h5>
                                            <h2>Chamcham Galaxy S9 | S9+</h2>
                                            <h3>Starting at <span>$589.00</span></h3>
                                            <div class="default-btn slide-btn">
                                                <a class="links" href="#">Shopping Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Slide Area End Here -->
                                    <!-- Begin Single Slide Area -->
                                    <div class="single-slide align-center-left animation-style-02 bg-8">
                                        <div class="slider-progress"></div>
                                        <div class="slider-content">
                                            <h5>Sale Offer <span>Black Friday</span> This Week</h5>
                                            <h2>Work Desk Surface Studio 2018</h2>
                                            <h3>Starting at <span>$1599.00</span></h3>
                                            <div class="default-btn slide-btn">
                                                <a class="links" href="#">Shopping Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Slide Area End Here -->
                                    <!-- Begin Single Slide Area -->
                                    <div class="single-slide align-center-left animation-style-01 bg-9">
                                        <div class="slider-progress"></div>
                                        <div class="slider-content">
                                            <h5>Sale Offer <span>-10% Off</span> This Week</h5>
                                            <h2>Phantom 4 Pro+ Obsidian</h2>
                                            <h3>Starting at <span>$809.00</span></h3>
                                            <div class="default-btn slide-btn">
                                                <a class="links" href="#">Shopping Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Slide Area End Here -->
                                </div>
                            </div>
                        </div>
                        <!-- Slider Area End Here -->
                        <!-- Begin Li Banner Area -->
                        <div class="col-lg-3 col-md-4 text-center pt-sm-30">
                            <div class="li-banner">
                                <a href="#">
                                    <img src="/assets/user/images/banner/3_1.jpg" alt="">
                                </a>
                            </div>
                            <div class="li-banner mt-15 mt-sm-30 mt-xs-25 mb-xs-5">
                                <a href="#">
                                    <img src="/assets/user/images/banner/3_2.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- Li Banner Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Slider With Category Menu Area End Here -->
            <!-- Begin Li's Static Banner Area -->
            <div class="li-static-banner pt-20 pt-sm-30">
                <div class="container">
                    <div class="row">
                        <!-- Begin Single Banner Area -->
                        <div class="col-lg-4 col-md-4 text-center">
                            <div class="single-banner pb-xs-30">
                                <a href="#">
                                    <img src="/assets/user/images/banner/1_3.jpg" alt="Li's Static Banner">
                                </a>
                            </div>
                        </div>
                        <!-- Single Banner Area End Here -->
                        <!-- Begin Single Banner Area -->
                        <div class="col-lg-4 col-md-4 text-center">
                            <div class="single-banner pb-xs-30">
                                <a href="#">
                                    <img src="/assets/user/images/banner/1_4.jpg" alt="Li's Static Banner">
                                </a>
                            </div>
                        </div>
                        <!-- Single Banner Area End Here -->
                        <!-- Begin Single Banner Area -->
                        <div class="col-lg-4 col-md-4 text-center">
                            <div class="single-banner">
                                <a href="#">
                                    <img src="/assets/user/images/banner/1_5.jpg" alt="Li's Static Banner">
                                </a>
                            </div>
                        </div>
                        <!-- Single Banner Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Li's Static Banner Area End Here -->
            @foreach ( $categories as $category)
            @if (count($category->products)>0)
            <section class="product-area li-laptop-product pt-60 pb-45">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Section Area -->
                        <div class="col-lg-12">
                            <div class="li-section-title">
                                <h2>
                                    <span>{{$category->title}}</span>
                                </h2>
                                <ul class="li-sub-category-list">
                                    @foreach ( $category->subcategories as $subcategory)
                                        <li class="active"><a href="{{route('category.show_sub',['category' => $category->id, 'subcategory' => $subcategory->id])}}">{{$subcategory->title}}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="row">
                                <div class="product-active owl-carousel">
                                    @foreach ($category->products as $product)
                                        <div class="col-lg-12">
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
{{--                                                                <a href="#">{{$product->seller->shop->name}}</a>--}}
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
                        <!-- Li's Section Area End Here -->
                    </div>
                </div>
            </section>
            @endif


            @endforeach






















@endsection
