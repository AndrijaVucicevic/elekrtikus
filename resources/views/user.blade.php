@extends('layout.index')

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('welcome')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="blog-single.html">Korisnik</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="product-area shop-sidebar shop section">

        <div class="container">
<div class="row">
                <div class="col-lg-3 col-md-4 col-12">

                    <div class="single-widget category">
                        <h3 class="title">Categories</h3>
                        <ul class="categor-list" id="categoryShopList">

                          @if(isset($categoryList)&&$categoryList!=null)

                                @for($i=0;$i<count($categoryList);$i++)

                                    <li class="category_list_shop collapsible" data-target="{{$categoryList[$i]->subcategory_name}}">{{$categoryList[$i]->subcategory_name}}
                                        <ul class="subcategory_list">
                                            @for($a=0;$a<count($ppk);$a++)

                                                @if($ppk[$a]->subcategory_id==$categoryList[$i]->id_subcategory)

                                                    <li id="list_category_{{$ppk[$a]->name_ppk}}">{{$ppk[$a]->name_ppk}}</li>

                                                @endif



                                            @endfor
                                        </ul>
                                    </li>
                                @endfor

                            @endif



                        </ul>
                    </div>


            </div>





            <div class="col-lg-9 col-md-8 col-12" style="float: right;">
                <div class="row" id="content_user">
        @if(isset($code))
     @if($code=='oglasi')



                        @if(isset($data))
                            @foreach($data as $pr)

                                @shop(['product'=>$pr])@endshop

                            @endforeach
                        @endif

                </div>
                            <div class="shop-top search_more"data-max="0">


                                <span class="more_products" data-value="more-products_1" data-max="0">UČITAJ VIŠE</span>






                            </div>





                        @elseif($code=='obavestenja')

                        <div class="notification_block">

                            OBAVESTENJA

                        </div>
         @else
                        <div class="" id="user_data">


                        </div>


@endif


                @endif





</div>




    </div>
            <div class="clear"></div>
        </div>

    </section>
<script type="text/javascript" src="{{asset('js/users.js')}}"></script>
@endsection