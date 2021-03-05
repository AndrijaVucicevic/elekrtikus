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

                        @if(isset($data))
                          <h3> O oglasu</h3>
                            <label>{{$data->o_name}}</label>
                            <label>{{$data->price}}{{$data->currency_text}}</label>
                            <label>{{$data->price_status}}</label>
                            <label>{{$data->condition_status}}</label>
                            <label>{{$data->condition_status}}</label>

                            <h3>O korisniku</h3>
                        <label>{{$data->name}}</label>
                        <label>{{$data->created_at}}</label>
                        <label>{{$data->city}}</label>
                        <label>{{$data->phone_number}}</label>
                        <label>{{$data->number_of}}</label>


@endif

                    </div>


                </div>


                <div class="col-lg-9 col-md-8 col-12" style="float:right;">



                    <div id='el'>


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


        <script src="{{asset('js/zoomy.js')}}"></script>
<script>

   /* $(".albery-container").albery({
        speed: 500, // default: 200
        imgWidth: 600, // default: 600
    });
*/

   var urls = [
       'img/slide1.jpg',
       'img/slide3.jpg',
       'img/slide2.jpg',
       'img/slide4.jpg',
       'img/slide3.jpg',
       'img/slide1.jpg',
       'img/slide3.jpg',
       'img/slide2.jpg',
       'img/slide4.jpg',
       'img/slide3.jpg',
   ];
   var options = {
       //thumbLeft:true,
       //thumbRight:true,
       //thumbHide:true,
       //width:300,
       //height:500,
   };
   $('#el').zoomy(urls,options);


</script>

    </section>

@endsection