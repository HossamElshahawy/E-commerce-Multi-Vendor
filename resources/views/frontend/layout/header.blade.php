    <!-- Top Header Area -->
    <div class="top-header-area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-6">
                    <div class="welcome-note">
                            <span class="popover--text" data-toggle="popover"
                                  data-content="Welcome to Bigshop ecommerce template."><i
                                    class="icofont-info-square"></i></span>
                        <span class="text">Welcome to H Store ecommerce template.</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="language-currency-dropdown d-flex align-items-center justify-content-end">
                        <!-- Language Dropdown -->
                        <div class="language-dropdown">
                            <div class="dropdown">
                                <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenu1"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    English
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="#">Bangla</a>
                                    <a class="dropdown-item" href="#">Arabic</a>
                                </div>
                            </div>
                        </div>

                        <!-- Currency Dropdown -->
                        <div class="currency-dropdown">
                            <div class="dropdown">
                                <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenu2"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    $ USD
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                    <a class="dropdown-item" href="#">৳ BDT</a>
                                    <a class="dropdown-item" href="#">€ Euro</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Menu -->
    <div class="bigshop-main-menu">
        <div class="container">
            <div class="classy-nav-container breakpoint-off">
                <nav class="classy-navbar" id="bigshopNav">

                    <!-- Nav Brand -->
                    <a href="{{route('home.frontend')}}" class="nav-brand"><img src="{{asset('frontend\img\core-img\logo.png')}}" alt="logo"></a>

                    <!-- Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- Close -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav -->
                        <div class="classynav">
                            <ul>
                                <li><a href="{{route('home.frontend')}}">Home</a></li>
                                <li><a href="#">Shop</a></li>

                                <li><a href="#">Blog</a>
                                    <ul class="dropdown">
                                        <li><a href="blog-with-left-sidebar.html">Blog Left Sidebar</a></li>
                                        <li><a href="blog-with-right-sidebar.html">Blog Right Sidebar</a></li>
                                        <li><a href="blog-with-no-sidebar.html">Blog No Sidebar</a></li>
                                        <li><a href="single-blog.html">Single Blog</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Elements</a>
                                    <div class="megamenu">
                                        <ul class="single-mega cn-col-4">
                                            <li><a href="accordian.html">- Accordions</a></li>
                                            <li><a href="alerts.html">- Alerts</a></li>
                                            <li><a href="badges.html">- Badges</a></li>
                                            <li><a href="blockquotes.html">- Blockquotes</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li><a href="breadcrumb.html">- Breadcrumbs</a></li>
                                            <li><a href="buttons.html">- Buttons</a></li>
                                            <li><a href="forms.html">- Forms</a></li>
                                            <li><a href="gallery.html">- Gallery</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li><a href="heading.html">- Headings</a></li>
                                            <li><a href="icon-fontawesome.html">- Icon FontAwesome</a></li>
                                            <li><a href="icon-icofont.html">- Icon Ico Font</a></li>
                                            <li><a href="labels.html">- Labels</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li><a href="modals.html">- Modals</a></li>
                                            <li><a href="pagination.html">- Pagination</a></li>
                                            <li><a href="progress-bars.html">- Progress Bars</a></li>
                                            <li><a href="tables.html">- Tables</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Hero Meta -->
                    <div class="hero_meta_area ml-auto d-flex align-items-center justify-content-end">
                        <!-- Search -->
                        <div class="search-area">
                            <div class="search-btn"><i class="icofont-search"></i></div>
                            <!-- Form -->
                            <div class="search-form">
                                <input type="search" class="form-control" placeholder="Search">
                                <input type="submit" class="d-none" value="Send">
                            </div>
                        </div>

                        <!-- Wishlist -->
                        <div class="wishlist-area">
                            <a href="wishlist.html" class="wishlist-btn"><i class="icofont-heart"></i></a>
                        </div>

                        <!-- Cart -->
                        <div class="cart-area">
                            <div class="cart--btn"><i class="icofont-cart"></i> <span class="cart_quantity">{{\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count()}}</span>
                            </div>

                            <!-- Cart Dropdown Content -->
                            <div class="cart-dropdown-content">
                                <ul class="cart-list">

                                    @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)

                                    <li>
                                        <div class="cart-item-desc">
                                            <a href="#" class="image">
                                                <img src="{{$item->model->photo}}" class="cart-thumb" alt="">
                                            </a>
                                            <div>
                                                <a href="{{route('product.details',$item->model->slug)}}">{{$item->name}}</a>
                                                <p> {{$item->qty}} x - <span class="price">{{number_format($item->price,2)}}</span></p>
                                            </div>
                                        </div>
                                        <span class="dropdown-product-remove cart_delete" data-id="{{$item->rowId}}"><i class="icofont-bin"></i></span>
                                    </li>
                                    @endforeach


                                </ul>
                                <div class="cart-pricing my-4">
                                    <ul>
                                        <li>
                                            <span>Sub Total:</span>
                                            <span>{{\Gloudemans\Shoppingcart\Facades\Cart::subTotal()}}</span>
                                        </li>

                                        <li>
                                            <span>Total:</span>
                                            <span>{{\Gloudemans\Shoppingcart\Facades\Cart::Total()}}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="cart-box">
                                    <a href="{{route('cart')}}" class="btn btn-success btn-sm">Cart</a>
                                    <a href="checkout-1.html" class="btn btn-primary btn-sm float-right">Checkout</a>

                                </div>
                            </div>
                        </div>

                        <!-- Account -->
                        <div class="account-area">
                            <div class="user-thumbnail">
{{--                                @if(auth()->user()->photo)--}}
{{--                                    <img src="{{auth()->user()->photo}}" alt="">--}}
{{--                                @else--}}
{{--                                    <img src="{{\App\Utilities\Helpers::userDefaultImage()}}" alt="">--}}
{{--                                @endif--}}

                            </div>
                            <ul class="user-meta-dropdown">
                                @auth
                                <li class="user-title"><span>Hello,</span> {{auth()->user()->username}}</li>
                                <li><a href="{{route('user.dashboard')}}">My Account</a></li>
                                <li><a href="{{route('user.order')}}">Orders List</a></li>
                                <li><a href="wishlist.html">Wishlist</a></li>
                                <li><a href="{{route('user.logout')}}"><i class="icofont-logout"></i> Logout</a></li>
                                @else
                                    <li><a href="{{route('user.auth')}}">Login & Register</a></li>

                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
