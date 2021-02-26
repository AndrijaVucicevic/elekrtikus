@extends('layout.index')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
@section('content')


    <div class="logo_left" style="float: left;">
        <img src="" alt="logo" title="logo"/>

    </div>
    <div class="logo_right" style="float: right;">
        <script>
            document.write('<a href="' + document.referrer + '">Go Back</a>');
        </script>
    </div>
    <div class="clear"></div>
    <div class="main" style="margin:10px auto; margin-left: 10%;">

        <div style="margin-top:40px;margin-bottom:130px">
            <div class="alert alert-success alert-block" id="sign_up" style="display: none;">


            </div>
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>


            </div>
        </div>

        @include("inc.sign_up")

    </div>
    <div class="clear"></div>

    <script type="text/javascript" src="{{asset("js/register.js")}}"></script>
@endsection




