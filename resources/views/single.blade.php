@extends('layout.index')

@section('content')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <link rel="stylesheet" href="{{asset('css/flexslider.css')}}" type="text/css" media="screen" />

    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('welcome')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="">Oglas</a></li>
                            {{--ime oglasa --}}
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
                        <h3 class="title">Informacije</h3>

                        @if(isset($data))
                          <h4> O oglasu</h4>
                        <br>
                            <label class="label_info">Naziv: {{$data[0]->o_name}}</label>
                            <label class="label_info">Oglas postavljen: {{$data[0]->timestamp}}</label>
                            <label class="label_info">Cena: {{$data[0]->price}}{{$data[0]->currency_text}}</label>

                            <label class="label_info">{{$data[0]->price_status}}</label>
                            <label class="label_info">Stanje: {{$data[0]->condition_status}}</label>
                            <hr>

                            <h4>O korisniku</h4>
                        <br>
                        <label class="label_info">Korisnik: {{$data[0]->username}}</label>
                        <label class="label_info">Korisnik od: {{$data[0]->created_at}}</label>
                        <label class="label_info">Grad: {{$data[0]->city}}</label>
                        <label class="label_info">Telefon: {{$data[0]->phone_number}}</label>
                        <label class="label_info">Broj oglasa korisnika: {{$data[0]->number_of}}</label>

                            @if(\Illuminate\Support\Facades\Auth::check())
                            <button id="sendMessageUser" class="cat-btn">Posalji poruku</button>
                            @else
                                <button class="cat-btn" disabled><a data-toggle="modal" href="#myModal">Posalji poruku</a></button>
                                @endif
@endif

                    </div>

                    <div class="single-widget category">
                        <h3 class="title"> Categories</h3>

                        <ul class="categor-list" id="categoryShopList">



                            @include('inc.categories', ['categoryList' => $categoryList,'ppk'=>$ppk,'data'=>$data])


                        </ul>

                    </div>

                </div>


                <div class="col-lg-9 col-md-8 col-12" style="float:right;">



                    <section class="slider">
                        <div id="slider" class="flexslider">
                            <ul class="slides">
                               @if(isset($picture))

                                    @foreach($picture as $pic)
                                        <li>
                                        <img src="{{asset($pic->src)}}" alt="{{$pic->alt}}" title="{{$pic->title}}" />
                                       </li>

                                    @endforeach
                                   @endif

                            </ul>

                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                @if(isset($picture))
                                    @foreach($picture as $pic)
                                        <li>
                                            <img src="{{asset($pic->src)}}" alt="{{$pic->alt}}" title="{{$pic->title}}" />
                                        </li>
                                        @endforeach
                                        @endif
                            </ul>
                        </div>
                    </section>







<div class="description">

    @if(isset($data))

        {{$data[0]->description}}



        @endif
</div>




                    @include('inc.comment', ['data'=>$data])



                </div>
                
            </div>




        </div>

        <script defer src="{{asset('js/flexslider.js')}}"></script>
        <script type="text/javascript">


            $(window).load(function(){
                $('#carousel').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    itemWidth: 210,
                    itemMargin: 5,
                    asNavFor: '#slider'
                });

                $('#slider').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    sync: "#carousel",
                    start: function(slider){
                        //$('body').removeClass('loading');
                    }
                });
            });

        </script>



    </section>

@endsection