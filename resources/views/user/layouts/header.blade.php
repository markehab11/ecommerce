<div class="header-top">
    <div class="container">
        <div class="row">
            <!-- Begin Header Top Left Area -->
            <div class="col-lg-3 col-md-4">
                <div class="header-top-left">
                    <ul class="phone-wrap">
                        <li><span>Telephone Enquiry:</span><a href="#">(+123) 123 321 345</a></li>
                    </ul>
                </div>
            </div>
            <!-- Header Top Left Area End Here -->
            <!-- Begin Header Top Right Area -->
            <div class="col-lg-9 col-md-8">
                <div class="header-top-right">
                    <ul class="ht-menu">
                        <!-- Begin Setting Area -->
                        @auth
                        <li>
                            <div class="ht-setting-trigger"><span>{{auth()->user()->name}}</span></div>
                            <div class="setting ht-setting">
                                <ul class="ht-setting-list">
                                    <li><a href="{{route('profile.edit')}}">My Account</a></li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <li><button>Logout</button></li>
                                    </form>
                                </ul>
                            </div>
                        </li>
                        @endauth

                        <!-- Setting Area End Here -->
                        <!-- Begin Currency Area -->
                        @guest
                        <li>
                            <a href="{{route('login')}}"><span class="currency-selector-wrapper">Login</span></a>

                        </li>
                        <!-- Currency Area End Here -->
                        <!-- Begin Language Area -->
                        <li>
                            <a href="{{route('register')}}"> <span class="language-selector-wrapper">Register</span></a>

                        </li>
                        @endguest

                        <!-- Language Area End Here -->
                    </ul>
                </div>
            </div>
            <!-- Header Top Right Area End Here -->
        </div>
    </div>
</div>
<!-- Header Top Area End Here -->
<!-- Begin Header Middle Area -->
<div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
    <div class="container">
        <div class="row">
            <!-- Begin Header Logo Area -->
            <div class="col-lg-3">
                <div class="logo pb-sm-30 pb-xs-30">
                    <a href="/">
                        <img src="/assets/user/images/menu/logo/1.jpg" alt="">
                    </a>
                </div>
            </div>
            <!-- Header Logo Area End Here -->
            <!-- Begin Header Middle Right Area -->
            <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                <!-- Begin Header Middle Searchbox Area -->
                <form action="{{route('search.index')}}" method="GET" class="hm-searchbox">
                    <select class="nice-select select-search-category" name="cat_id">
                        <option value="0">All</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach

                    </select>
                    <input type="text" name="q" placeholder="Enter your search key ...">
                    <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                </form>
                <!-- Header Middle Searchbox Area End Here -->
                <!-- Begin Header Middle Right Area -->
                <div class="header-middle-right">
                    <ul class="hm-menu">
                        <!-- Begin Header Middle Wishlist Area -->
                        @auth
                        <li class="hm-wishlist">
                            <a href="{{route('wishlist.index')}}">
                                <span class="cart-item-count wishlist-item-count">{{auth()->user()->wishlist->count()}}</span>
                                <i class="fa fa-heart-o"></i>
                            </a>
                        </li>
                        @endauth

                        <!-- Header Middle Wishlist Area End Here -->
                        <!-- Begin Header Mini Cart Area -->
                        <li class="hm-minicart">
                            <div class="hm-minicart-trigger">
                                <span class="item-icon"></span>
                                <span class="item-text">{{Session::has('cart')?Session::get('cart')->totalPrice:'0'}} EGP
                                    <span class="cart-item-count">{{Session::has('cart')?Session::get('cart')->totalQty:''}}</span>
                                </span>
                            </div>
                            <span></span>
                            <div class="minicart">
                                <ul class="minicart-product-list">
                                    @if(Session::get('cart'))

                                    @foreach (Session::get('cart')->items as $product)
                                        <li>
                                            <a href="{{route("product.show",$product['item']->id)}}" class="minicart-product-image">
                                                <img src="/images/{{$product['item']->images->first()->image}}" height="50" alt="cart products">
                                            </a>
                                            <div class="minicart-product-details">
                                                <h6><a href="{{route("product.show",$product['item']->id)}}">{{Illuminate\Support\Str::limit($product['item']['name'],20)}}</a></h6>
                                                <span>{{$product['item']['price']-(($product['item']['price']*intval($product['item']['discount']) )/100)}} x {{$product['qty']}}</span>
                                            </div>
                                            <form action="{{route('cart.remove')}}" method="POST">
                                                @csrf
                                                <input type="text" hidden name="id" value="{{$product['item']->id}}">
                                                <button class="close">
                                                    <i class="fa fa-close"></i>
                                                </button>
                                            </form>

                                        </li>
                                    @endforeach

                                    @endif
                                </ul>
                                <p class="minicart-total">TOTAL: <span>{{Session::has('cart')?Session::get('cart')->totalPrice:'0'}} EGP</span></p>
                                <div class="minicart-button">
                                    <a href="{{route('cart.get')}}" class="li-button li-button-fullwidth li-button-dark">
                                        <span>View Full Cart</span>
                                    </a>
                                    <a href="{{route('checkout.index')}}" class="li-button li-button-fullwidth">
                                        <span>Checkout</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!-- Header Mini Cart Area End Here -->
                    </ul>
                </div>
                <!-- Header Middle Right Area End Here -->
            </div>
            <!-- Header Middle Right Area End Here -->
        </div>
    </div>
</div>
<!-- Header Middle Area End Here -->
<!-- Begin Header Bottom Area -->
<div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Begin Header Bottom Menu Area -->
                <div class="hb-menu">
                    <nav>
                        <ul>
                            {{-- <li><a href="about-us.html">Home</a></li>
                            </li> --}}

                            <li class="dropdown-holder dropdowen-icon"><a >All Categories</a>
                                <ul class="hb-dropdown">
                                    @foreach ( $categories as $category)
                                    <li class="sub-dropdown-holder"><a href="{{route('category.show',$category->id)}}">{{$category->title}}</a>
                                        <ul class="hb-dropdown hb-sub-dropdown">
                                            @foreach ($category->subcategories as $subcategory)
                                                <li><a href="{{route('category.show_sub',['category' => $category->id, 'subcategory' => $subcategory->id])}}">{{$subcategory->title}}</a></li>
                                            @endforeach

                                        </ul>
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                            @foreach ( $categories as $category)
                                <li class="megamenu-holder"><a href="{{route('category.show',$category->id)}}">{{$category->title}}</a>
                                    <ul class="megamenu hb-megamenu">
                                        <li><a href="{{route('category.show',$category->id)}}">{{$category->title}}</a>
                                            <ul>
                                                @foreach ($category->subcategories as $subcategory)
                                                    <li><a href="{{route('category.show_sub',['category' => $category->id, 'subcategory' => $subcategory->id])}}">{{$subcategory->title}}</a></li>
                                                @endforeach

                                            </ul>
                                        </li>

                                    </ul>
                                </li>
                            @endforeach
                            <li><a href="about-us.html">Deals</a></li>


                        </ul>
                    </nav>
                </div>
                <!-- Header Bottom Menu Area End Here -->
            </div>
        </div>
    </div>
</div>
<!-- Header Bottom Area End Here -->
<!-- Begin Mobile Menu Area -->
<div class="mobile-menu-area d-lg-none d-xl-none col-12">
    <div class="container">
        <div class="row">
            <div class="mobile-menu">
            </div>
        </div>
    </div>
</div>
