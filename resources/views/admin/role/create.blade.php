@extends('layouts.admin')
@section('title','الصلاحيات')
@section('role_cr','')
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
                                <li class="breadcrumb-item"><a href="{{route('admin.role')}}"> الصلاحيات </a>
                                </li>
                                <li class="breadcrumb-item active">إضافة الصلاحيات
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة الصلاحيات </h4>
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
                                        <form class="form" action="{{route('admin.role.store')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> البيانات   </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاسم </label>
                                                            <input type="text" value="" id="name"
                                                                   class="form-control"
                                                                   placeholder=" الاسم" required
                                                                   name="name">
                                                            @error('name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <label><strong> {{ __('Request') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="request_all" name="role_info[]"
                                                                   id="request_all"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="request_all"
                                                                   class="card-title ml-1">{{ __('All Request') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="request_emergency" name="role_info[]"
                                                                   id="request_emergency"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="request_emergency"
                                                                   class="card-title ml-1">{{ __('All Emergency') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="request_out" name="role_info[]"
                                                                   id="request_out"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="request_out"
                                                                   class="card-title ml-1">{{ __('All OutPatient') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="request_in" name="role_info[]"
                                                                   id="request_in"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="request_in"
                                                                   class="card-title ml-1">{{ __('All InPatient') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="request_lab" name="role_info[]"
                                                                   id="request_lab" 
                                                                   class="switchery" data-color="success"/>
                                                            <label for="request_lab"
                                                                   class="card-title ml-1">{{ __('Lab') }} </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label><strong> {{ __('Users') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="user_all" name="role_info[]"
                                                                   id="user_all"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="user_all"
                                                                   class="card-title ml-1">{{ __('All User') }} </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="user_patent" name="role_info[]"
                                                                   id="user_patent"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="user_patent"
                                                                   class="card-title ml-1">{{ __('All Patent') }} </label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <label><strong> {{ __('Stuff') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="user_doctor" name="role_info[]"
                                                                   id="user_doctor"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="user_doctor"
                                                                   class="card-title ml-1">{{ __('All Doctor') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="user_nurse" name="role_info[]"
                                                                   id="user_nurse"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="user_nurse"
                                                                   class="card-title ml-1">{{ __('All Nurse') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="user_driver" name="role_info[]"
                                                                   id="user_driver"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="user_driver"
                                                                   class="card-title ml-1">{{ __('All Driver') }} </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label><strong> التخصصات </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="specialty_view" name="role_info[]"
                                                                   id="specialty_view"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="specialty_view"
                                                                   class="card-title ml-1">عرض </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="specialty_cr" name="role_info[]"
                                                                   id="specialty_cr"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="specialty_cr"
                                                                   class="card-title ml-1">انشاء </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="specialty_idt" name="role_info[]"
                                                                   id="specialty_idt"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="specialty_idt"
                                                                   class="card-title ml-1">تعديل </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label><strong> {{ __('Serves') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="serves_view" name="role_info[]"
                                                                   id="serves_view"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="serves_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="serves_cr" name="role_info[]"
                                                                   id="serves_cr"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="serves_cr"
                                                                   class="card-title ml-1">{{ __('Create') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="serves_idt" name="role_info[]"
                                                                   id="serves_idt"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="serves_idt"
                                                                   class="card-title ml-1">{{ __('Edit') }} </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label><strong> {{ __('Survey') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="survey_view" name="role_info[]"
                                                                   id="survey_view"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="survey_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label><strong> {{ __('Company') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="company_view" name="role_info[]"
                                                                   id="company_view"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="company_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="company_cr" name="role_info[]"
                                                                   id="company_cr"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="company_cr"
                                                                   class="card-title ml-1">{{ __('Create') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="company_idt" name="role_info[]"
                                                                   id="company_idt"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="company_idt"
                                                                   class="card-title ml-1">{{ __('Edit') }} </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label><strong> {{ __('Package') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="package_view" name="role_info[]"
                                                                   id="package_view"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="package_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="package_cr" name="role_info[]"
                                                                   id="package_cr"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="package_cr"
                                                                   class="card-title ml-1">{{ __('Create') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="package_idt" name="role_info[]"
                                                                   id="package_idt"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="package_idt"
                                                                   class="card-title ml-1">{{ __('Edit') }} </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label><strong> {{ __('Physician') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="physician_view" name="role_info[]"
                                                                   id="physician_view" 
                                                                   class="switchery" data-color="success"/>
                                                            <label for="physician_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="physician_cr" name="role_info[]"
                                                                   id="physician_cr" 
                                                                   class="switchery" data-color="success"/>
                                                            <label for="physician_cr"
                                                                   class="card-title ml-1">{{ __('Create') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="physician_idt" name="role_info[]"
                                                                   id="physician_idt" 
                                                                   class="switchery" data-color="success"/>
                                                            <label for="physician_idt"
                                                                   class="card-title ml-1">{{ __('Edit') }} </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label><strong> {{ __('Referral') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="referral_view" name="role_info[]"
                                                                   id="referral_view"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="referral_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="referral_cr" name="role_info[]"
                                                                   id="referral_cr"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="referral_cr"
                                                                   class="card-title ml-1">{{ __('Create') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="referral_idt" name="role_info[]"
                                                                   id="referral_idt"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="referral_idt"
                                                                   class="card-title ml-1">{{ __('Edit') }} </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label><strong> {{ __('Referral Category') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="referral_cat" name="role_info[]"
                                                                   id="referral_cat"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="referral_cat" 
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="referral_cat_del" name="role_info[]"
                                                                   id="referral_cat_del" 
                                                                   class="switchery" data-color="danger"/>
                                                            <label for="referral_cat_del" 
                                                                   class="card-title ml-1">مسح الاقسام  و مصادر التحويل الخاصه بيه </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label><strong> {{ __('Admin') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="admin_view" name="role_info[]"
                                                                   id="admin_view"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="admin_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="admin_cr" name="role_info[]"
                                                                   id="admin_cr"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="admin_cr"
                                                                   class="card-title ml-1">{{ __('Create') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="admin_idt" name="role_info[]"
                                                                   id="admin_idt"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="admin_idt"
                                                                   class="card-title ml-1">{{ __('Edit') }} </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label><strong> {{ __('Permission') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="role_view" name="role_info[]"
                                                                   id="role_view"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="role_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="role_cr" name="role_info[]"
                                                                   id="role_cr"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="role_cr"
                                                                   class="card-title ml-1">{{ __('Create') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="role_idt" name="role_info[]"
                                                                   id="role_idt"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="role_idt"
                                                                   class="card-title ml-1">{{ __('Edit') }} </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label><strong> {{ __('Report') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="report_view" name="role_info[]"
                                                                   id="report_view"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="report_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <label><strong> {{ __('Setting') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="setting_view" name="role_info[]"
                                                                   id="setting_view"
                                                                   class="switchery" data-color="success"/>
                                                            <label for="setting_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    
                                                </div>




                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                     تراجع
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
