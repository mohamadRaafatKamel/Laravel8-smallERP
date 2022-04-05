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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center"><h2>{{ __('Register') }}</h2></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register', app()->getLocale()) }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('Frist Name') }}

                                </label><span style="color: red;font-size: 20px;">*</span>

                                <div class="col-md-6">
                                    <input id="fname" type="text"
                                           class="form-control @error('fname') is-invalid @enderror" name="fname"
                                           value="{{ old('fname') }}" required autocomplete="fname" autofocus>

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
                                <span style="color: red;font-size: 20px;">*</span>
                                <div class="col-md-6">
                                    <input id="lname" type="text"
                                           class="form-control @error('lname') is-invalid @enderror" name="lname"
                                           value="{{ old('lname') }}" required autocomplete="name" autofocus>

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
                                <span style="color: red;font-size: 20px;">*</span>
                                <div class="col-md-6">
                                    <select name="title" id="title"
                                            class="form-control @error('title') is-invalid @enderror" required>
                                        <option></option>
                                        <option value="Mr"
                                                @if(old('title') == "Mr") selected @endif>{{ __('Mr') }}</option>
                                        <option value="Mrs"
                                                @if(old('title') == "Mrs") selected @endif>{{ __('Mrs') }}</option>
                                        <option value="Dr"
                                                @if(old('title') == "Dr") selected @endif>{{ __('Dr') }}</option>
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
                                <span style="color: red;font-size: 20px;">*</span>
                                <div class="col-md-6">
                                    <input id="username" type="text"
                                           class="form-control @error('username') is-invalid @enderror" name="username"
                                           value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                                <span style="color: red;font-size: 20px;">*</span>
                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                           class="form-control @error('phone') is-invalid @enderror" name="phone"
                                           value="{{ old('phone') }}" required autocomplete="phone">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <span style="color: red;font-size: 20px;">*</span>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="gender"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                <span style="color: red;font-size: 20px;">*</span>
                                <div class="col-md-6">
                                    <select name="gender" id="phone"
                                            class="form-control @error('gender') is-invalid @enderror">
                                        <option value="1"
                                                @if(old('gender') == "1") selected @endif>{{ __('Male') }}</option>
                                        <option value="2"
                                                @if(old('gender') == "2") selected @endif>{{ __('Female') }}</option>
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
                                       class="col-md-4 col-form-label text-md-right">{{ __('Birth Date') }}</label>
                                <span style="color: red;font-size: 20px;">*</span>
                                <div class="col-md-6">
                                    <input id="birth_date" type="date"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="birth_date" value="{{ old('birth_date') }}" required
                                           autocomplete="new-password">

                                    @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="gender"
                                       class="col-md-4 col-form-label text-md-right">{{ __('I Am') }}</label>
                                <span style="color: red;font-size: 20px;">*</span>
                                <div class="col-md-6">
                                    <select name="type" id="type"
                                            class="form-control @error('type') is-invalid @enderror">
                                        <option value="1"
                                                @if(old('type') == "1") selected @endif>{{ __('Need Doctor') }}</option>
                                        <option value="2"
                                                @if(old('type') == "2") selected @endif>{{ __('Doctor') }}</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

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
                                    <button type="submit" class="button gradient-bg">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4 ">
                                    <a class="btn btn-link" href="{{ route('login', app()->getLocale()) }}">
                                        {{ __('Already Have Account') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
