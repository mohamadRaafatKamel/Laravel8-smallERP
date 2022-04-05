@extends('layouts.admin')
@section('title',__("Add"))
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
                                <li class="breadcrumb-item"><a href="{{route('admin.user')}}"> العملاء </a>
                                </li>
                                <li class="breadcrumb-item active">{{  __("Add") }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

            @include('admin.include.alerts.success')
            @include('admin.include.alerts.errors')

                <!-- Account Settings section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">{{  __("Add") }}</h4>
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
                                        <form class="form" action="{{route('admin.user.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> {{ __('Account Settings') }} </h4>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="username"> {{ __('Name') }} </label>
                                                            <input type="text" id="username"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Name') }}"
                                                                   name="username" required>
                                                            @error('username')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone"> {{ __('Phone') }} </label>
                                                            <input type="text" id="phone"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Phone') }}"
                                                                   name="phone" required>
                                                            @error('phone')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email"> {{ __('Email') }} </label>
                                                            <input type="email" id="email"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Email') }}"
                                                                   name="email">
                                                            @error('email')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div> --}}


                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary" name="btn" value="1">
                                                    {{ __('Patient') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary" name="btn" value="2">
                                                     {{ __('Doctor') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary" name="btn" value="4">
                                                     {{ __('Nurse') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary" name="btn" value="5">
                                                     {{ __('Driver') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Account Settings section end -->



            </div>
        </div>
    </div>

@endsection
