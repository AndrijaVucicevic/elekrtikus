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
                        <h3 class="title">Informacije o korisniku</h3>

                        @if(isset($data))
                          <h3> O oglasu</h3>
                            <label>{{$data[0]->o_name}}</label>
                            <label>Oglas postavljen: {{$data[0]->timestamp}}</label>
                            <label>Cena: {{$data[0]->price}}{{$data[0]->currency_text}}</label>

                            <label>{{$data[0]->price_status}}</label>
                            <label>{{$data[0]->condition_status}}</label>

                            <h3>O korisniku</h3>
                        <label>{{$data[0]->name}}</label>
                        <label>Korisnik od: {{$data[0]->created_at}}</label>
                        <label>{{$data[0]->city}}</label>
                        <label>{{$data[0]->phone_number}}</label>
                        <label>Broj oglasa korisnika : {{$data[0]->number_of}}</label>


@endif

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


                    {{--
                                                    @if(isset($data))
                                                        @foreach($data as $pr)

                                                            @shop(['product'=>$pr])@endshop

                                                        @endforeach
                                                    @endif
                                                   --}}

                    <div class="shop-top search_more" data-max="0">

                        <!--comment-->
                        <span class="more_products" data-value="more-comment" data-max="0">UČITAJ VIŠE</span>



                    </div>

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

    <!--    <script src="{{asset('js/zoomy.js')}}"></script>
<script type="text/javascript">

   /* $(".albery-container").albery({
        speed: 500, // default: 200
        imgWidth: 600, // default: 600
    });
*/



   var urls = [];



console.log(urls);
console.log('aa');
   var options = {
       //thumbLeft:true,
       //thumbRight:true,
       //thumbHide:true,
       //width:300,
       //height:500,
   };
   $('#el').zoomy(urls,options);


</script>
-->
    </section>

@endsection