@extends('layouts.admin')
@section('title',__('Price List'))
@section('pricelist_view','')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> {{ __('Price List') }} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">  {{ __('Price List') }}
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
                                    <h4 class="card-title"> {{ __('Price List') }} </h4>
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
                                        @if(\App\Models\Role::havePremission(['pricelist_cr']))
                                            <a class="btn btn-primary mb-2 mr15" href="{{ route('admin.pricelist.create') }}"><i class="ft-plus"></i>&nbsp; {{ __('Create') }}</a>
                                            <a class="btn btn-primary mb-2 mr15" href="{{ route('admin.pricelist.import') }}"><i class="ft-plus"></i>&nbsp; {{ __('Import') }}</a>
                                        @endif
                                        @if (\App\Models\PriceList::where('main_pl','1')->count() == 0)
                                            <p class="text-center warning">Please Select mean PriceList </p>
                                        @endif
                                        
                                        <table
                                            class="table table-striped table-bordered ordering-print ">
                                            <thead>
                                            <tr>
                                                <th>ID </th>
                                                <th>اسم </th>
                                                <th>الحالة</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($datas)
                                                @foreach($datas as $data)
                                                    <tr>
                                                        @if(\App\Models\Role::havePremission(['pricelist_idt']))
                                                            <td><a href="{{route('admin.pricelist.edit',['id'=> $data->id ])}}">{{$data -> id}}</a></td>
                                                        @else
                                                            <td>{{$data -> id}}</td>
                                                        @endif
                                                        <td @if ($data->main_pl == 1) style="color: red;" @endif>{{$data -> name}}</td>
                                                        <td>{{$data -> getActive()}}</td>
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>

                                            <tfoot>
                                                <th>ID </th>
                                                <th>اسم </th>
                                                <th>الحالة</th>
                                            </tfoot>
                                        </table>
                                        
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
