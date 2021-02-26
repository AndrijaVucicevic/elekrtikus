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
                            {{--ime stranice koja je da l oglasi ili koja vec--}}
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
                    @if($code!='novUnos' && $code!='moji_podaci')
                    <div class="single-widget category">
                        <h3 class="title">Categories</h3>
                        <ul class="categor-list" id="categoryShopList">

                          @if(isset($categoryList)&&$categoryList!=null && $data!=null)

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

                    @endif
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
@elseif($code=='novUnos')


                    @include('inc.new_product', ['category' => $categoryList])



</div>



                        @elseif($code=='obavestenja')

                        <div class="notification_block">

                            OBAVESTENJA

                        </div>
         @elseif($code=='moji_podaci')
                        <div class="" id="user_data">

                            <label class="label_data">Clan od:

                          {{$data->created_at}}</label>

                            <i class="fa fa-pencil" title="izmeni"></i><br>
                            <div class="my_data">
                                <label class="label_data">Ime:</label><label class="label_data user">{{$data->name}}</label>
                            </div>

                            <div class="my_data">
                                <label class="label_data">Prezime:</label><label class="label_data user">{{$data->lastName}}</label>
                            </div>
                            <div class="my_data">
                                <label class="label_data">Email:</label><label class="label_data user">{{$data->email}}</label>
                            </div>
                            <div class="my_data">
                                <label class="label_data">Username:</label><label class="label_data user">{{$data->username}}</label>
                            </div>
                          {{--  <label>Broj oglasa:</label><br>{{$data->broj_oglasa}}--}}




                            {{-- @include('inc.user_data', ['user' => $data])--}}

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