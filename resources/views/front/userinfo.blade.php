@extends('layouts.site')

@section('title', __('Register'))

@section('header')
    <style>
        .single-page .site-header {
            padding: 85px;
            background-color: #fff;
        }
    </style>
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12" style="margin-top: -82px;">
{{--                @include('admin.include.alerts.success')--}}
{{--                @include('admin.include.alerts.errors')--}}
                <div class="services-tabs">
                    <div class="tabs">
                        <ul class="tabs-nav d-flex flex-wrap justify-content-center">
                            <li class="tab-nav d-flex justify-content-center align-items-center"
                                style="border-radius:50px" data-target="#tab_1">{{ __('General Info') }}</li>
                            <li class="tab-nav d-flex justify-content-center align-items-center"
                                style="border-radius:50px" data-target="#tab_2">{{ __('Contact Info') }}</li>
{{--                            <li class="tab-nav d-flex justify-content-center align-items-center"--}}
{{--                                style="border-radius:50px" data-target="#tab_3">{{ __('Edit Password') }}</li>--}}
                            <li class="tab-nav d-flex justify-content-center align-items-center"
                                style="border-radius:50px" data-target="#tab_4">{{ __('Account Receiver') }}</li>
                            @if($user->type == '2')
                                <li class="tab-nav d-flex justify-content-center align-items-center"
                                    style="border-radius:50px" data-target="#tab_5">{{ __('Doctor Info') }}</li>
                                <li class="tab-nav d-flex justify-content-center align-items-center"
                                    style="border-radius:50px" data-target="#tab_7">{{ __('Times Of Work') }}</li>
                            @endif
                            @if($user->type == '3')
                                <li class="tab-nav d-flex justify-content-center align-items-center"
                                    style="border-radius:50px" data-target="#tab_6">{{ __('Company Info') }}</li>
                            @endif
                        </ul>

                        <div class="tabs-container">
                            {{--                            Emergency Call --}}
                            <div id="tab_1" class="tab-content">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header text-center"><h2>{{ __('General Info') }}</h2></div>

                                            <div class="card-body">
                                                <form method="POST"
                                                      action="{{ route('home.myuser.info.update',app()->getLocale()) }}">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <label for="fname"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Frist Name') }}
                                                        </label>
                                                        <div class="col-md-6">
                                                            <input id="fname" type="text"
                                                                   class="form-control @error('fname') is-invalid @enderror"
                                                                   name="fname"
                                                                   value="{{ $user->fname }}" required
                                                                   autocomplete="fname" autofocus>

                                                            @error('fname')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="lname"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="lname" type="text"
                                                                   class="form-control @error('lname') is-invalid @enderror"
                                                                   name="lname"
                                                                   value="{{$user->lname }}" required
                                                                   autocomplete="name" autofocus>

                                                            @error('lname')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="gender"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                                                        <div class="col-md-6">
                                                            <select name="title" id="title"
                                                                    class="form-control @error('title') is-invalid @enderror"
                                                                    required>
                                                                <option></option>
                                                                <option value="Mr"
                                                                        @if($user->title == "Mr") selected @endif>{{ __('Mr') }}</option>
                                                                <option value="Mrs"
                                                                        @if($user->title == "Mrs") selected @endif>{{ __('Mrs') }}</option>
                                                                <option value="Dr"
                                                                        @if($user->title == "Dr") selected @endif>{{ __('Dr') }}</option>
                                                            </select>
                                                            @error('title')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="username"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('UserName') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="username" type="text"
                                                                   class="form-control @error('username') is-invalid @enderror"
                                                                   name="username"
                                                                   value="{{ $user->username }}" required
                                                                   autocomplete="username" autofocus>

                                                            @error('username')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="gender"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                                        <div class="col-md-6">
                                                            <select name="gender" id="phone"
                                                                    class="form-control @error('gender') is-invalid @enderror">
                                                                <option value="1"
                                                                        @if($user->gender == "1") selected @endif>{{ __('Male') }}</option>
                                                                <option value="2"
                                                                        @if($user->gender == "2") selected @endif>{{ __('Female') }}</option>
                                                            </select>
                                                            @error('gender')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="birth_date"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Nationality') }}</label>
                                                        <div class="col-md-6">
                                                            <select name="nationality_code" id="nationality_code"
                                                                    class="form-control @error('nationality_code') is-invalid @enderror" >
                                                                <option></option>
                                                                @if($countrys)
                                                                    @foreach($countrys as $country)
                                                                        <option value="{{$country->country_code}}"
                                                                                @if($country->country_code == $user->nationality_code) selected @endif>
                                                                            @if(app()->getLocale() == 'ar')
                                                                                {{$country->country_arNationality}}
                                                                            @else
                                                                                {{$country->country_enNationality}}
                                                                            @endif
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>

                                                            @error('nationality_code')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="birth_date"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Birth Date') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="birth_date" type="date"
                                                                   class="form-control @error('birth_date') is-invalid @enderror"
                                                                   name="birth_date" value="{{ $user->birth_date }}"
                                                                   required >

                                                            @error('birth_date')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            <button type="submit" class="button gradient-bg" name="btn" value="GeneralInfo">
                                                                {{ __('Update') }}
                                                            </button>

                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab_2" class="tab-content">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header text-center"><h2>{{ __('Contact Info') }}</h2></div>

                                            <div class="card-body">
                                                <form method="POST"
                                                      action="{{ route('home.myuser.info.update',app()->getLocale()) }}">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <label for="phone"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="phone" type="text"
                                                                   class="form-control @error('phone') is-invalid @enderror"
                                                                   name="phone"
                                                                   value="{{ $user->phone }}" required
                                                                   autocomplete="phone">

                                                            @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="mobile"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="mobile" type="text"
                                                                   class="form-control @error('mobile') is-invalid @enderror"
                                                                   name="mobile"
                                                                   value="{{ $user->mobile }}" required
                                                                   autocomplete="phone">

                                                            @error('mobile')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="email"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="email" type="email"
                                                                   class="form-control @error('email') is-invalid @enderror"
                                                                   name="email"
                                                                   value="{{ $user->email }}" required
                                                                   autocomplete="email">

                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="governorate_id"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Governorate') }}</label>

                                                        <div class="col-md-6">
                                                            <select name="governorate_id" id="governorate_id"
                                                                    class="form-control @error('governorate_id') is-invalid @enderror" >
                                                                <option></option>
                                                                @if($governorates)
                                                                    @foreach($governorates as $governorate)
                                                                        <option value="{{$governorate->id}}"
                                                                                @if($governorate->id == $user->governorate_id) selected @endif>
                                                                            @if(app()->getLocale() == 'ar')
                                                                                {{$governorate->governorate_name_ar}}
                                                                            @else
                                                                                {{$governorate->governorate_name_en}}
                                                                            @endif
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('governorate_id')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="city_id"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                                                        <div class="col-md-6">
                                                            <select name="city_id" id="city_id"
                                                                    class="form-control @error('city_id') is-invalid @enderror" >
                                                                <option></option>
                                                                @if($citys)
                                                                    @foreach($citys as $city)
                                                                        <option value="{{$city->id}}"
                                                                                @if($city->id == $user->city_id) selected @endif>
                                                                            @if(app()->getLocale() == 'ar')
                                                                                {{$city->city_name_ar}}
                                                                            @else
                                                                                {{$city->city_name_en}}
                                                                            @endif
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>

                                                            @error('city_id')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="address"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="address" type="address"
                                                                   class="form-control @error('address') is-invalid @enderror"
                                                                   name="address"
                                                                   value="{{ $user->address }}" required
                                                                   autocomplete="address">

                                                            @error('address')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>




                                                    <div class="row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            <button type="submit" class="button gradient-bg" name="btn" value="GeneralInfo">
                                                                {{ __('Update') }}
                                                            </button>

                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab_3" class="tab-content">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header text-center"><h2>{{ __('Edit Password') }}</h2></div>

                                            <div class="card-body">
                                                <form method="POST"
                                                      action="{{ route('home.myuser.info.update',app()->getLocale()) }}">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <label for="password"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                                        <span style="color: red;font-size: 20px;">*</span>
                                                        <div class="col-md-6">
                                                            <input id="password" type="password"
                                                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                                                   required autocomplete="new-password">

                                                            @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="password-confirm"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                                        <span style="color: red;font-size: 20px;">*</span>
                                                        <div class="col-md-6">
                                                            <input id="password-confirm" type="password" class="form-control"
                                                                   name="password_confirmation" required autocomplete="new-password">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            <button type="submit" class="button gradient-bg" name="btn" value="GeneralInfo">
                                                                {{ __('Update') }}
                                                            </button>

                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab_4" class="tab-content">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header text-center"><h2>{{ __('Account Receiver') }}</h2></div>

                                            <div class="card-body">
                                                <form method="POST"
                                                      action="{{ route('home.myuser.info.update',app()->getLocale()) }}">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <label for="account_owner_name"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Account Owner Name') }}</label>

                                                        <div class="col-md-6">
                                                            <input type="text" value="{{$user -> account_owner_name }}" id="account_owner_name"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Account Owner Name') }}"
                                                                   name="account_owner_name">
                                                            @error('account_owner_name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="account_num"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>

                                                        <div class="col-md-6">
                                                            <input type="text" value="{{$user -> account_num }}" id="account_num"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Account Number') }}"
                                                                   name="account_num">
                                                            @error('account_num')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="bank_name"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Bank Name') }}</label>

                                                        <div class="col-md-6">
                                                            <input type="text" value="{{$user -> bank_name }}" id="bank_name"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Bank Name') }}"
                                                                   name="bank_name">
                                                            @error('bank_name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="identity_id"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Identity ID') }}</label>

                                                        <div class="col-md-6">
                                                            <input type="text" value="{{$user -> identity_id }}" id="identity_id"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Identity ID') }}"
                                                                   name="identity_id">
                                                            @error('identity_id')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="passport_id"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Passport ID') }}</label>

                                                        <div class="col-md-6">
                                                            <input type="text" value="{{$user -> passport_id }}" id="passport_id"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Passport ID') }}"
                                                                   name="passport_id">
                                                            @error('passport_id')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            <button type="submit" class="button gradient-bg" name="btn" value="GeneralInfo">
                                                                {{ __('Update') }}
                                                            </button>

                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($user->type == '2')
                                <div id="tab_5" class="tab-content">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header text-center"><h2>{{ __('Doctor Info') }}</h2></div>

                                            <div class="card-body">
                                                <form method="POST" enctype="multipart/form-data"
                                                      action="{{ route('home.myuser.info.update',app()->getLocale()) }}">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <label for="specialty"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Specialty') }}</label>

                                                        <div class="col-md-6">
                                                            <select name="specialty" id="specialty"
                                                                    class="form-control @error('title') is-invalid @enderror" >
                                                                <option></option>
                                                                @if($specialtis)
                                                                    @foreach($specialtis as $specialty)
                                                                        <option value="{{$specialty->id}}" @if($specialty->id == $doctor->specialty) selected @endif>
                                                                            @if(app()->getLocale() == 'en')
                                                                                {{$specialty->name_en}}
                                                                            @else
                                                                                {{$specialty->name_ar}}
                                                                            @endif
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="phone1"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Phone 1') }}</label>

                                                        <div class="col-md-6">
                                                            <input type="text" value="{{$doctor -> phone1}}" id="phone1"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Phone 1') }}"
                                                                   name="phone1" >
                                                            @error('phone1')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="phone2"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Phone 2') }}</label>

                                                        <div class="col-md-6">
                                                            <input type="text" value="{{$doctor -> phone2}}" id="phone2"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Phone 2') }}"
                                                                   name="phone2" >
                                                            @error('phone2')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="description"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                                        <div class="col-md-6">
                                                            <textarea name="description" class="form-control" id="description"
                                                                placeholder="{{ __('Description') }}">{{$doctor -> description}}</textarea>
                                                            @error('description')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="photo"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                                                        <div class="col-md-6">
                                                            <input type="file" value="" id="photo"
                                                                   class="form-control" accept="image/*"
                                                                   placeholder="{{ __('Photo') }}"
                                                                   name="photo" >
                                                            @error('photo')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="cv"
                                                               class="col-md-4 col-form-label text-md-right">{{ __('CV') }}</label>

                                                        <div class="col-md-6">
                                                            <input type="file" value="" id="cv"
                                                                   class="form-control" accept="application/pdf"
                                                                   placeholder="{{ __('CV') }}"
                                                                   name="cv" >
                                                            @error('cv')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            <button type="submit" class="button gradient-bg" name="btn" value="Doctor">
                                                                {{ __('Update') }}
                                                            </button>

                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div id="tab_7" class="tab-content">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header text-center"><h2>{{ __('Times Of Work') }}</h2></div>

                                                <div class="card-body">
                                                    <form method="POST" enctype="multipart/form-data"
                                                          action="{{ route('home.myuser.info.update',app()->getLocale()) }}">
                                                        @csrf
                                                        <h4 class="text-center"> {{ __("If Available all day don't choose a time") }}</h4>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3">
                                                                <input type="checkbox" value="Sat" name="day[]" id="sat"
                                                                   @if(isset($timeWork['Sat'])) CHECKED @endif>
                                                                <label for="sat" class="col-form-label text-md-right">{{ __('Saturday') }}</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="time" id="from" class="form-control" name="satf"
                                                                       @if(isset($timeWork['Satf'])) value="{{ $timeWork['Satf'] }}" @endif>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="time" id="to" class="form-control" name="satt"
                                                                       @if(isset($timeWork['Satt'])) value="{{ $timeWork['Satt'] }}" @endif>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-3">
                                                                <input type="checkbox" value="Sun" name="day[]" id="sun"
                                                                       @if(isset($timeWork['Sun'])) CHECKED @endif>
                                                                <label for="sun" class="col-form-label text-md-right">{{ __('Sunday') }}</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="time" id="from" class="form-control" name="sunf"
                                                                       @if(isset($timeWork['Sunf'])) value="{{ $timeWork['Sunf'] }}" @endif>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="time" id="to" class="form-control" name="sunt"
                                                                       @if(isset($timeWork['Sunt'])) value="{{ $timeWork['Sunt'] }}" @endif>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-3">
                                                                <input type="checkbox" value="Mon" name="day[]" id="mon"
                                                                       @if(isset($timeWork['Mon'])) CHECKED @endif>
                                                                <label for="mon" class="col-form-label text-md-right">{{ __('Monday') }}</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="time" id="from" class="form-control" name="monf"
                                                                       @if(isset($timeWork['Monf'])) value="{{ $timeWork['Monf'] }}" @endif>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="time" id="to" class="form-control" name="mont"
                                                                       @if(isset($timeWork['Mont'])) value="{{ $timeWork['Mont'] }}" @endif>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-3">
                                                                <input type="checkbox" value="Tue" name="day[]" id="tue"
                                                                       @if(isset($timeWork['Tue'])) CHECKED @endif>
                                                                <label for="tue" class="col-form-label text-md-right">{{ __('Tuesday') }}</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="time" id="from" class="form-control" name="tuef"
                                                                       @if(isset($timeWork['Tuef'])) value="{{ $timeWork['Tuef'] }}" @endif>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="time" id="to" class="form-control" name="tuet"
                                                                       @if(isset($timeWork['Tuet'])) value="{{ $timeWork['Tuet'] }}" @endif>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-3">
                                                                <input type="checkbox" value="Wed" name="day[]" id="wed"
                                                                       @if(isset($timeWork['Wed'])) CHECKED @endif>
                                                                <label for="wed" class="col-form-label text-md-right">{{ __('Wednesday') }}</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="time" id="from" class="form-control" name="wedf"
                                                                       @if(isset($timeWork['Wedf'])) value="{{ $timeWork['Wedf'] }}" @endif>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="time" id="to" class="form-control" name="wedt"
                                                                       @if(isset($timeWork['Wedt'])) value="{{ $timeWork['Wedt'] }}" @endif>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-3">
                                                                <input type="checkbox" value="Thu" name="day[]" id="thu"
                                                                       @if(isset($timeWork['Thu'])) CHECKED @endif>
                                                                <label for="thu" class="col-form-label text-md-right">{{ __('Thursday') }}</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="time" id="from" class="form-control" name="thuf"
                                                                       @if(isset($timeWork['Thuf'])) value="{{ $timeWork['Thuf'] }}" @endif>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="time" id="to" class="form-control" name="thut"
                                                                       @if(isset($timeWork['Thut'])) value="{{ $timeWork['Thut'] }}" @endif>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-3">
                                                                <input type="checkbox" value="Fri" name="day[]" id="fri"
                                                                       @if(isset($timeWork['Fri'])) CHECKED @endif>
                                                                <label for="fri" class="col-form-label text-md-right">{{ __('Friday') }}</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="time" id="from" class="form-control" name="frif"
                                                                       @if(isset($timeWork['Frif'])) value="{{ $timeWork['Frif'] }}" @endif>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="time" id="to" class="form-control" name="frit"
                                                                       @if(isset($timeWork['Frit'])) value="{{ $timeWork['Frit'] }}" @endif>
                                                            </div>
                                                        </div>


                                                        <div class="row mb-0">
                                                            <div class="col-md-6 offset-md-4">
                                                                <button type="submit" class="button gradient-bg" name="btn" value="docWorkTime">
                                                                    {{ __('Update') }}
                                                                </button>

                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($user->type == '3')
                                <div id="tab_6" class="tab-content">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header text-center"><h2>{{ __('Company Info') }}</h2></div>

                                                <div class="card-body">
                                                    <form method="POST" enctype="multipart/form-data"
                                                          action="{{ route('home.myuser.info.update',app()->getLocale()) }}">
                                                        @csrf
                                                        <div class="row mb-3">
                                                            <label for="org_name"
                                                                   class="col-md-4 col-form-label text-md-right">{{ __('Organization Name') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" value="{{$partner -> org_name}}" id="org_name"
                                                                       class="form-control"
                                                                       placeholder="{{ __('Organization Name') }}"
                                                                       name="org_name" >
                                                                @error('org_name')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="email"
                                                                   class="col-md-4 col-form-label text-md-right">{{ __('Organization Email') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="email" value="{{$partner -> email}}" id="email"
                                                                       class="form-control"
                                                                       placeholder="{{ __('Organization Email') }}"
                                                                       name="email" >
                                                                @error('email')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="phone"
                                                                   class="col-md-4 col-form-label text-md-right">{{ __('Organization Phone') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" value="{{$partner -> phone}}" id="phone"
                                                                       class="form-control"
                                                                       placeholder="{{ __('Organization Phone') }}"
                                                                       name="phone" >
                                                                @error('phone')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="website"
                                                                   class="col-md-4 col-form-label text-md-right">{{ __('Organization Website') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" value="{{$partner -> website}}" id="website"
                                                                       class="form-control"
                                                                       placeholder="{{ __('Organization Website') }}"
                                                                       name="website" >
                                                                @error('website')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="contact_person_name"
                                                                   class="col-md-4 col-form-label text-md-right">{{ __('Contact Person Name') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" value="{{$partner -> contact_person_name}}" id="contact_person_name"
                                                                       class="form-control"
                                                                       placeholder="{{ __('Contact Person Name') }}"
                                                                       name="contact_person_name" >
                                                                @error('contact_person_name')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="registration_num"
                                                                   class="col-md-4 col-form-label text-md-right">{{ __('Registration Number') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" value="{{$partner -> registration_num}}" id="registration_num"
                                                                       class="form-control"
                                                                       placeholder="{{ __('Registration Number') }}"
                                                                       name="registration_num" >
                                                                @error('registration_num')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="tax_certificate_num"
                                                                   class="col-md-4 col-form-label text-md-right">{{ __('Tax Certificate Number') }}</label>

                                                            <div class="col-md-6">
                                                                <input type="text" value="{{$partner -> tax_certificate_num}}" id="tax_certificate_num"
                                                                       class="form-control"
                                                                       placeholder="{{ __('Tax Certificate Number') }}"
                                                                       name="tax_certificate_num" >
                                                                @error('tax_certificate_num')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-0">
                                                            <div class="col-md-6 offset-md-4">
                                                                <button type="submit" class="button gradient-bg" name="btn" value="partner">
                                                                    {{ __('Update') }}
                                                                </button>

                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
