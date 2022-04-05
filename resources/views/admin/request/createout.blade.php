@extends('layouts.admin')
@section('title','Out Patient')
@section('request_out','')
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
                                <li class="breadcrumb-item"><a href="{{route('admin.request.out')}}">  {{ __('Out Patient') }} </a>
                                </li>
                                <li class="breadcrumb-item active">{{ _('View') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">


    {{-- newwwwwwwwwwwwwwwwwwww --}}

                
<!-- Basic form layout section start -->
<section id="horizontal-form-layouts">
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
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                @include('admin.include.alerts.success')
                @include('admin.include.alerts.errors')
                <div class="card-content collapse show">
                    <div class="card-body">
                        
                        <form class="form form-horizontal" 
                        @if(isset($myorder->status_in_out) && $myorder->status_in_out != 4)
                            action="{{route('admin.request.update.out', $myorder->id)}}" method="POST" 
                        @endif
                            enctype="multipart/form-data">
                                @csrf

                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> البيانات الشخصية   </h4>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="user_id">
                                        {{ __('Full Name') }} 
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="fullname" readonly
                                        class="form-control"
                                        @if(isset($myorder->fullname))
                                             value="{{ $myorder->fullname }}"
                                        @endif
                                        placeholder="{{ __('Full Name') }}">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="name_caregiver">{{ __('Name Of Care Giver') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" id="name_caregiver" 
                                                class="form-control" readonly
                                                @if(isset($myorder->name_caregiver))
                                                    value="{{ $myorder->name_caregiver }}"
                                                @endif
                                                placeholder="{{ __('Name Of Care Giver') }}" >
                                        @error('name_caregiver')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="age">{{ __('Age') }}</label>
                                    <div class="col-md-2">
                                        <input type="number" id="age" 
                                            class="form-control"
                                            @if(isset($myorder->age))
                                                value="{{ $myorder->age }}"
                                                @else
                                                value="{{ old('age') }}"
                                            @endif
                                            placeholder="{{ __('Age') }}"
                                            name="age">
                                        @error('age')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <label class="col-md-2 label-control" for="age">{{ __('Gender') }}</label>
                                    <div class="col-md-2">
                                        <select name="gender" id="gender"
                                                class="form-control @error('gender') is-invalid @enderror">
                                            <option value="">{{ __('Gender') }}</option>
                                            @if(isset($myorder -> gender))
                                            <option value="1"
                                                    @if($myorder -> gender == "1") selected @endif >{{ __('Male') }}</option>
                                            <option value="2"
                                                    @if($myorder -> gender == "2") selected @endif >{{ __('Female') }}</option>
                                            @else
                                                <option value="1" @if(old('gender') == "1") selected @endif >{{ __('Male') }}</option>
                                                <option value="2" @if(old('gender') == "2") selected @endif >{{ __('Female') }}</option>
                                            @endif
                                        </select>
                                        @error('gender')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="medical_type_id">{{ __('Medical Type') }}</label>
                                    <div class="col-md-6">
                                        <select class="select2 form-control" name="medical_type_id" id="medical_type_id" >
                                            <option value="">-- {{ __('Medical Type') }} --</option>
                                            @foreach($medicalTypes as $medicalType)
                                                <option value="{{ $medicalType->id }}"
                                                        @if(isset($myorder->medical_type_id))
                                                            @if($myorder->medical_type_id == $medicalType->id) selected @endif 
                                                        @endif 
                                                        @if(old('medical_type_id') == $medicalType->id) selected @endif >
                                                    {{ $medicalType->getMyName()}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('medical_type_id')
                                            <span class="text-danger">{{$message}}</span>--}}
                                        @enderror
                                    </div>
                                </div>



                                <h4 class="form-section"><i class="ft-phone"></i> بيانات التواصل</h4>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="phone">{{ __('Phone') }}</label>
                                    <div class="col-md-2">
                                        <input type="text" id="phone" readonly
                                            class="form-control"
                                            @if(isset($myorder->phone))
                                            value="{{ $myorder->phone }}"
                                            @else
                                                value="{{ old('phone') }}"
                                            @endif
                                            placeholder="{{ __('Phone') }}" >
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox"  value="1" readonly
                                            id="whatapp" class="switchery0" data-color="success"
                                            @if (isset($myorder -> whatapp))
                                            @if($myorder -> whatapp  == 1 ) checked @endif
                                            @endif
                                            @if(old('whatapp') == 1) checked @endif />
                                        <label for="whatapp" class="card-title ml-1"> {{ __('Whatapp') }} </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="phone2">{{ __('Phone') }} 2</label>
                                    <div class="col-md-2">
                                        <input type="text" id="phone2"
                                            class="form-control"
                                            @if(isset($myorder->phone2))
                                            value="{{ $myorder->phone2 }}"
                                            @else
                                                value="{{ old('phone2') }}"
                                            @endif
                                            placeholder="{{ __('Phone') }}"
                                            name="phone2">
                                            @error('phone2')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox"  value="1" name="whatapp2"
                                            id="whatapp2" class="switchery0" data-color="success"
                                            @if (isset($myorder -> whatapp2))
                                            @if($myorder -> whatapp2  == 1 ) checked @endif
                                            @endif 
                                            @if(old('whatapp2') == 1) checked @endif />
                                        <label for="whatapp" class="card-title ml-1"> {{ __('Whatapp') }} </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="governorate_id">{{ __('Governorate') }}</label>
                                    <div class="col-md-6">
                                        <select name="governorate_id" id="governorate_id" 
                                                class="select2 form-control ">
                                            <option></option>
                                            @if($governorates)
                                                @foreach($governorates as $governorate)
                                                    <option value="{{$governorate->id}}"
                                                            @if(isset($myorder->governorate_id))
                                                                @if($myorder->governorate_id == $governorate->id) selected @endif 
                                                            @endif
                                                            @if(old('governorate_id') == $governorate->id) selected @endif >
                                                        @if(app()->getLocale() == 'ar')
                                                            {{$governorate->governorate_name_ar}}
                                                        @else
                                                            {{$governorate->governorate_name_en}}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="city_id">{{ __('Area') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" 
                                                @if(isset($myorder->city_id))
                                                value="{{$myorder->city_id }}" 
                                                @endif 
                                                id="city_id"
                                                class="form-control"
                                                placeholder="{{ __('Area') }}"
                                                name="city_id">
                                        @error('city_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="land_mark">{{ __('Land Mark') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" id="land_mark" 
                                                class="form-control"
                                                @if(isset($myorder->land_mark))
                                                value="{{ $myorder->land_mark }}"
                                                @else
                                                value="{{ old('land_mark') }}"
                                                @endif
                                                placeholder="{{ __('Land Mark') }}"
                                                name="land_mark">
                                        @error('land_mark')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="floor">{{ __('Floor') }}</label>
                                    <div class="col-md-2">
                                        <input type="text" id="floor" 
                                                class="form-control"
                                                @if(isset($myorder->floor))
                                                value="{{ $myorder->floor }}"
                                                @else
                                                value="{{ old('floor') }}"
                                                @endif
                                                placeholder="{{ __('Floor') }}"
                                                name="floor">
                                        @error('floor')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <label class="col-md-2 label-control" for="apartment">{{ __('Apartment') }}</label>
                                    <div class="col-md-2">
                                        <input type="text" id="apartment" 
                                                class="form-control"
                                                @if(isset($myorder->apartment))
                                                value="{{ $myorder->apartment }}"
                                                @else
                                                value="{{ old('apartment') }}"
                                                @endif
                                                placeholder="{{ __('Apartment') }}"
                                                name="apartment">
                                        @error('apartment')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="adress">{{ __('Address') }} CC</label>
                                    <div class="col-md-6">
                                        <input type="text" id="adress"
                                               class="form-control"
                                               @if(isset($myorder->adress))
                                               value="{{ $myorder->adress }}"
                                               @endif
                                               placeholder="{{ __('Address') }}"
                                               readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="adress2">{{ __('Address') }} </label>
                                    <div class="col-md-6">
                                        <input type="text" id="adress2"
                                               class="form-control"
                                               @if(isset($myorder->adress2))
                                                value="{{ $myorder->adress2 }}"
                                               @endif
                                               placeholder="{{ __('Address') }}"
                                               name="adress2">
                                        @error('adress2')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="location">{{ __('Location') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" id="location"
                                                class="form-control"
                                                @if(isset($myorder->location))
                                                value="{{ $myorder->location }}"
                                                @endif
                                                placeholder="{{ __('Location') }}"
                                                name="location">
                                        @error('location')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-paperclip"></i> بيانات الخدمه</h4>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="referral_id">{{ __('Referral') }}</label>
                                    <div class="col-md-6">
                                        <select class="select2 form-control" id="referral_id" disabled multiple>
                                            @foreach($referrals as $referral)
                                                <option value="{{ $referral['id'] }}"
                                                    @if (isset($usersReferrals))
                                                        @if(in_array($referral['id'], $usersReferrals)) selected @endif
                                                    @endif
                                                    @if(old('referral_id') == $referral['id']) selected @endif
                                                >{{ $referral['name']}}</option>
                                            @endforeach
                                        </select>
                                        @error('referral_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="corporate_id">{{ __('Corporate') }}</label>
                                    <div class="col-md-6">
                                        <select class="select2 form-control" id="corporate_id" name="corporate_id" disabled>
                                            <option value=""> -- {{ __('Select') }}  {{ __('Corporate') }} --</option>
                                            @foreach($companys as $company)
                                                <option value="{{ $company->id }}"
                                                    @if(isset($myorder->corporate_id))
                                                        @if($myorder->corporate_id == $company->id) selected @endif
                                                    @endif
                                                    @if(old('corporate_id') == $company->id) selected @endif
                                                >{{ $company->org_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('corporate_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="physician">{{ __('Physician') }}</label>
                                    <div class="col-md-4">
                                        <select class="select2 form-control" id="physician" name="physician">
                                            <option value="">-- {{ __('Select') }}  {{ __('Physician') }} --</option>
                                            @foreach($physicians as $physician)
                                                <option value="{{ $physician->id }}"
                                                    @if(isset($myorder->physician))
                                                        @if($myorder->physician == $physician->id) selected @endif
                                                    @endif
                                                    @if(old('physician') == $physician->id) selected @endif
                                                >{{ $physician->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('physician')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="physician" 
                                                class="form-control"
                                                placeholder="{{ __('Add') }} {{ __('Physician') }}"
                                                name="physician_new">
                                        @error('physician_new')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="ccAgent">{{ __('CC Agent') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" id="ccAgent"
                                            class="form-control" readonly
                                            @if(isset($myorder->cc_admin_id ))
                                            value="{{ \App\Models\Admin::getAdminNamebyId($myorder->cc_admin_id) }}"
                                            @endif
                                            placeholder="{{ __('CC Agent') }}"  >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="diagnose">{{ __('Diagnose') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" id="diagnose"
                                                class="form-control"
                                                @if(isset($myorder->diagnose))
                                                value="{{ $myorder->diagnose }}"
                                                @else
                                                value="{{ old('diagnose') }}"
                                                @endif
                                                placeholder="{{ __('Diagnose') }}"
                                                name="diagnose">
                                        @error('diagnose')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="code_zone_patient_id">{{ __('Code Zone Patient ID') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" id="code_zone_patient_id" class="form-control"
                                                @if(isset($myorder->code_zone_patient_id))
                                                value="{{ $myorder->code_zone_patient_id }}"
                                                @else
                                                value="{{ old('code_zone_patient_id') }}"
                                                @endif
                                                placeholder="{{ __('Code Zone Patient ID') }}"
                                                name="code_zone_patient_id">
                                        @error('code_zone_patient_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row"> 
                                    <label class="col-md-2 label-control" for="symptoms">{{ __('Symptoms') }}</label>
                                    <div class="col-md-6">
                                        <textarea id="symptoms" placeholder="{{ __('Symptoms') }}" 
                                                class="form-control" name="symptoms"
                                                >@if(isset($myorder->symptoms)){{ $myorder->symptoms }}@else {{ old('symptoms') }} @endif</textarea>
                                        @error('symptoms')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="feedback">{{ __('Feedback') }}</label>
                                    <div class="col-md-6">
                                        <textarea id="feedback" placeholder="{{ __('Feedback') }}" 
                                                class="form-control" name="feedback"
                                                >@if(isset($myorder->feedback)){{ $myorder->feedback }}@endif</textarea>
                                        @error('feedback')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="doc_note">{{ __('Doctor Notes') }}</label>
                                    <div class="col-md-6">
                                        <textarea id="doc_note" placeholder="{{ __('Doctor Notes') }}" 
                                                class="form-control" name="doc_note"
                                                >@if(isset($myorder->doc_note)){{ $myorder->doc_note }}@endif</textarea>
                                        @error('doc_note')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="opd_admin_id">{{ __('OPD') }}</label>
                                    <div class="col-md-6">
                                        <select class="select2 form-control" name="opd_admin_id" id="opd_admin_id">
                                            <option value=""></option>
                                            @foreach($opds as $opd)
                                                <option value="{{ $opd->id }}"
                                                        @if(isset($myorder->opd_admin_id))
                                                            @if($myorder->opd_admin_id == $opd->id) selected @endif @endif >
                                                    {{ $opd->name." [ ".$opd->email." ]"}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('opd_admin_id')
                                            <span class="text-danger">{{$message}}</span>--}}
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="opd2_admin_id">{{ __('OPD') }} 2</label>
                                    <div class="col-md-6">
                                        <select class="select2 form-control" name="opd2_admin_id" id="opd2_admin_id">
                                            <option value=""></option>
                                            @foreach($opds as $opd)
                                                <option value="{{ $opd->id }}"
                                                        @if(isset($myorder->opd2_admin_id))
                                                            @if($myorder->opd2_admin_id == $opd->id) selected @endif @endif >
                                                    {{ $opd->name." [ ".$opd->email." ]"}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('opd2_admin_id')
                                            <span class="text-danger">{{$message}}</span>--}}
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="specialty_id">{{ __('Specialty') }}</label>
                                    <div class="col-md-6">
                                        <select class="select2 form-control" id="specialty_id" name="specialty_id">
                                            <option value="">-- {{ __('Select') }} {{ __('Specialty') }} -- </option>
                                            {{-- <option value="2">222</option> --}}
                                            @foreach($specialtys as $specialty)
                                                <option value="{{ $specialty->id }}"
                                                    @if(isset($myorder->specialty_id))
                                                        @if($myorder->specialty_id == $specialty->id) selected @endif
                                                    @endif
                                                    @if(old('specialty_id') == $specialty->id) selected @endif
                                                >{{ $specialty->name_ar}}</option>
                                            @endforeach
                                        </select>
                                        @error('specialty_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="doctor_id">{{ __('CareHub Doctor') }}</label>
                                    <div class="col-md-6">
                                        <select class="select2 form-control" name="doctor_id" id="doctor_id">
                                            <option value="">{{ __('Choose Doctor Name') }}</option>
                                            @foreach($doctors as $doctor)
                                                <option value="{{ $doctor->id }}"
                                                        @if(isset($myorder->doctor_id))
                                                        @if($myorder->doctor_id == $doctor->id) selected @endif @endif >
                                                    {{ $doctor->username }} - {{ $doctor->getDocDegree($doctor->degree) }}</option>
                                            @endforeach
                                        </select>
                                        @error('doctor_id')
                                        <span class="text-danger">{{$message}}</span>--}}
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="nurse_id">{{ __('Nurse Name') }}</label>
                                    <div class="col-md-6">
                                        <select class="select2 form-control" name="nurse_id" id="nurse_id" >
                                            <option value="">{{ __('Choose Nurse Name') }}</option>
                                            @foreach($nurses as $nurse)
                                                <option value="{{ $nurse->id }}"
                                                        @if(isset($myorder->nurse_id))
                                                        @if($myorder->nurse_id == $nurse->id) selected @endif @endif >
                                                    {{ $nurse->username }}</option>
                                            @endforeach
                                        </select>
                                        @error('nurse_id')
                                        <span class="text-danger">{{$message}}</span>--}}
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="driver_id">{{ __('Driver Name') }}</label>
                                    <div class="col-md-6">
                                        <select class="select2 form-control" name="driver_id" id="driver_id" >
                                            <option value="">{{ __('Choose Driver Name') }}</option>
                                            @foreach($drivers as $driver)
                                                <option value="{{ $driver->id }}"
                                                        @if(isset($myorder->driver_id))
                                                        @if($myorder->driver_id == $driver->id) selected @endif @endif >
                                                    {{ $driver->username }}</option>
                                            @endforeach
                                        </select>
                                        @error('driver_id')
                                        <span class="text-danger">{{$message}}</span>--}}
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="reason_cancel">{{ __('Cancellation reasone') }}</label>
                                    <div class="col-md-6">
                                        <textarea id="reason_cancel" placeholder="{{ __('Cancellation reasone') }}" 
                                                class="form-control" name="reason_cancel"
                                                >@if(isset($myorder->reason_cancel)){{ $myorder->reason_cancel }}@endif</textarea>
                                        @error('reason_cancel')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="schedule_date">{{ __('Schedule') }}</label>
                                    <div class="col-md-6">
                                        <input type="date" id="schedule_date" class="form-control"
                                               @if(isset($myorder->schedule_date))
                                                    value="{{ $myorder->schedule_date }}"
                                                @else
                                                min="{{date('Y-m-d')}}" 
                                               @endif
                                               name = "schedule_date" value ="{{date('Y-m-d')}}" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="end_service_date">{{ __('End of Service Date') }}</label>
                                    <div class="col-md-6">
                                        <input type="date" id="end_service_date" class="form-control"
                                               @if(isset($myorder->end_service_date))
                                                    value="{{ $myorder->end_service_date }}"
                                               @endif
                                               @if(isset($myorder->schedule_date))
                                                    min="{{ $myorder->schedule_date }}"
                                               @endif
                                               name= "end_service_date"
                                               placeholder="{{ __('End of Service Date') }}" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="date_out">{{ __('Request End Date') }}</label>
                                    <div class="col-md-6">
                                        <input type="date" id="date_out" readonly class="form-control"
                                               @if(isset($myorder->date_out))
                                                    value="{{ $myorder->date_out }}"
                                               @endif
                                               placeholder="{{ __('Request End Date') }}" >
                                    </div>
                                </div>

                                <h4 class="form-section"><i class="ft-paperclip"></i> بيانات التكلفه</h4>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="real_cost">{{ __('Real Cost') }}</label>
                                    <div class="col-md-6">
                                        <input type="number" id="real_cost" class="form-control"
                                                @if(isset($myorder->real_cost))
                                                value="{{ $myorder->real_cost }}"
                                                @else
                                                value="{{ old('real_cost') }}"
                                                @endif
                                                placeholder="{{ __('Real Cost') }}"
                                                name="real_cost">
                                        @error('real_cost')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 label-control" for="bill_serial">{{ __('Bill Serial Number') }}</label>
                                    <div class="col-md-4">
                                        <input type="text" id="real_cost"
                                               class="form-control"
                                               @if(isset($myorder->bill_serial))
                                               value="{{ $myorder->bill_serial }}"
                                               @endif
                                               placeholder="{{ __('Bill Serial Number') }}"
                                               name="bill_serial">
                                        @error('bill_serial')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox"  value="1" name="pay_or_not"
                                               id="pay_or_not"
                                               class="switchery" data-color="success"

                                               @if($myorder->pay_or_not  == 1 ) checked @endif
                                        />
                                        <label for="pay_or_not"
                                               class="card-title ml-1">{{ __('Pay') }} </label>

                                        @error('pay_or_not')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            @if(isset($myorder->status_in_out) && $myorder->status_in_out != 4)
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                         {{ __('Save') }}
                                    </button>
                                </div>
                            @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Basic form layout section end -->

                <!-- Action section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"><b> <i class="ft-aperture"></i> {{ __('Actions') }} </b> </h4>
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
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                            <div class="form-body">

                                                @if(isset($myorder->status_in_out) && $myorder->status_in_out != 4)

                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="service_id">{{ __('Service') }}</label>
                                                            <select class="select2 form-control" name="service_id" id="service_id"> 
                                                                <option value="">-- {{ __('Select') }} {{ __('Service') }} --</option>
                                                                @foreach($serves as $serve)
                                                                    <option value="{{ $serve->id }}">{{ $serve->name_ar}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('service_id')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="action_price"> {{ __('Price') }} </label>
                                                            <input type="number" step="0.01" id="action_price" 
                                                                   class="form-control"
                                                                   placeholder="{{ __('Price') }} " readonly>
                                                            @error('price')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="state"> {{ __('Done') }} </label>
                                                            <select name="state" id="state" required
                                                                    class="form-control @error('state') is-invalid @enderror">
                                                                <option value="0" >{{ __('No') }}</option>
                                                                <option value="1" >{{ __('Yes') }}</option>
                                                            </select>
                                                            @error('state')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="action_date"> {{ __('Date') }} </label>
                                                            <input type="date" id="action_date"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Date') }} "
                                                                   {{-- value="{{ $datenaw }}" --}}
                                                                   name="action_date">
                                                            @error('action_date')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                   
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label style=" height: 49px;"> </label>
                                                            <button type="submit" class="btn btn-primary" name="btn" value="saveAndNew">
                                                                <i class="la la-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label style=" height: 49px;"> </label>
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                @endif
                                                
                                                    @if (isset($actions))
                                                    @if (count($actions) > 0)
                                                    <div class="row">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>{{ __('Service') }}</th>
                                                                    <th>{{ __('Price') }}</th>
                                                                    <th>{{ __('Take It') }}</th>
                                                                    <th>{{ __('Date') }}</th>
                                                                    <th> وقت الادخال</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($actions as $action)
                                                                <tr>
                                                                    <th><input type="checkbox" value="{{ $action->id }}" name="actionbox[]" /></th>
                                                                    <td>{{ \App\Models\Service::getName($action->service_id)  }}</td>
                                                                    <td>{{ $action->price }}</td>
                                                                    <td>{{ $action->getState($action->state) }}</td>
                                                                    <td>{{ $action->action_date }}</td>
                                                                    <td>{{ $action->created_at }}</td>
                                                                    <td>
                                                                        @if(isset($myorder->status_in_out) && $myorder->status_in_out != 4)
                                                                            <a href="{{route('admin.action.delete',$action->id)}}" class="btn btn-danger" ><i class="ft-trash-2"></i></a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>

                                                        @if(isset($myorder->status_in_out) && $myorder->status_in_out != 4)
                                                        <div class="form-actions">
                                               
                                                            <button type="submit" name="actionbtn" value="takeit" class="btn btn-success">
                                                                 {{ __('Take It') }}
                                                            </button>
                                                            <button type="submit" name="actionbtn" value="nottakeit" class="btn btn-warning">
                                                                 {{ __('Not Take It') }}
                                                            </button>
                                                            <button type="submit" name="actionbtn" value="delete" class="btn btn-danger">
                                                                <i class="ft-trash-2"></i> {{ __('Delete') }}
                                                            </button>
                
                                                        </div>
                                                        @endif

                                                    </div>
                                                    @endif
                                                    @endif
                                                
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {{-- section Action End --}}

                <!-- section Call start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"><b> <i class="ft-phone"></i> {{ __('Calls') }} </b> </h4>
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
                                <div class="card-content collapse">
                                    <div class="card-body">

                                            <div class="form-body">
                                                
                                                
                                                @if(isset($myorder->status_in_out) && $myorder->status_in_out != 4)
                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="time"> {{ __('Time') }} </label>
                                                            <input type="datetime-local" id="time"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Time') }} "
                                                                   {{-- value="{{ $datenaw }}" --}}
                                                                   name="time">
                                                            @error('time')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Note"> {{ __('Note') }} </label>
                                                            <textarea id="note" class="form-control" placeholder=" {{ __('Note') }}" 
                                                                name="note"></textarea>
                                                            @error('note')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                   
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label style=" height: 49px;"> </label>
                                                            <button type="submit" class="btn btn-primary" name="btn" value="saveAndNew">
                                                                <i class="la la-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label style=" height: 49px;"> </label>
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                @endif
                                                
                                                    @if (isset($calls))
                                                    @if (count($calls) > 0)
                                                    <div class="row">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th> الاجنت</th>
                                                                    <th>القسم</th>
                                                                    <th> وقت المكالمه</th>
                                                                    <th> ملحوظة</th>
                                                                    <th> وقت الادخال</th>
                                                                    <th> </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($calls as $call)
                                                                <tr>
                                                                    <td>{{ \App\Models\Admin::getAdminNamebyId($call->admin_id)  }}</td>
                                                                    <td>{{ \App\Models\RequestCall::getDepartment($call->department) }}</td>
                                                                    <td>{{ $call->call_time }}</td>
                                                                    <td>{{ $call->note }}</td>
                                                                    <td>{{ $call->created_at }}</td>
                                                                    <td>
                                                                        @if(isset($myorder->status_in_out) && $myorder->status_in_out != 4)
                                                                            <a href="{{route('admin.call.delete',$call->id)}}" class="btn btn-danger" ><i class="ft-trash-2"></i></a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @endif
                                                    @endif
                                                
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {{-- section Call End --}}

                @if(isset($myorder->status_in_out) && $myorder->status_in_out != 4)
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
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
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        <div class="form-actions">
                                               
                                            <button type="submit" name="btn" value="done" class="btn btn-success">
                                                {{ __('DONE') }}
                                            </button>

                                            <button type="submit" name="btn" value="hold" class="btn btn-warning">
                                                {{ __('Hold') }}
                                            </button>
                                            
                                            <button type="submit" name="btn" value="follow" class="btn btn-warning">
                                                {{ __('Following') }}
                                            </button>

                                            <button type="submit" name="btn" value="cancel" class="btn btn-danger">
                                                {{ __('Cancel') }}
                                            </button>

                                        </div>
                                           
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
                @endif
            </div>
        </div>
    </div>

@endsection

@section('script')

{{-- <script src="{{asset('assets/admin/vendors/js/forms/repeater/jquery.repeater.min.js')}}" type="text/javascript"></script> --}}
{{-- <script src="{{asset('assets/admin/js/scripts/forms/form-repeater.js')}}" type="text/javascript"></script> --}}

    <script>
        jQuery(document).ready(function ($) {

            // service Price
            $('#service_id').change(function () {
                let service_id = $("#service_id option:selected").val();
                let medical_type_id = $("#medical_type_id option:selected").val();
                let corporate_id = $("#corporate_id option:selected").val();
                let price_list_id= 0;
                // console.log(service_id);
                // console.log(medical_type_id);
                // console.log(corporate_id);
                // console.log(price_list_id);
                
                let _token = '{{ csrf_token() }}';
                $.ajax({
                    url: "{{ route('ajax.service.get.price') }}",
                    type: 'post',
                    dataType: 'json',
                    data:{
                        service_id :service_id,
                        medical_type_id :medical_type_id,
                        corporate_id :corporate_id,
                        price_list_id :price_list_id,
                        _token: _token
                    },
                    success: function (response) {
                        // console.log(response)
                        if(response == null){
                            console.log('Not Found');
                        }else {
                            $('#action_price').val(response.price);
                        }
                    }
                });
            });

            $('#user_id').change(function () {
                $.ajax({
                    url: '../../getUserInfo/' + $('#user_id').val(),
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response)
                        if(response == null){
                            console.log('Not Found');
                        }else {
                            $('#fullname').val(response.username);
                            if(response.address !== null){
                                $('#adress').val(response.address);
                            }
                            $('#phone').val(response.phone);
                            $('#phone2').val(response.mobile);
                            $('#gender').val(response.gender);
                            $('#code_zone_patient_id').val(response.code_zone_patient_id);
                            $('#governorate_id').val(response.governorate_id).change();
                            $('#city_id').val(response.city_id);
                            $('#land_mark').val(response.land_mark);
                            $('#floor').val(response.floor);
                            $('#apartment').val(response.apartment);
                            $('#whatapp').prop( "checked",(response.whatapp)? true : false );
                            $('#whatapp2').prop( "checked",(response.whatapp2)? true : false );
                            $('#referral_id').val(response.fname).change();
                        }
                    }
                    // error: function (xhr, ajaxOptions, thrownError) {
                    //     input.val(0);
                    // }
                });
            });

            // $('#governorate_id').change(function () {
            //     var govern = $('#governorate_id').val();
            //     if(govern !== null && govern !== ""){
            //         getCitySelect(govern);
            //     }
            // });

            // Physician
            function referralPhysician(){
                let phy = $('#physician').val();
                if(phy !== null && phy !== ""){
                    $('#physician_dev').hide();
                }else{
                    $('#physician_dev').show();
                }
            }
            referralPhysician();
            $('#physician').change(function () {
                referralPhysician();
            });
        });
    </script>
@endsection
