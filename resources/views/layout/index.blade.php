<!DOCTYPE HTML>
<html lang="en">
<script>
    let csrf = "{{ csrf_token() }}";

</script>
@include("inc.heade")
<body class="js">
<!-- Preloader -->
<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- End Preloader -->

<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            <li><i class="ti-headphone-alt"></i> +060 (800) 801-582</li>
                            <li><i class="ti-email"></i> support@shophub.com</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-8 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                            <li><i class="ti-location-pin"></i> Store location</li>
                            <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li>
                          @if(\Illuminate\Support\Facades\Auth::check())
                                <li class="user_list loginUser"><i class="ti-user"></i>{{auth()->user()->name}}</li>
                                <li class="login_list"><i class="ti-power-off"></i><a href="{{route('logout')}}">Odjava</a></li>
                       @endif
                            @if(!\Illuminate\Support\Facades\Auth::check())
                            <li class="user_list"><i class="ti-user"></i> <a href="{{route('register')}}">Registracija</a></li>
                            <li class="login_list"><i class="ti-power-off"></i><a data-toggle="modal" href="#myModal">Login</a></li>
                       @endif
                        </ul>
                    </div>
                    <!-- End Top Right-->
                </div>
            </div>
        </div>
    </div>
@if(\Request::route()->getName()!='register')
    <!--end topbar-->

    <div class="middle-inner">
        <div class="container">
            <div class="row">

                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{route('welcome')}}"><img src="{{asset('images/logo.png')}}" alt="logo"></a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar" id="category_search_bar">
                            <!--ppk -->


                            <!--end ppk-->
                            <form>
                                <input name="search" placeholder="Search Products Here....." type="search">
                                <button class="btnn"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @if(\Illuminate\Support\Facades\Auth::check())
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar shopping">
                            <a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                            <div class="shopping-item">
                                <div class="dropdown-cart-header">
                                    <span>2 Items</span>
                                    <a href="#">Svidjanja</a>
                                </div>
                                <ul class="shopping-list user-likes">
                                   //svidjanja

                                </ul>
                                <div class="bottom">
                                    <div class="total">
                                        <span></span>
                                        <span class="total-amount"></span>
                                    </div>
                                    <a href="http://localhost/elektrikus/public/user?korisnik={{auth()->user()->username}}&category=svidjanja" class="btn animate">Pogledajte sve</a>
                                </div>
                            </div>





                        </div>

                        <div class="sinlge-bar shopping">
                            <a href="#" class="single-icon"><i class="fa fa-envelope-open-o" aria-hidden="true"></i> <span class="total-count">2</span></a>
                            <!-- Shopping Item -->
                            <div class="shopping-item">
                                <div class="dropdown-cart-header">
                                    <span>2 Items</span>
                                    <a href="#">Messenger</a>
                                </div>
                                <ul class="shopping-list user-messanger">

                                    //messanger
                                </ul>
                                <div class="bottom">
                                    <div class="total">
                                        <span></span>
                                        <span class="total-amount"></span>
                                    </div>
                                    <a href="http://localhost/elektrikus/public/user?korisnik={{auth()->user()->username}}&category=poruke" class="btn animate">Pogledajte sve poruke</a>
                                </div>
                            </div>
                            <!--/ End Shopping Item -->
                        </div>
                        <div class="sinlge-bar shopping">
                            <a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count">2</span></a>
                            <!-- Shopping Item -->
                            <div class="shopping-item">
                                <div class="dropdown-cart-header">
                                    <span>2 Items</span>
                                    <a href="#">View Cart</a>
                                </div>
                                <ul class="shopping-list">
                                    <li>
                                        <a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                        <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
                                        <h4><a href="#">Woman Ring</a></h4>
                                        <p class="quantity">1x - <span class="amount">$99.00</span></p>
                                    </li>
                                    <li>
                                        <a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                        <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
                                        <h4><a href="#">Woman Necklace</a></h4>
                                        <p class="quantity">1x - <span class="amount">$35.00</span></p>
                                    </li>
                                </ul>
                                <div class="bottom">
                                    <div class="total">
                                        <span>Total</span>
                                        <span class="total-amount">$134.00</span>
                                    </div>
                                    <a href="checkout.html" class="btn animate">Checkout</a>
                                </div>
                            </div>
                            <!--/ End Shopping Item -->
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">

                    @yield('categories')


                    <div class="col-lg-9 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="active"><a href="#">Home</a></li>
                                            <li><a href="#">Product</a></li>
                                            <li><a href="#">Service</a></li>


                                            <li><a href="#">Blog<i class="ti-angle-down"></i></a>
                                                <ul class="dropdown">
                                                    <li><a href="blog-single-sidebar.html">Blog Single Sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contact.html">Contact Us</a></li>
                                         @if(\Illuminate\Support\Facades\Auth::check())
                                            <li><a href="#">Korisničke stranice<i class="ti-angle-down"></i><span class="new">New</span></a>
                                                <ul class="dropdown">
                                                    <li><a href="http://localhost/elektrikus/public/user?korisnik={{auth()->user()->username}}&category=moji_podaci">Korisnički podaci</a></li>
                                                    <li><a href="http://localhost/elektrikus/public/user?korisnik={{auth()->user()->username}}&category=moji_oglasi">Moji oglasi</a></li>
                                                    <li><a href="http://localhost/elektrikus/public/user?korisnik={{auth()->user()->username}}&category=pratim">Pratim</a></li>
                                                    <li><a href="http://localhost/elektrikus/public/user?korisnik={{auth()->user()->username}}&category=poruke">Poruke</a></li>
                                                </ul>
                                            </li>
                                             @endif
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->


    @endif


</header>



<!-- Modal HTML -->





@yield('content')
@include('inc.chat')
@if(\Request::route()->getName()!='register')
@include('inc.subscrbie')
<button type="button" style="visibility: hidden;" id="alertButtonModal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
</button>



@endif


@include("inc.footer")




<!-- Jquery -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-migrate-3.0.0.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/chat.js')}}"></script>

<script>

    $(document).on('click','.modal-header1 .myClose',function (e) {
        e.preventDefault();
       // alert('aa');
         $(".modal-backdrop").remove();

    });

</script>

<!-- Popper JS -->
<script src="{{asset('js/popper.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- Color JS
<script src="{{asset('js/colors.js')}}"></script> -->
<!-- Slicknav JS -->
<script src="{{asset('js/slicknav.min.js')}}"></script>
<!-- Owl Carousel JS -->
<script src="{{asset('js/owl-carousel.js')}}"></script>
<!-- Magnific Popup JS -->
<script src="{{asset('js/magnific-popup.js')}}"></script>
<!-- Waypoints JS -->
<script src="{{asset('js/waypoints.min.js')}}"></script>
<!-- Countdown JS -->
<script src="{{asset('js/finalcountdown.min.js')}}"></script>
<!-- Nice Select JS -->
<script src="{{asset('js/nicesellect.js')}}"></script>
<!-- Flex Slider JS -->
<script src="{{asset('js/flex-slider.js')}}"></script>
<!-- ScrollUp JS -->
<script src="{{asset('js/scrollup.js')}}"></script>
<!-- Onepage Nav JS -->
<script src="{{asset('js/onepage-nav.min.js')}}"></script>
<!-- Easing JS -->
<script src="{{asset('js/easing.js')}}"></script>
<!-- Active JS -->
<script src="{{asset('js/active.js')}}"></script>
<!-- My JS -->
<script src="{{asset('js/index.js')}}"></script>
</body>



</html>