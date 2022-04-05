@extends('layouts.site')

@section('title', __('Register'))

@section('header')
    <style>
        .single-page .site-header {
            padding: 85px;
            background-color: #fff;
        }
    </style>
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12" style="margin-top: -82px;min-height:450px;">
                <div class="our-departments-wrap">
                    @if(isset($msg))
                        @if($msg == 'order')
                            <H2>Or{{ $data->id }}</H2>
                        @elseif($msg == 'request')
                            <H2>Re{{ $data->id }}</H2>
                        @endif
                    @endif

                    <div class="row">
                        @if($data->fullname)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/cardiogram.png')}}" alt="">

                                        <h3>{{ __('Patient Name') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>{{ $data->fullname }}</p>
                                    </div>

                                    {{--                                <footer class="entry-footer">--}}
                                    {{--                                    <a href="#">read more</a>--}}
                                    {{--                                </footer>--}}
                                </div>
                            </div>
                        @endif
                        @if($data->doctor_id)
                            <div class="col-12 col-md-6 col-lg-4 mb-0">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/glasses.png')}}" alt="">

                                        <h3>{{ __('Doctor Name') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>{{ \App\Models\User::getDocName($data->doctor_id)  }}</p>
                                    </div>

                                    {{--                                <footer class="entry-footer">--}}
                                    {{--                                    <a href="#">read more</a>--}}
                                    {{--                                </footer>--}}
                                </div>
                            </div>
                        @endif
                        @if($data->adress)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/stomach-2.png')}}" alt="">

                                        <h3>{{ __('Address') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>{!! \App\Models\Order::getAddress($data->id) !!} </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($data->phone)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/stomach-2.png')}}" alt="">

                                        <h3>{{ __('Phone') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>{{ $data->phone }}
                                            @if($data->phone2 != "")
                                                <br/>
                                                {{ $data->phone2 }}
                                            @endif
                                        </p>

                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($data->birth_date)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/stomach-2.png')}}" alt="">

                                        <h3>{{ __('Birth Date') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>{{ $data->birth_date }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($data->gender)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/blood-donation-2.png')}}" alt="">

                                        <h3>{{ __('Gender') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>{{ __(\App\Models\User::getGenderType($data->gender)) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($data->emergency)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/bones.png')}}" alt="">

                                        <h3>{{ __('Emergency') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        @if($data->emergency)
                                            <p>{{ __('Yes') }}</p>
                                        @else
                                            <p>{{ __('NO') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($data->specialty_id)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/teeth.png')}}" alt="">
                                        <h3>{{ __('Specialty') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>{{ \App\Models\Specialty::getName($data->specialty_id) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($data->service_id)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/teeth.png')}}" alt="">
                                        <h3>{{ __('Serves') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>{{ \App\Models\Service::getName($data->service_id) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(isset($data->states))
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/scanner.png')}}" alt="">

                                        <h3>{{ __('States') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>{{ \App\Models\Order::getOrderStates($data->states) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(isset($data->state))
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/scanner.png')}}" alt="">

                                        <h3>{{ __('States') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>{{ \App\Models\Requests::getRequestState($data->state) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($data->type)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/scanner.png')}}" alt="">

                                        <h3>{{ __('Type') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>{{ \App\Models\Order::getOrderType($data->type) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="row">
                        @if($data->visit_time_day)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/stretcher.png')}}" alt="">
                                        <h3>{{ __('Visit Day') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>{{ $data->visit_time_day }}<br/>
                                            {{ __(date("l", strtotime($data->visit_time_day))) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($data->visit_time_from)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/stretcher.png')}}" alt="">
                                        <h3>{{ __('Visit Time From') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>{{ $data->visit_time_from }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($data->visit_time_to)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="our-departments-cont">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <img src="{{asset('assets/front/images/stretcher.png')}}" alt="">
                                        <h3>{{ __('Visit Time To') }}</h3>
                                    </header>

                                    <div class="entry-content">
                                        <p>{{ $data->visit_time_to }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row text-center">
                        @if($msg == 'request')
                        <a class="button gradient-bg"
                           href="{{ route('user.request.state',['language'=>app()->getLocale(),'id'=>$data->id,'state'=>'5']) }}">{{ __('Cancel') }}</a>
                        @endif

                            @if(auth()->user()->type == '2')
                                @if($data->states == '1')
                                    <a class="button gradient-bg"
                                       href="{{ route('doc.order.state',['language'=>app()->getLocale(),'id'=>$data->id,'state'=>'29']) }}">
                                        {{ __('Cancel') }}</a>

                                    <a class="button gradient-bg"
                                       href="{{ route('doc.order.state',['language'=>app()->getLocale(),'id'=>$data->id,'state'=>'2']) }}">
                                        {{ __('Accept') }}</a>
                                @elseif($data->states == '2')
                                    <a class="button gradient-bg"
                                       href="{{ route('doc.order.state',['language'=>app()->getLocale(),'id'=>$data->id,'state'=>'3']) }}">
                                        {{ __('Medical assessment') }}</a>
                                    <a class="button gradient-bg"
                                       href="{{ route('doc.order.state',['language'=>app()->getLocale(),'id'=>$data->id,'state'=>'4']) }}">
                                        {{ __('Finish') }}</a>
                                @endif
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
