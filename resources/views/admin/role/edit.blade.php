@extends('layouts.admin')
@section('title','تعديل')
@section('role_view','')
@section('content')
<?php 
if(! $permissoin = \App\Models\Role::havePremission(['role_idt']))
    $readonly="readonly";
else 
    $readonly="";
?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{ __('Home') }} </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.role')}}"> الصلاحيات </a>
                                </li>
                                <li class="breadcrumb-item active">تعديل الصلاحيات
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
                                    <h4 class="card-title" id="basic-layout-form">تعديل</h4>
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
                                        <form class="form" action="{{route('admin.role.update',$role -> id)}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> البيانات   </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاسم </label>
                                                            <input type="text" value="{{ $role->name }}" id="name" {{ $readonly }}
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
                                                                   id="request_all" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['request_all']) and $myRoleInfo['request_all'] == '1')
                                                                       checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="request_all"
                                                                   class="card-title ml-1">{{ __('All Request') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="request_emergency" name="role_info[]"
                                                                   id="request_emergency" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['request_emergency']) and $myRoleInfo['request_emergency'] == '1')
                                                                       checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="request_emergency"
                                                                   class="card-title ml-1">{{ __('All Emergency') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="request_out" name="role_info[]"
                                                                   id="request_out" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['request_out']) and $myRoleInfo['request_out'] == '1')
                                                                       checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="request_out"
                                                                   class="card-title ml-1">{{ __('All OutPatient') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="request_in" name="role_info[]"
                                                                   id="request_in" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['request_in']) and $myRoleInfo['request_in'] == '1')
                                                                       checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="request_in"
                                                                   class="card-title ml-1">{{ __('All InPatient') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="request_lab" name="role_info[]"
                                                                   id="request_lab" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['request_lab']) and $myRoleInfo['request_lab'] == '1')
                                                                       checked
                                                                   @endif
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
                                                                   id="user_all" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['user_all']) and $myRoleInfo['user_all'] == '1')
                                                                       checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="user_all"
                                                                   class="card-title ml-1">{{ __('All User') }} </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="user_patent" name="role_info[]"
                                                                   id="user_patent" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['user_patent']) and $myRoleInfo['user_patent'] == '1')
                                                                       checked
                                                                   @endif
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
                                                                   id="user_doctor" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['user_doctor']) and $myRoleInfo['user_doctor'] == '1')
                                                                       checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="user_doctor"
                                                                   class="card-title ml-1">{{ __('All Doctor') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="user_nurse" name="role_info[]"
                                                                   id="user_nurse" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['user_nurse']) and $myRoleInfo['user_nurse'] == '1')
                                                                       checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="user_nurse"
                                                                   class="card-title ml-1">{{ __('All Nurse') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="user_driver" name="role_info[]"
                                                                   id="user_driver" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['user_driver']) and $myRoleInfo['user_driver'] == '1')
                                                                       checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="user_driver"
                                                                   class="card-title ml-1">{{ __('All Driver') }} </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <h4>التخصصات</h4>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="specialty_view" name="role_info[]"
                                                                   id="specialty_view" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['specialty_view']) and $myRoleInfo['specialty_view'] == '1')
                                                                       checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="specialty_view"
                                                                   class="card-title ml-1">عرض </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="specialty_cr" name="role_info[]"
                                                                   id="specialty_cr" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['specialty_cr']) and $myRoleInfo['specialty_cr'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="specialty_cr"
                                                                   class="card-title ml-1">انشاء </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="specialty_idt" name="role_info[]"
                                                                   id="specialty_idt" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['specialty_idt']) and $myRoleInfo['specialty_idt'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="specialty_idt"
                                                                   class="card-title ml-1">تعديل </label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <h4>{{ __('Serves') }}</h4>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="serves_view" name="role_info[]"
                                                                   id="serves_view" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['serves_view']) and $myRoleInfo['serves_view'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="serves_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="serves_cr" name="role_info[]"
                                                                   id="serves_cr" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['serves_cr']) and $myRoleInfo['serves_cr'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="serves_cr"
                                                                   class="card-title ml-1">{{ __('Create') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="serves_idt" name="role_info[]"
                                                                   id="serves_idt" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['serves_idt']) and $myRoleInfo['serves_idt'] == 1)
                                                                   checked
                                                                   @endif
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
                                                                   id="survey_view" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['survey_view']) and $myRoleInfo['survey_view'] == 1)
                                                                   checked
                                                                   @endif
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
                                                                   id="company_view" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['company_view']) and $myRoleInfo['company_view'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="company_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="company_cr" name="role_info[]"
                                                                   id="company_cr" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['company_cr']) and $myRoleInfo['company_cr'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="company_cr"
                                                                   class="card-title ml-1">{{ __('Create') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="company_idt" name="role_info[]"
                                                                   id="company_idt" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['company_idt']) and $myRoleInfo['company_idt'] == 1)
                                                                   checked
                                                                   @endif
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
                                                                   id="package_view" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['package_view']) and $myRoleInfo['package_view'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="package_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="package_cr" name="role_info[]"
                                                                   id="package_cr" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['package_cr']) and $myRoleInfo['package_cr'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="package_cr"
                                                                   class="card-title ml-1">{{ __('Create') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="package_idt" name="role_info[]"
                                                                   id="package_idt" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['package_idt']) and $myRoleInfo['package_idt'] == 1)
                                                                   checked
                                                                   @endif
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
                                                                   id="physician_view" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['physician_view']) and $myRoleInfo['physician_view'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="physician_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="physician_cr" name="role_info[]"
                                                                   id="physician_cr" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['physician_cr']) and $myRoleInfo['physician_cr'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="physician_cr"
                                                                   class="card-title ml-1">{{ __('Create') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="physician_idt" name="role_info[]"
                                                                   id="physician_idt" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['physician_idt']) and $myRoleInfo['physician_idt'] == 1)
                                                                   checked
                                                                   @endif
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
                                                                   id="referral_view" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['referral_view']) and $myRoleInfo['referral_view'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="referral_view" 
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="referral_cr" name="role_info[]"
                                                                   id="referral_cr" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['referral_cr']) and $myRoleInfo['referral_cr'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="referral_cr" 
                                                                   class="card-title ml-1">{{ __('Create') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="referral_idt" name="role_info[]"
                                                                   id="referral_idt" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['referral_idt']) and $myRoleInfo['referral_idt'] == 1)
                                                                   checked
                                                                   @endif
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
                                                                   id="referral_cat" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['referral_cat']) and $myRoleInfo['referral_cat'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="referral_cat" 
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="referral_cat_del" name="role_info[]"
                                                                   id="referral_cat_del" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['referral_cat_del']) and $myRoleInfo['referral_cat_del'] == 1)
                                                                   checked
                                                                   @endif
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
                                                                   id="admin_view" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['admin_view']) and $myRoleInfo['admin_view'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="admin_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="admin_cr" name="role_info[]"
                                                                   id="admin_cr" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['admin_cr']) and $myRoleInfo['admin_cr'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="admin_cr"
                                                                   class="card-title ml-1">{{ __('Create') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="admin_idt" name="role_info[]"
                                                                   id="admin_idt" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['admin_idt']) and $myRoleInfo['admin_idt'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="admin_idt"
                                                                   class="card-title ml-1">{{ __('Edit and Delete') }} </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label><strong> {{ __('Permission') }} </strong></label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="role_view" name="role_info[]"
                                                                   id="role_view" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['role_view']) and $myRoleInfo['role_view'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="role_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="role_cr" name="role_info[]"
                                                                   id="role_cr" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['role_cr']) and $myRoleInfo['role_cr'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="role_cr"
                                                                   class="card-title ml-1">{{ __('Create') }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="role_idt" name="role_info[]"
                                                                   id="role_idt" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['role_idt']) and $myRoleInfo['role_idt'] == 1)
                                                                   checked
                                                                   @endif
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
                                                                   id="report_view" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['report_view']) and $myRoleInfo['report_view'] == 1)
                                                                   checked
                                                                   @endif
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
                                                                   id="setting_view" {{ $readonly }}
                                                                   @if(isset($myRoleInfo['setting_view']) and $myRoleInfo['setting_view'] == 1)
                                                                   checked
                                                                   @endif
                                                                   class="switchery" data-color="success"/>
                                                            <label for="setting_view"
                                                                   class="card-title ml-1">{{ __('View') }} </label>
                                                        </div>
                                                    </div>
                                                    
                                                </div>


                                            </div>
                                            @if ($permissoin)
                                                <div class="form-actions">
                                                    <button type="button" class="btn btn-warning mr-1"
                                                            onclick="history.back();">
                                                         تراجع
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                         تحديث
                                                    </button>
                                                </div>
                                            @endif
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
