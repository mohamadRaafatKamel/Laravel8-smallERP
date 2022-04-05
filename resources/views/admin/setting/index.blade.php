@extends('layouts.admin')
@section('title','الاعدادات')
@section('setting_view','')
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
                                <li class="breadcrumb-item active">الاعدادات
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
            @include('admin.include.alerts.success')
            @include('admin.include.alerts.errors')
                <!-- Social Media section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"></h4>
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
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.setting.update')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><span>{{ __('Social Media') }}</span> <i class="ft-home"></i></h4>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> FaceBook </label>
                                                            <input type="text" id="value"
                                                                   value="@if(isset($setting['FaceBook'])){{ $setting['FaceBook'] }}@endif"
                                                                   class="form-control"
                                                                   placeholder="FaceBook"
                                                                   name="value[FaceBook]">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Twitter </label>
                                                            <input type="text" id="value"
                                                                   value="@if(isset($setting['Twitter'])){{ $setting['Twitter'] }}@endif"
                                                                   class="form-control"
                                                                   placeholder="Twitter"
                                                                   name="value[Twitter]">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> LinkedIn </label>
                                                            <input type="text" id="value"
                                                                   value="@if(isset($setting['LinkedIn'])){{ $setting['LinkedIn'] }}@endif"
                                                                   class="form-control"
                                                                   placeholder="LinkedIn"
                                                                   name="value[LinkedIn]">
                                                        </div>
                                                    </div>


                                                </div>

                                            </div>


                                            <div class="form-actions">
                                                <button type="submit" value="socialMedia" name="btn" class="btn btn-primary">
                                                      {{ __('Save') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Social Media section end -->

                <!-- Slider Image section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"></h4>
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
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.setting.update')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><span>Slider Image</span> <i class="ft-home"></i></h4>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Slider Image 1 1920*948 </label>
                                                            <input type="file" value="" id="value"
                                                                   accept="image/*"
                                                                   class="form-control"
                                                                   name="sliderImage1">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Slider Image 2 1920*948 </label>
                                                            <input type="file" value="" id="value"
                                                                   class="form-control"
                                                                   accept="image/*"
                                                                   name="sliderImage2">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Slider Image 3 1920*948 </label>
                                                            <input type="file" value="" id="value"
                                                                   class="form-control"
                                                                   accept="image/*"
                                                                   name="sliderImage3">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" value="sliderImg" name="btn" class="btn btn-primary">
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Slider Image section end -->

                <!-- Social Media section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"></h4>
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
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.setting.update')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"> <i class="ft-home"></i> {{ __('Email') }} </h4>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="joinus"> {{ __('JoinUs') }} </label>
                                                            <input type="email" id="joinus"
                                                                   value="@if(isset($setting['JoinUs'])){{ $setting['JoinUs'] }}@endif"
                                                                   class="form-control"
                                                                   placeholder="JoinUs"
                                                                   name="value[JoinUs]">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="callcenter"> {{ __('CallCenter') }} </label>
                                                            <input type="email" id="callcenter"
                                                                   value="@if(isset($setting['CallCenter'])){{ $setting['CallCenter'] }}@endif"
                                                                   class="form-control"
                                                                   placeholder="CallCenter"
                                                                   name="value[CallCenter]">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="emergency"> {{ __('Emergency') }} </label>
                                                            <input type="email" id="emergency"
                                                                   value="@if(isset($setting['Emergency'])){{ $setting['Emergency'] }}@endif"
                                                                   class="form-control"
                                                                   placeholder="Emergency"
                                                                   name="value[Emergency]">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="inpatient"> {{ __('InPatient') }} </label>
                                                            <input type="email" id="inpatient"
                                                                   value="@if(isset($setting['InPatient'])){{ $setting['InPatient'] }}@endif"
                                                                   class="form-control"
                                                                   placeholder="InPatient"
                                                                   name="value[InPatient]">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="outpatient"> {{ __('OutPatient') }} </label>
                                                            <input type="email" id="outpatient"
                                                                   value="@if(isset($setting['OutPatient'])){{ $setting['OutPatient'] }}@endif"
                                                                   class="form-control"
                                                                   placeholder="OutPatient"
                                                                   name="value[OutPatient]">
                                                        </div>
                                                    </div>


                                                </div>

                                            </div>


                                            <div class="form-actions">
                                                <button type="submit" value="Links" name="btn" class="btn btn-primary">
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Social Media section end -->

            </div>
        </div>
    </div>

@endsection
