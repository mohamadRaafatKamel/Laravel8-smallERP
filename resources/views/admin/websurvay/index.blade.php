@extends('layouts.admin')
@section('title','التقييم')
@section('survey_view','')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">  التقييم </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">  التقييم
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
                                    <h4 class="card-title"> كل  التقييم </h4>
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
                                        <div class="table-responsive">
                                        <table
                                            class="table table-striped table-bordered ordering-print ">
                                            <thead>
                                            <tr>
                                                <th>User </th>
                                                <th>اسم </th>
                                                <th> {{ __('Phone') }}</th>
                                                <th>  {{ __('Age') }} </th>
                                                <th> رائيك </th>
                                                <th> تعرف </th>
                                                <th> جربت </th>
                                                <th> {{ __('Note') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($datas)
                                                @foreach($datas as $data)
                                                    <tr>
                                                        <td>
                                                            @if($data -> user_id == null )
                                                                {{__('Guest')}}
                                                            @else
                                                                <a href="{{route('admin.user.view',$data -> user_id)}}">
                                                                    {{\App\Models\User::getUserName($data -> user_id) }}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>{{$data -> name}}</td>
                                                        <td>{{$data -> phone}}</td>
                                                        <td>{{\App\Models\WebSurvay::getAge($data -> age)}}</td>
                                                        <td>{{\App\Models\WebSurvay::getOpinion($data -> opinion_carehub)}}</td>
                                                        <td>{{\App\Models\WebSurvay::getYesorNo($data -> know_carehub)}}</td>
                                                        <td>{{\App\Models\WebSurvay::getYesorNo($data -> try_carehub)}}</td>
                                                        <td>{{$data -> note}}</td>
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        </div>
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
