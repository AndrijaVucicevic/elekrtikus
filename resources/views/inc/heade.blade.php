<head>
    <!-- Meta Tag -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name='copyright' content=''/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<!-- csrf token-->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- Title Tag  -->
    <title>Eshop - eCommerce HTML5 Template.</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}"/>
    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet"/>

    <!-- StyleSheet -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}"/>
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset('css/magnific-popup.min.css')}}"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}"/>
    <!-- Fancybox -->
    <link rel="stylesheet" href="{{asset('css/jquery.fancybox.min.css')}}"/>
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}"/>
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('css/niceselect.css')}}"/>
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('css/animate.css')}}"/>
    <!-- Flex Slider CSS -->

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('css/owl-carousel.css')}}"/>
    <!-- Slicknav -->
    <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}"/>

    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href="{{asset('css/reset.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/chat.css')}}"/>

   <!--jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   @if(Route::current()->getName() == 'single')

        <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

        <link type="text/css" rel="stylesheet" href="{{asset('css/zoomy.css')}}">

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


    @endif
</head>