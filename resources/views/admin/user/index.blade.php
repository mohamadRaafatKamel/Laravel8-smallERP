@extends('layouts.admin')
@section('title',__($info['name']))
@section($info["sidename"],'')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">  {{ __($info['name']) }} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                @if($info['type'] != '0')
                                    <li class="breadcrumb-item"><a href="{{route('admin.user')}}">{{ __('All User') }}</a>
                                    <li class="breadcrumb-item active">  {{ __($info['name']) }}
                                @else
                                    <li class="breadcrumb-item active">  {{ __($info['name']) }}
                                @endif
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
                                    <h4 class="card-title">{{ __($info['name'])}} </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('admin.include.alerts.success')
                                @include('admin.include.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <a class="btn btn-primary mb-2" href="{{ route('admin.user.create') }}"><i class="ft-plus"></i>&nbsp; {{ __('New') }}</a>
                                        <table
                                            class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>{{ __('Name') }} </th>
                                                {{-- <th> {{ __('UserName') }} </th> --}}
                                                <th> موبيل  </th>
                                                <th>{{ __('Acquisition') }}   </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($users)
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td><a href="{{route('admin.user.view',$user -> id)}}">
                                                            {{$user -> username}}
                                                            </a></td>
                                                        {{-- <td>{{$user -> username}}</td> --}}
                                                        <td>{{$user -> phone }}</td>
                                                        <td>{{ __(\App\Models\User::getUserType($user -> type) )}}</td>
                                                        
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

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
