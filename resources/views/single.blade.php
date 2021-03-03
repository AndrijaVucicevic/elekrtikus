@extends('layout.index')

@section('content')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


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

                    </div>


                </div>


                <div class="col-lg-9 col-md-8 col-12" style="float:right;">

                    <div class="flexslider">
                        <ul class="slides">

                            <li data-thumb="{{asset('img/thumb/slide1.jpg')}}">
                                <img src="{{asset('img/slide1.jpg')}}"/>
                            </li>
                            <li data-thumb="{{asset('img/thumb/slide2.jpg')}}">
                                <img src="{{asset('img/slide2.jpg')}}"/>
                            </li>
                            <li data-thumb="{{asset('img/thumb/slide3.jpg')}}">
                                <img src="{{asset('img/slide3.jpg')}}"/>
                            </li>
                            <li data-thumb="{{asset('img/thumb/slide4.jpg')}}">
                                <img src="{{asset('img/slide4.jpg')}}"/>
                            </li>
                            <li data-thumb="{{asset('img/thumb/slide2.jpg')}}">
                                <img src="{{asset('img/slide2.jpg')}}"/>
                            </li>


                        </ul>
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

<script>
    $(function() {
        $('.flexslider').flexslider({
            animation: 'slide'
        });
    });

</script>

    </section>

@endsection