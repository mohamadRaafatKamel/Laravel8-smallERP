@extends('layouts.admin')
@section('title', __('In Patient') )
@section('request_in','')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">  {{ __('In Patient') }} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.request.in')}}">{{ __('In Patient') }}</a>
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
                                    <h4 class="card-title"> {{ __('In Patient') }} </h4>
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
                                        {{-- <a class="btn btn-primary mb-2" href="{{ route('admin.request.create.cc') }}"><i class="ft-plus"></i>&nbsp; {{ __('Create Order') }}</a> --}}
                                        <a class="btn btn-danger mb-2 mr15" href="{{ route('admin.request.in') }}"><i class="ft-refresh-cw"></i>&nbsp; {{ __('ReLoad') }}</a>
                                        
                                        <form class="form form-horizontal" action="{{route('admin.request.in')}}" method="GET" >
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
                                                        <th>{{ __('Name Of Care Giver') }}</th>
                                                        <th> موبيل</th>
                                                        <th>{{ __('Adress') }}</th>
                                                        <th>{{ __('Consultant') }}</th>
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
                                                                    <a href="{{route('admin.request.create.in',$request -> id )}}">
                                                                        {{$request -> id}}</a>
                                                                </td>
                                                                <td>
                                                                    @if($request -> user_id == null )
                                                                        {{__('Guest')}}
                                                                    @else
                                                                        <a href="{{route('admin.user.view',$request -> user_id)}}">
                                                                            {{\App\Models\User::getUserName($request -> user_id) }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>{{$request ->name_caregiver}} </td>
                                                                <td>{{$request ->phone}} <br/>{{$request ->phone2 }} </td>
                                                                <td>
                                                                    <?php 
                                                                        if(isset($request->apartment)) echo __('Apartment').": ".$request->apartment."<br/>"; 
                                                                        if(isset($request->floor)) echo __('Floor').": ".$request->floor."<br/>";
                                                                        if(isset($request->land_mark)) echo $request->land_mark."<br/>";
                                                                        if(isset($request->adress)) echo $request->adress."<br/>";
                                                                        if(isset($request->city_id)) echo $request->city_id."<br/>";
                                                                    ?>
                                                                </td>
                                                                <td>{{\App\Models\User::getDocName($request->doctor_id) }}</td>
                                                                <td>{{$request ->schedule_date}}</td>
                                                                <td>{{$request ->created_at}}</td>
                                                                <td>
                                                                    <span class="badge {{ \App\Models\Requests::getStateColor($request ->status_in_out) }}">
                                                                        {{ \App\Models\Requests::getRequestState($request -> status_in_out) }}
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
                                                            <th>{{ __('Name Of Care Giver') }}</th>
                                                            <th> موبيل</th>
                                                            <th>{{ __('Adress') }}</th>
                                                            <th>{{ __('Consultant') }}</th>
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
