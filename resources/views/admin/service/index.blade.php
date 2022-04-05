@extends('layouts.admin')
@section('title','الخدمات')
@section('serves_view','')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">  الخدمات </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">  الخدمات
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
                                    <h4 class="card-title"> كل  الخدمات </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                                        @if(\App\Models\Role::havePremission(['serves_cr']))
                                        <a class="btn btn-primary mb-2 mr15" href="{{ route('admin.service.create') }}"><i class="ft-plus"></i>&nbsp; {{ __('Create') }}</a>
                                        {{-- <a class="btn btn-primary mb-2 mr15" href="{{ route('admin.service.import') }}"><i class="ft-plus"></i>&nbsp; {{ __('Import') }}</a> --}}
                                        @endif
                                        <div class="table-responsive">
                                        <table
                                            class="table table-striped table-bordered ordering-print">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th> اسم انجليزي</th>
                                                <th>اسم عربي</th>
                                                <th>  وصف </th>
                                                <th> {{ __('Type') }}</th>
                                                <th> صوره</th>
                                                <th>الحالة</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($datas)
                                                @foreach($datas as $data)
                                                    <tr>
                                                        <td>
                                                            <a href="{{route('admin.service.edit',['id'=> $data->id ])}}" >{{$data ->id}}</a>
                                                        </td>
                                                        <td>{{$data ->name_en}}</td>
                                                        <td>{{$data ->name_ar}}</td>
                                                        <td>{{$data ->description}}</td>
                                                        <td>{{$data ->getMyType() }}</td>
                                                        <td>
                                                            @if($data -> image != null)
                                                                <img width="50px" height="50px" src="../{{$data -> image}}">
                                                            @else
                                                                No Image
                                                            @endif
                                                        </td>
                                                        <td>{{$data -> getActive()}}</td>
                                                        
                                                    </tr>
                                                @endforeach
                                            @endisset
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th> اسم انجليزي</th>
                                                    <th>اسم عربي</th>
                                                    <th>  وصف </th>
                                                    <th> {{ __('Type') }}</th>
                                                    <th> صوره</th>
                                                    <th>الحالة</th>
                                                </tr>
                                              </tfoot>
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
