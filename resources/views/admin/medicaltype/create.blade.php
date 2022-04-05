@extends('layouts.admin')
@section('title',__('Medical Type'))
@section('medicaltype_cr','')
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
                                <li class="breadcrumb-item"><a href="{{route('admin.medicaltype')}}">  {{ __('Medical Type') }} </a>
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة  تخصص </h4>
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
                                        <form class="form form-horizontal" action="{{route('admin.medicaltype.store')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> البيانات   </h4>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="name_ar">الاسم بالعربي</label>
                                                    <div class="col-md-6">
                                                        <input type="text" value="" id="name_ar"
                                                                class="form-control" required
                                                                placeholder="الاسم بالعربي"
                                                                name="name_ar">
                                                        @error('name_ar')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="name_en">الاسم بالانجليزي</label>
                                                    <div class="col-md-6">
                                                        <input type="text" value="" id="name_en"
                                                                class="form-control" required
                                                                placeholder="الاسم بالانجليزي  "
                                                                name="name_en">
                                                        @error('name_en')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="price_list_id">{{ __('Price List') }}</label>
                                                    <div class="col-md-6">
                                                        <select class="select2 form-control" name="price_list_id">
                                                            <option value="">-- {{ __('Price List') }} --</option>
                                                            @foreach($priceLists as $priceList)
                                                                <option value="{{ $priceList->id }}">
                                                                        {{ $priceList->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('price_list_id')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="disabled">الحالة</label>
                                                    <div class="col-md-6">
                                                        <input type="checkbox"  value="0" name="disabled"
                                                                id="disabled"
                                                                class="switchery" data-color="success"
                                                                checked/>
                                                        @error('disabled')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                              
                                            </div>


                                            <div class="form-actions">
                                                
                                                <a href="{{ route('admin.medicaltype') }}" class="btn btn-warning">
                                                     تراجع
                                                </a>
                                                
                                                <button type="submit" class="btn btn-primary" name="btn" value="saveAndNew">
                                                     حفظ و جديد
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                     حفظ
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
