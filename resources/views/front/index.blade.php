@extends('layouts.site')

@section('title', __('Home'))

@section('header')
    <style>
        .single-page .site-header{
            padding-top: 85px;
            padding-bottom: 0px;
            background-color: #fff;
        }
    </style>
    <div class="swiper-container hero-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide hero-content-wrap"
                 style="background-image: url('@if(isset($slider['sliderImage1']) && $slider['sliderImage1']!=""){{ asset($slider['sliderImage1']) }}@else {{asset('assets/front/images/hero.jpg')}} @endif')">
                <div class="hero-content-overlay position-absolute w-100 h-100">
                    <div class="container h-100">

                        @if($notification == '1')
                            <div class="alert alert-primary text-center" role="alert" style="margin-top:50px">
                                <a href="{{ route('home.user.info',app()->getLocale()) }}"> {{ __('Please Complete your Profile') }}</a>
                            </div>
                        @endif
                        <div class="row h-100">
                            <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-start">
                                <header class="entry-header">
                                    <h1>{{ __('The First Home Hospital in Egypt') }}</h1>
                                </header><!-- .entry-header -->

                                <div class="entry-content mt-4">
                                    <p style="font-size: 25px;">{{ __('Emergency Call') }}</p>
                                </div><!-- .entry-content -->

                                <footer class="entry-footer d-flex flex-wrap align-items-center mt-4">
                                    <dev class=" call-btn button gradient-bg mt-3 mt-md-0"
                                         style="margin-left:0px">
                                        <a class="d-flex justify-content-center align-items-center" href="tel:15848"><img
                                                src="{{asset('assets/front/images/emergency-call.png')}}"> {{ __('Emergency Call') }}</a>
                                    </dev>
                                    <dev class=" call-btn button gradient-bg-stop mt-3 mt-md-0" style="background-color: #25D366;border-bottom-color: #25D366;">
                                        <a class="d-flex justify-content-center align-items-center"
                                           href="https://api.whatsapp.com/send?phone=15848" target="_blank">
                                            <i style="font-size: 32px;" class="fa fa-whatsapp" aria-hidden="true"></i>
                                            &nbsp; &nbsp; Whats App</a>
                                    </dev>
                                </footer><!-- .entry-footer -->
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .container -->
                </div><!-- .hero-content-overlay -->
            </div><!-- .hero-content-wrap -->

            <div class="swiper-slide hero-content-wrap"
                 style="background-image: url('@if(isset($slider['sliderImage2']) && $slider['sliderImage2']!=""){{ asset($slider['sliderImage2']) }}@else {{asset('assets/front/images/hero.jpg')}} @endif')">
                <div class="hero-content-overlay position-absolute w-100 h-100">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-start">
                                <header class="entry-header">
                                    <h1>The Best <br>Medical Services</h1>
                                </header><!-- .entry-header -->

                                <div class="entry-content mt-4">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.</p>
                                </div><!-- .entry-content -->

                                <footer class="entry-footer d-flex flex-wrap align-items-center mt-4">
                                    <a href="#" class="button gradient-bg">Read More</a>
                                </footer><!-- .entry-footer -->
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .container -->
                </div><!-- .hero-content-overlay -->
            </div><!-- .hero-content-wrap -->

            <div class="swiper-slide hero-content-wrap"
                 style="background-image: url('@if(isset($slider['sliderImage3']) && $slider['sliderImage3']!=""){{ asset($slider['sliderImage3']) }}@else {{asset('assets/front/images/hero.jpg')}} @endif')">
                <div class="hero-content-overlay position-absolute w-100 h-100">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-start">
                                <header class="entry-header">
                                    <h1>The Best <br>Medical Services</h1>
                                </header><!-- .entry-header -->

                                <div class="entry-content mt-4">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.</p>
                                </div><!-- .entry-content -->

                                <footer class="entry-footer d-flex flex-wrap align-items-center mt-4">
                                    <a href="#" class="button gradient-bg">Read More</a>
                                </footer><!-- .entry-footer -->
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .container -->
                </div><!-- .hero-content-overlay -->
            </div><!-- .hero-content-wrap -->
        </div><!-- .swiper-wrapper -->

        <div class="pagination-wrap position-absolute w-100">
            <div class="swiper-pagination d-flex flex-row flex-md-column"></div>
        </div><!-- .pagination-wrap -->
    </div><!-- .hero-slider -->
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12" style="margin-top: -82px;">
                @include('admin.include.alerts.success')
                @include('admin.include.alerts.errors')
                <div class="services-tabs">
                    <div class="tabs">
                        <ul class="tabs-nav d-flex flex-wrap justify-content-center">
                            <li class="tab-nav d-flex justify-content-center align-items-center" style="border-radius:50px" data-target="#tab_1">{{ __('Emergency Call') }}</li>
                            <li class="tab-nav d-flex justify-content-center align-items-center" style="border-radius:50px" data-target="#tab_2">{{ __('Home Visit') }}</li>
                            <li class="tab-nav d-flex justify-content-center align-items-center" style="border-radius:50px" data-target="#tab_3">{{ __('Book Integrated Medical Services') }}</li>
                        </ul>

                        <div class="tabs-container">
{{--                            Emergency Call --}}
                            <div id="tab_1" class="tab-content">

                                <form method="POST" action="{{ route('home.callme',app()->getLocale()) }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="specialty_id"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Specialty') }}</label>
                                        <div class="col-md-6">
                                            <select name="specialty_id" id="specialty_id"
                                                    class="form-control  @error('specialty_id') is-invalid @enderror" required>
                                                <option></option>
                                                @if($specialtys)
                                                    @foreach($specialtys as $specialty)
                                                        <option value="{{ $specialty->id }}">
                                                            @if(app()->getLocale() == 'en')
                                                                {{$specialty->name_en}}
                                                            @else
                                                                {{$specialty->name_ar}}
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('specialty_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Add your Phone') }}</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                   @if(isset(Auth::user()->phone))
                                                        value="{{ Auth::user()->phone }}"
                                                   @endif
                                                   required autocomplete="phone" autofocus>

                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="button gradient-bg" name="need" value="callme">
                                                {{ __('Call me') }}
                                            </button>
                                        </div>
                                    </div>


                                </form>

                            </div>

                            <div id="tab_2" class="tab-content">


                                <form method="POST" action="{{ route('home.callme',app()->getLocale()) }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="specialty_id"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Specialty') }}</label>
                                        <div class="col-md-6">
                                            <select name="specialty_id" id="specialty_id"
                                                    class="form-control  @error('specialty_id') is-invalid @enderror" required>
                                                <option></option>
                                                @if($specialtys)
                                                    @foreach($specialtys as $specialty)
                                                        <option value="{{ $specialty->id }}">
                                                            @if(app()->getLocale() == 'en')
                                                                {{$specialty->name_en}}
                                                            @else
                                                                {{$specialty->name_ar}}
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('specialty_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Add your Phone') }}</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                   @if(isset(Auth::user()->phone))
                                                        value="{{ Auth::user()->phone }}"
                                                   @endif
                                                   required autocomplete="phone" autofocus>

                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="visit_time_day" class="col-md-4 col-form-label text-md-right">{{ __('Day') }}</label>

                                        <div class="col-md-6">
                                            <input id="visit_time_day" type="date" class="form-control @error('visit_time_day') is-invalid @enderror" name="visit_time_day" value="{{ old('visit_time_day') }}" required autofocus>

                                            @error('visit_time_day')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('available From') }}</label>

                                        <div class="col-md-6">
                                            <input id="visit_time_from" type="time" class="form-control @error('visit_time_from') is-invalid @enderror" name="visit_time_from" value="{{ old('visit_time_from') }}" required autofocus>

                                            @error('visit_time_from')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="visit_time_to" class="col-md-4 col-form-label text-md-right">{{ __('available To') }}</label>

                                        <div class="col-md-6">
                                            <input id="visit_time_to" type="time" class="form-control @error('visit_time_to') is-invalid @enderror" name="visit_time_to" value="{{ old('visit_time_to') }}" required autofocus>

                                            @error('visit_time_to')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="button gradient-bg" name="need" value="VisitServices">
                                                {{ __('Book Now') }}
                                            </button>
                                        </div>
                                    </div>


                                </form>


                            </div>

                            <div id="tab_3" class="tab-content">

                                <form method="POST" action="{{ route('home.callme',app()->getLocale()) }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="service_id"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Our Serves') }}</label>
                                        <div class="col-md-6">
                                            <select name="service_id" id="service_id"
                                                    class="form-control  @error('service_id') is-invalid @enderror" required>
                                                <option></option>
                                                @if($serves)
                                                    @foreach($serves as $serve)
                                                        <option value="{{ $serve->id }}">
                                                            @if(app()->getLocale() == 'en')
                                                                {{$serve->name_en}}
                                                            @else
                                                                {{$serve->name_ar}}
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('service_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Add your Phone') }}</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                   @if(isset(Auth::user()->phone))
                                                        value="{{ Auth::user()->phone }}"
                                                   @endif
                                                   required autocomplete="phone" autofocus>

                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="visit_time_day" class="col-md-4 col-form-label text-md-right">{{ __('Day') }}</label>

                                        <div class="col-md-6">
                                            <input id="visit_time_day" type="date" class="form-control @error('visit_time_day') is-invalid @enderror" name="visit_time_day" value="{{ old('visit_time_day') }}" required autofocus>

                                            @error('visit_time_day')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('available From') }}</label>

                                        <div class="col-md-6">
                                            <input id="visit_time_from" type="time" class="form-control @error('visit_time_from') is-invalid @enderror" name="visit_time_from" value="{{ old('visit_time_from') }}" required autofocus>

                                            @error('visit_time_from')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="visit_time_to" class="col-md-4 col-form-label text-md-right">{{ __('available To') }}</label>

                                        <div class="col-md-6">
                                            <input id="visit_time_to" type="time" class="form-control @error('visit_time_to') is-invalid @enderror" name="visit_time_to" value="{{ old('visit_time_to') }}" required autofocus>

                                            @error('visit_time_to')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="button gradient-bg" name="need" value="MedicalServices">
                                                {{ __('Book Now') }}
                                            </button>
                                        </div>
                                    </div>

                                    <?php
//                                    $input = '2021-12-14';
//                                    echo date("D", strtotime($input));
                                    ?>


                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
