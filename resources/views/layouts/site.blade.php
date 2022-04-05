<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel = "icon" type = "image/png" href = "{{asset('assets/front/images/Logo.png')}}">
    <title>CareHub | @yield('title') </title>

<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{asset('assets/front/css/swiper.min.css')}}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('assets/front/style.css')}}">

    {{--    @if(\Illuminate\Support\Facades\App::isLocale('ar'))--}}
    {{--        <link href="{{asset('assets/front/css/styleAr.css')}}" rel="stylesheet">--}}
    {{--    @endif--}}

</head>

<body class="single-page">

<header class="site-header">
    @include('front.include.navbar')
    @yield('header')
</header>


@yield('content')

<!--Footer-->
@include('front.include.footer')


<!-- SCRIPTS -->
<script type='text/javascript' src='{{asset('assets/front/js/jquery.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/front/js/jquery.collapsible.min.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/front/js/swiper.min.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/front/js/jquery.countdown.min.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/front/js/circle-progress.min.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/front/js/jquery.countTo.min.js')}}'></script>
<script type='text/javascript' src='{{asset('assets/front/js/jquery.barfiller.js')}}'></script>
<script type='text/javascript' src="{{asset('assets/front/js/custom.js')}}"></script>


@yield('scripts')

</body>

</html>
