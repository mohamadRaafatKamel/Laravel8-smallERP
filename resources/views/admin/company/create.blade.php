@extends('layouts.admin')
@section('title',__('Company'))
@section('company_cr','')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{ __('Home') }} </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.company')}}">  {{ __('Company') }} </a>
                                </li>
                                <li class="breadcrumb-item active"> {{ __('Add Company') }} 
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
                                    <h4 class="card-title" id="basic-layout-form"> {{ __('Add Company') }}  </h4>
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
                                        <form class="form" action="{{route('admin.company.store')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> البيانات   </h4>

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="org_name"> الاسم  </label>
                                                            <input type="text"  id="org_name"
                                                                   class="form-control" required
                                                                   placeholder="الاسم "
                                                                   name="org_name">
                                                            @error('org_name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email"> {{ __('Email') }} </label>
                                                            <input type="email"  id="email"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Email') }}"
                                                                   name="email">
                                                            @error('email')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone"> {{ __('Phone') }} </label>
                                                            <input type="text"  id="phone"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Phone') }}"
                                                                   name="phone">
                                                            @error('phone')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="website"> {{ __('WebSite') }} </label>
                                                            <input type="text"  id="website"
                                                                   class="form-control"
                                                                   placeholder="{{ __('WebSite') }}"
                                                                   name="website">
                                                            @error('website')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="contact_person_name"> {{ __('Contact Person Name') }} </label>
                                                            <input type="contact_person_name"  id="contact_person_name"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Contact Person Name') }}"
                                                                   name="contact_person_name">
                                                            @error('contact_person_name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="registration_num"> {{ __('Registration Number') }} </label>
                                                            <input type="registration_num"  id="registration_num"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Registration Number') }}"
                                                                   name="registration_num">
                                                            @error('registration_num')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tax_certificate_num"> {{ __('Tax Certificate Number') }} </label>
                                                            <input type="tax_certificate_num"  id="tax_certificate_num"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Tax Certificate Number') }}"
                                                                   name="tax_certificate_num">
                                                            @error('tax_certificate_num')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="type"> {{ __('Type') }} </label>
                                                            <select name="type" class="form-control" id="type" required>
                                                                <option value="1">تامين</option>
                                                                <option value="9">{{ __("other") }}</option>
                                                            </select>
                                                            @error('type')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="pay"> {{ __('Pay') }} </label>
                                                            <select name="pay" class="form-control" id="pay" required>
                                                                <option value="1">{{ __('Later') }}</option>
                                                                <option value="2">{{ __("Cash") }}</option>
                                                            </select>
                                                            @error('pay')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="description"> وصف </label>
                                                            <textarea id="description" class="form-control" placeholder="وصف" 
                                                                name="description"></textarea>
                                                            @error('description')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
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

                                            </div>


                                            <div class="form-actions">
                                                
                                                <a href="{{ route('admin.company') }}" class="btn btn-warning">
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
