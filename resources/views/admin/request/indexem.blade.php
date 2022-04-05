@extends('layouts.admin')
@section('title', __('Emergency') )
@section('request_emergency','')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">  {{ __('Emergency') }} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.request.emergency')}}">{{ __('Emergency') }}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"> {{ __('Emergency') }} </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('admin.include.alerts.success')
                                @include('admin.include.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <a class="btn btn-primary mb-2 mr15" href="{{ route('admin.request.create.em') }}"><i class="ft-plus"></i>&nbsp; {{ __('Create Order') }}</a>
                                        <a class="btn btn-danger mb-2" href="{{ route('admin.request.emergency') }}"><i class="ft-refresh-cw"></i>&nbsp; {{ __('ReLoad') }}</a>
                                        
                                        <form class="form form-horizontal" action="{{route('admin.request.emergency')}}" method="GET" >
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label>{{ __('State') }} </label>
                                                    <select name="state" id="state" class="form-control">
                                                        <option value="">{{ __('All') }}</option>
                                                        <option value="1" @if(isset($_GET['state'])) @if ($_GET['state'] == "1") selected @endif @endif >
                                                            {{ __('New Request') }}</option>
                                                        <option value="2" @if(isset($_GET['state'])) @if ($_GET['state'] == "2") selected @endif @endif >
                                                            {{ __('Hold') }}</option>
                                                        <option value="6" @if(isset($_GET['state'])) @if ($_GET['state'] == "6") selected @endif @endif >
                                                            {{ __('Hold to Approve') }}</option>
                                                        <option value="7" @if(isset($_GET['state'])) @if ($_GET['state'] == "7") selected @endif @endif >
                                                            {{ __('Following') }}</option>
                                                        <option value="4" @if(isset($_GET['state'])) @if ($_GET['state'] == "4") selected @endif @endif >
                                                            {{ __('DONE') }}</option>
                                                        <option value="5" @if(isset($_GET['state'])) @if ($_GET['state'] == "5") selected @endif @endif >
                                                            {{ __('Cancel') }}</option>    
                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <button type="submit" class="btn btn-primary" style="margin-top:30px">
                                                        {{ __('Search') }}
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                        <div class="table-responsive">
                                            
                                                <table
                                                    class="table table-striped table-bordered ordering-col7-print">
                                                    <thead>
                                                    <tr>
                                                        <th> {{ __('Request ID') }}</th>
                                                        <th>العميل</th>
                                                        <th> موبيل</th>
                                                        <th> موبيل</th>
                                                        <th> نوع الزياره</th>
                                                        <th> {{ __('CC Agent') }}</th>
                                                        <th> {{ __('Schedule') }}</th>
                                                        <th> {{ __('Date') }}</th>
                                                        <th> الحاله</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @isset($requests)
                                                        @foreach($requests as $request)
                                                            <tr>
                                                                <td>
                                                                    <a href="{{route('admin.request.create.em',['req'=>$request -> id])}}">
                                                                        {{$request -> id}}</a></td>
                                                                <td>
                                                                    @if($request -> user_id == null )
                                                                        {{__('Guest')}}
                                                                    @else
                                                                        <a href="{{route('admin.user.view',$request -> user_id)}}">
                                                                            {{\App\Models\User::getUserName($request -> user_id) }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>{{$request -> phone}}</td>
                                                                <td>{{$request -> phone2 }}</td>
                                                                <td>{{ __(\App\Models\Requests::getRequestType($request -> type)) }}</td>
                                                                <td>{{$request ->getCreateBy($request ->created_by)}}</td>
                                                                <td>{{$request -> schedule_date}}</td>
                                                                <td>{{$request -> created_at}}</td>
                                                                <td>
                                                                    <span class="badge {{ \App\Models\Requests::getStateColor($request ->status_cc) }}">
                                                                        {{ \App\Models\Requests::getRequestState($request -> status_cc) }}
                                                                    </span>
                                                                </td>
                                                            
                                                            </tr>
                                                        @endforeach
                                                    @endisset


                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th> {{ __('Request ID') }}</th>
                                                            <th>العميل</th>
                                                            <th> موبيل</th>
                                                            <th> موبيل</th>
                                                            <th> نوع الزياره</th>
                                                            <th> {{ __('CC Agent') }}</th>
                                                            <th> {{ __('Schedule') }}</th>
                                                            <th> {{ __('Date') }}</th>
                                                            <th> الحاله</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            
                                            <div class="justify-content-center d-flex">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
