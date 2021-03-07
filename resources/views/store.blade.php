@extends('layout.index')

@section('content')
<style>



</style>
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('welcome')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="blog-single.html">Shop Grid</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Most Popular -->
    <div class="product-area most-popular section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Hot Item</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">

                        <!-- Start Single Product most popular -->

                        <!-- most popular kategorije te i te
                       -->



                        @if(isset($hotItem))
                            @foreach($hotItem as $item)

                                @hot(['product'=>$item])@endhot

                        @endforeach
                    @endif


                    <!-- End Single Product -->
                    </div>
                </div>
            </div>




        </div>
    </div>

    <!-- End Most Popular Area -->


    <!-- Product Style -->

    <section class="product-area shop-sidebar shop section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="shop-sidebar">
                        <!-- Single Widget -->
                        <div class="single-widget category">
                            <h3 class="title">Categories</h3>
                            <ul class="categor-list" id="categoryShopList">


                                @include('inc.categories', ['categoryList' => $categoryList,'ppk'=>$ppk,'data'=>$data])



                            </ul>
                        </div>
                        <!--/ End Single Widget -->

                        <!-- Shop By Price -->
                        <div class="single-widget range">
                            <h3 class="title">Shop by Price</h3>
                            <div class="price-filter">
                                <label class="active_page">Cena:</label><br>
<input type="number" id="min_price_filter" name="min_price_filter" min="1" value="1" placeholder="Min"  max="1000000"/>
                                <input type="number" id="max_price_filter" min="2" value="1000000" placeholder="Max" name="max_price_filter"  max="1000000"/>

                      <!--<button id="priceBtn" name="priceBtn"><i class='fas fa-arrow-right'></i> </button>-->
                                <!-- show number of products -->

                                    <p><!--ukupno--> <span id="demo"></span></p>


                            </div>
@if(isset($count))
                            <ul class="check-box-list">
                               <li> <label class="active_page">Stanje:</label></li>
                                <li>
                                    <label class="checkbox-inline" for="1"><input name="condition" class="check_filt condition-filter" value="1" type="checkbox">Novo<span class="count">({{$count[0][0]->novo}})</span></label>
                                </li>
                                <li>
                                    <label class="checkbox-inline" for="2"><input name="condition" class="check_filt condition-filter" value="2" type="checkbox">Kao novo<span class="count">({{$count[0][0]->kao}})</span></label>
                                </li>
                                <li style="border-bottom: 1px solid; padding-bottom: 10px;">
                                    <label class="checkbox-inline" for="3"><input name="condition" class="check_filt condition-filter" value="4" type="checkbox">Polovno<span class="count">({{$count[0][0]->polovno}})</span></label>
                                </li>
                            </ul>

                            <ul class="check-box-list">
                              <li>  <label class="active_page">Prema ceni:</label></li>
                                <li>
                                    <label class="checkbox-inline" for="1"><input name="price-filter" class="check_filt price-filter" value="1" type="checkbox">Fiksno<span class="count">({{$count[1][0]->fiksno}})</span></label>
                                </li>
                                <li>
                                    <label class="checkbox-inline" for="2"><input name="price-filter" class="check_filt price-filter" value="2" type="checkbox">Zamena<span class="count">({{$count[1][0]->zamena}})</span></label>
                                </li>
                                <li style="border-bottom: 1px solid; padding-bottom: 10px;">
                                    <label class="checkbox-inline" for="3"><input name="price-filter" class="check_filt price-filter" value="4" type="checkbox">Dogovor<span class="count">{{$count[1][0]->dogovor}}</span></label>
                                </li>
                            </ul>
                            <ul class="check-box-list">
                                <li>  <label class="active_page">Valuta:</label></li>
                                <li>
                                    <label class="checkbox-inline" for="1"><input name="price-currency" class="check_filt price-currency" value="1" type="checkbox">RSD<span class="count">({{$count[2][0]->rsd}})</span></label>
                                </li>
                                <li>
                                    <label class="checkbox-inline" for="2"><input name="price-currency" class="check_filt price-currency" value="2" type="checkbox"> &euro;<span class="count">({{$count[2][0]->euro}})</span></label>
                                </li>

                            </ul>
<button id="filt-btn" class="cat-btn">Primeni filtere</button>
@endif
                        </div>
                        <!--/ End Shop By Price -->
                        <!-- Single Widget -->
                        <div class="single-widget recent-post">
                            <h3 class="title">Recent post</h3>

                            @include('inc.recentPost')


                        </div>
                        <!--/ End Single Widget -->

                    </div>
                </div>

                <div class="col-lg-9 col-md-8 col-12">
                    <div class="row">

                        <div class="col-12">
                            <!-- Shop Top -->
                            <div class="shop-top">
                                <div class="shop-shorter">
                                    <div class="single-shorter">
                                        <label>Show :</label>
                                        <select id="ddl_take" class="show_take">
                                            <option value="t_2">2</option>
                                            <option value="t_3">3</option>
                                            <option value="t_21">21</option>
                                            <option value="t_30">30</option>
                                        </select>
                                    </div>
                                    <div class="single-shorter">
                                        <label>Sort By :</label>
                                        <select id="ddl_sort" class="sort_products">
                                            <option value="s_0">Najnoviji</option>
                                            <option value="s_1">Najstariji</option>
                                            <option value="s_2">Cena-najjeftiniji</option>
                                            <option value="s_3">Cena-najskuplji</option>
                                        </select>
                                    </div>
                                </div>
                                <ul class="view-mode">
                                    <li class="active"><a href="shop-grid.html"><i class="fa fa-th-large"></i></a></li>
                                    <li><a href="shop-list.html"><i class="fa fa-th-list"></i></a></li>
                                </ul>
                            </div>
                            <!--/ End Shop Top -->
                        </div>

                    </div>

                    <div class="row" id="products_rowShop">

                      {{--  @include('inc.productShop') --}}
                        @if(isset($products))
                            @foreach($products as $pr)

                                @shop(['product'=>$pr])@endshop

                            @endforeach
                        @endif

                    </div>
                    <div class="shop-top">
                        <div class="shop-shorter">

                            <i class='fas fa-bullhorn' style="cursor: pointer;">Sponzorisani</i>
                        </div>
                        <ul class="view-mode" id="pagination_view">

@if(isset($pages))
<!-- active i or page 1-->



                                <li><span class="previous">Page: </span></li>
                                <li value="0" class="pagination_click active_page">1</li>


                                @if($pages>6)

                                    <li value="1" class="pagination_click">2</li>
                                    <li value="2" class="pagination_click">3</li>

                                    <li>&nbsp&nbsp...&nbsp&nbsp</li>
                                    <li value="{{($pages-1)}}" class="pagination_click">{{$pages}}</li>




                                    <li value="1" class="pagination_click">Next</li>
                                @endif
                                @if($pages<6)

                                    @for($i=2;$i<=$pages;$i++)

                                        <li value="{{($i-1)}}" class="pagination_click">{{$i}}</li>

                                    @endfor
                                @endif


                            @endif

                        </ul>





                    </div>

                </div>


            </div>
        </div>
    </section>





<script src="{{asset('js/shop.js')}}" type="text/javascript"></script>

@endsection