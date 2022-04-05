@extends('layouts.admin')
@section('title',__('Price List'))
@section('pricelist_cr','')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.pricelist')}}">  {{ __('Price List') }} </a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('Add') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">{{ __('Add') }}</h4>
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
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="{{route('admin.pricelist.store')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> البيانات   </h4>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="name">الاسم </label>
                                                    <div class="col-md-6">
                                                        <input type="text" value="" id="name"
                                                                class="form-control" required
                                                                placeholder="الاسم "
                                                                name="name">
                                                        @error('name')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="copy_from">{{ __('Copy From') }}</label>
                                                    <div class="col-md-6">
                                                        <select class="select2 form-control" name="copy_from">
                                                            <option value="">-- {{ __('Copy From') }} --</option>
                                                            @foreach($priceLists as $priceList)
                                                                <option value="{{ $priceList->id }}">
                                                                        {{ $priceList->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('copy_from')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="disabled">الحالة</label>
                                                    <div class="col-md-6">
                                                        <input type="checkbox" value="0" name="disabled" id="disabled"
                                                                class="switchery" data-color="success" checked/>
                                                        @error('disabled')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="main_pl">main</label>
                                                    <div class="col-md-6">
                                                        <input type="checkbox"  value="1" name="main_pl"
                                                                id="main_pl" class="switchery" data-color="success" />
                                                        @error('main_pl')
                                                            <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="form-actions">
                                                
                                                <a href="{{ route('admin.pricelist') }}" class="btn btn-warning">
                                                     تراجع
                                                </a>
                                                
                                                <button type="submit" class="btn btn-primary">
                                                     {{ __('Next') }}
                                                </button>

                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->

                
            </div>
        </div>
    </div>

@endsection
