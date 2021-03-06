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



                            @include('inc.categories', ['categoryList' => $categoryList,'ppk'=>$ppk,'data'=>$data])


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

                            <div class="data-img">

                            <img src="{{asset($data->img)}}" alt="{{$data->name}}" title="{{$data->name}}_{{$data->lastName}}" id="imgUser"/>

                                <div class="shop-top user_P_change">

<label class="pictureLabel user_picture_change">Izmeni sliku</label>

                                </div>
                            </div>


                           <div class="data" style="float:right;"> <label class="label_data">Clan od:

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
                           </div>
                          {{--  <label>Broj oglasa:</label><br>{{$data->broj_oglasa}}--}}



<div class="clear"></div>
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