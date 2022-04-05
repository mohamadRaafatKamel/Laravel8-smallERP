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
{{--                @include('admin.include.alerts.success')--}}
{{--                @include('admin.include.alerts.errors')--}}
                <div class="services-tabs">
                    <div class="tabs">
                        <form method="POST" action="{{ route('user.doc.request',app()->getLocale()) }}">
                            <input name="day" type="date"/>
                        </form>
                        <div class="tabs-container">
                            <div id="tab_1" class="tab-content">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-light">
                                            <thead>
                                            <tr>
                                                <th scope="col">{{ __('Code') }}</th>
                                                <th scope="col">{{ __('Patient Name') }}</th>
                                                <th scope="col">{{ __('Address') }}</th>
                                                <th scope="col">{{ __('Day') }}</th>
                                                <th scope="col">{{ __('Time From') }}</th>
                                                <th scope="col">{{ __('Time To') }}</th>
                                                <th scope="col">{{ __('States') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($orders)
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <th><a href="{{ route('user.view.request',['language'=>app()->getLocale(),'msg'=>'order','id'=>$order->id ] ) }}">
                                                                {{ 'Or'.$order->id }}
                                                            </a></th>
                                                        <td>{{ $order->fullname }}</td>
                                                        <td>{{ $order->fullname }}</td>
                                                        <td>{{ $order->visit_time_day }}</td>
                                                        <td>{{ $order->visit_time_from }}</td>
                                                        <td>{{ $order->visit_time_to }}</td>
                                                        <td>{{ __(\App\Models\Order::getOrderStates( $order->states )) }}</td>
                                                    </tr>
                                        @endforeach
                                        @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
