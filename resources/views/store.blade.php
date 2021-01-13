@extends('layout.index')

@section('content')
<style>
    .subcategory_list{
        display:none;
    }


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

                                @if(isset($categoryList))
                                @for($i=0;$i<count($categoryList);$i++)

                                        <li class="category_list_shop collapsible" data-target="{{$categoryList[$i]->subcategory_name}}">{{$categoryList[$i]->subcategory_name}}
                                            <ul class="subcategory_list">
                                      @for($a=0;$a<count($ppk);$a++)

@if($ppk[$a]->subcategory_id==$categoryList[$i]->id_subcategory)

                                                        <li id="list_http://localhost/elektrikus/public/shop?{{$categoryList[$i]->subcategory_name}}&category={{$ppk[$a]->name_ppk}}">{{$ppk[$a]->name_ppk}}</li>

                                                    @endif



                                       @endfor
                                            </ul>
                                        </li>
                                    @endfor

                                 @endif



                            </ul>
                        </div>
                        <!--/ End Single Widget -->

                        <!-- Shop By Price -->
                        <div class="single-widget range">
                            <h3 class="title">Shop by Price</h3>
                            <div class="price-filter">
<input type="number" id="min_price_filter" name="min_price_filter" min="1" value="1" placeholder="Min"  max="1000000"/>
                                <input type="number" id="max_price_filter" min="2" value="100000" placeholder="Max" name="max_price_filter"  max="1000000"/>

                      <button id="priceBtn" name="priceBtn"><i class='fas fa-arrow-right'></i> </button>
                                <!-- show number of products -->

                                    <p>Broj proizvoda: <span id="demo"></span></p>


                            </div>
                            <ul class="check-box-list">
                                <li>
                                    <label class="checkbox-inline" for="1"><input name="news" id="1" type="checkbox">$20 - $50<span class="count">(3)</span></label>
                                </li>
                                <li>
                                    <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox">$50 - $100<span class="count">(5)</span></label>
                                </li>
                                <li>
                                    <label class="checkbox-inline" for="3"><input name="news" id="3" type="checkbox">$100 - $250<span class="count">(8)</span></label>
                                </li>
                            </ul>
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