@extends('layout.index')

@section('categories')


    <div class="col-lg-3">
        <div class="all-category">
            <h3 class="cat-heading"  onmouseover="show('main_category_mouse')"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
            <ul class="main-category" id="main_category_mouse" onmouseleave="hide_something('main_category_mouse')">

            @if(isset($categories))

                @for($i=0;$i<count($categories);$i++)
                        <li class="main-mega"><a href="#">{{$categories[$i]->name_category}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>

                            <ul class="mega-menu">
                                @for($s=0;$s<count($subcategories);$s++)
                                    @if($subcategories[$s]->category_id==$categories[$i]->id_category)
                                <li class="single-menu">
                                    <a href="#" class="title-link">{{$subcategories[$s]->subcategory_name}}</a>


                                        <div class="inner-link">
                                            @for($p=0;$p<count($ppk);$p++)
                                                @if($ppk[$p]->subcategory_id==$subcategories[$s]->id_subcategory)


                                        <a href="http://localhost/elektrikus/public/shop?{{$subcategories[$s]->subcategory_name}}&category={{$ppk[$p]->name_ppk}}">{{$ppk[$p]->name_ppk}}</a>


                                                @endif
                                            @endfor
                                    </div>


                                </li>

                                        @endif
                                    @endfor

                            </ul>
                        </li>


                @endfor
              @endif


    </ul>
        </div>
        </div>

@endsection



@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @include("inc.slider")

    @include("inc.smallBanner")
    <!-- Start Product Area -->
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Trending Item</h2>
                    </div>
                </div>
            </div>
            <div class="row">



                <div class="col-12">
                    <div class="product-info">
                        <div class="nav-main">
                            <!-- Tab Nav -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item trending_cat"><a class="nav-link active" data-toggle="tab" href="#man" role="tab">Man</a></li>
                                <li class="nav-item trending_cat"><a class="nav-link" data-toggle="tab" href="#woman_first" role="tab">Woman</a></li>
                                <li class="nav-item trending_cat"><a class="nav-link" data-toggle="tab" href="#kids_first" role="tab">Kids</a></li>
                                <li class="nav-item trending_cat"><a class="nav-link" data-toggle="tab" href="#accessories_first" role="tab">Accessories</a></li>
                                <li class="nav-item trending_cat"><a class="nav-link" data-toggle="tab" href="#essential_first" role="tab">Essential</a></li>
                                <li class="nav-item trending_cat"><a class="nav-link" data-toggle="tab" href="#prices_first" role="tab">Prices</a></li>
                            </ul>
                            <!--/ End Tab Nav -->
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <!-- Start Single Tab -->
                            <div class="tab-pane fade show active" id="man" role="tabpanel">
                                <div class="tab-single">
                                    <div class="row" id="trending_change">

                                        <!-- one productArea foreach -->
                                        @if(isset($trendingProducts))
                                            @foreach($trendingProducts as $tr)

                                                @trending(["product"=>$tr])@endtrending


                                            @endforeach
                                            @endif



                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
    <!-- End Product Area -->



    {{-- @include("inc.midiumBanner") --}}



    <!-- Start Shop Home List  -->
    <section class="shop-home-list section">
        <div class="container">
            <div class="row">
                <div class="small_advert">

                    <div class="row">
                        <div class="col-12">
                            <div class="shop-section-title">
                                <h1>On sale</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Start Single List  -->

                    @if(isset($advert1))
                        @foreach($advert1 as $adv)

                            @advert(['advert'=>$adv])@endadvert

                        @endforeach
                    @endif

                  {{--  @include('inc.shopHomeList') --}}


                </div>
                <div class="middle_advert" style="width: 57%!important;">
                    <div class="col-12">
                        <div class="product-info">
                            <div class="nav-main">
                                <!-- Tab Nav -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item new_cat"><a class="nav-link active" data-toggle="tab" href="#man" role="tab">Man</a></li>
                                    <li class="nav-item new_cat"><a class="nav-link" data-toggle="tab" href="#woman_second" role="tab">Woman</a></li>
                                    <li class="nav-item new_cat"><a class="nav-link" data-toggle="tab" href="#kids_second" role="tab">Kids</a></li>
                                    <li class="nav-item new_cat"><a class="nav-link" data-toggle="tab" href="#accessories_second" role="tab">Accessories</a></li>
                                    <li class="nav-item new_cat"><a class="nav-link" data-toggle="tab" href="#essential_second" role="tab">Essential</a></li>
                                    <li class="nav-item new_cat"><a class="nav-link" data-toggle="tab" href="#prices_second" role="tab">Prices</a></li>
                                </ul>
                                <!--/ End Tab Nav -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-single">
                        <div class="row" id="trending_change_second">


                            @if(isset($trendingProducts))
                                @foreach($trendingProducts as $tr)

                                    @trending(["product"=>$tr])@endtrending


                                @endforeach
                            @endif




                        </div>
                    </div>


                </div>
                <div class=" small_advert">

                    <div class="row">
                        <div class="col-12">
                            <div class="shop-section-title">
                                <h1>Top viewed</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Start Single List  -->

                    @if(isset($advert2))
                        @foreach($advert2 as $adv)

                            @advert(['advert'=>$adv])@endadvert

                        @endforeach
                    @endif

                   {{-- @include('inc.shopHomeList') --}}


                </div>



            </div>
        </div>
    </section>
    <!-- End Shop Home List  -->

    <!-- Start Most Popular -->
    <div class="product-area most-popular section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Najnovije</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">

                        <!-- Start Single Product most popular -->

                        @if(isset($hotItem))
                            @foreach($hotItem as $h)

                                @hot(['product'=>$h])@endhot

                        @endforeach
                    @endif

                    {{--   @include('inc.mostPopular') --}}

                    <!-- End Single Product -->
                    </div>
                </div>
            </div>




        </div>
    </div>

    <!-- End Most Popular Area -->

    <!-- Start Cowndown Area -->
    <section class="cown-down">
        <div class="section-inner ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-12 padding-right">
                        <div class="image">
                            <img src="https://via.placeholder.com/750x590" alt="#">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 padding-left">
                        <div class="content">
                            <div class="heading-block">
                                <p class="small-title">Deal of day</p>
                                <h3 class="title">Beatutyful dress for women</h3>
                                <p class="text">Suspendisse massa leo, vestibulum cursus nulla sit amet, frungilla placerat lorem. Cars fermentum, sapien. </p>
                                <h1 class="price">$1200 <s>$1890</s></h1>
                                <div class="coming-time">
                                    <div class="clearfix" data-countdown="2021/02/30"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /End Cowndown Area -->

    <!-- Start Shop Blog  -->
    <section class="shop-blog section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>From Our Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
    @if(isset($blog))

        @foreach($blog as $b)

            @blog(['blog'=>$b])@endblog

        @endforeach

        @endif

            </div>
        </div>
    </section>



    <!-- Start Shop Services Area -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Free shiping</h4>
                        <p>Orders over $100</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Free Return</h4>
                        <p>Within 30 days returns</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Sucure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Best Peice</h4>
                        <p>Guaranteed price</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services Area -->



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
                </div>
                <div class="modal-body">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <!-- Product Slider -->
                            <div class="product-gallery">
                                <div class="quickview-slider-active">
                                    <div class="single-slider">
                                        <img src="https://via.placeholder.com/569x528" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://via.placeholder.com/569x528" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://via.placeholder.com/569x528" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="https://via.placeholder.com/569x528" alt="#">
                                    </div>
                                </div>
                            </div>
                            <!-- End Product slider -->
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="quickview-content">
                                <h2>Flared Shift Dress</h2>
                                <div class="quickview-ratting-review">
                                    <div class="quickview-ratting-wrap">
                                        <div class="quickview-ratting">
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="#"> (1 customer review)</a>
                                    </div>
                                    <div class="quickview-stock">
                                        <span><i class="fa fa-check-circle-o"></i> in stock</span>
                                    </div>
                                </div>
                                <h3>$29.00</h3>
                                <div class="quickview-peragraph">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.</p>
                                </div>
                                <div class="size">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <h5 class="title">Size</h5>
                                            <select>
                                                <option selected="selected">s</option>
                                                <option>m</option>
                                                <option>l</option>
                                                <option>xl</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <h5 class="title">Color</h5>
                                            <select>
                                                <option selected="selected">orange</option>
                                                <option>purple</option>
                                                <option>black</option>
                                                <option>pink</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity">
                                    <!-- Input Order -->
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!--/ End Input Order -->
                                </div>
                                <div class="add-to-cart">
                                    <a href="#" class="btn">Add to cart</a>
                                    <a href="#" class="btn min"><i class="ti-heart"></i></a>
                                    <a href="#" class="btn min"><i class="fa fa-compress"></i></a>
                                </div>
                                <div class="default-social">
                                    <h4 class="share-now">Share:</h4>
                                    <ul>
                                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                        <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->
<script>
    function hide_something(myDiv)
    {
       //alert("#"+myDiv);
        $("#"+myDiv).css('display','none');

    }
    function show(myDiv)
    {
        //alert("#"+myDiv);
        $("#"+myDiv).css('display','block');
    }



</script>

@endsection