@extends('layouts.admin')
@section('title', __('Referral Category'))
@section('referral_cat','')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">  {{ __('Referral Category') }} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">  {{ __('Referral Category') }}
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
                                    <h4 class="card-title" id="basic-layout-form"><b> <i class="ft-phone"></i> {{ __('Category') }} </b> </h4>
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
                                                
                                            <form class="form" action="{{route('admin.referral.cat.store')}}" 
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                
                                                
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label for="name"> {{ __('Category Name') }}</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            
                                                            <input type="text" id="name" 
                                                                   class="form-control" 
                                                                   placeholder="{{ __('Category Name') }} "
                                                                   name="name">
                                                            @error('name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" name="btn" value="nurseSheet" class="btn btn-success">
                                                             {{ __('Add') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>

                                                @if (isset($cats))
                                                    @if (count($cats) > 0)
                                                    <div class="row">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th> {{ __('ID') }}</th>
                                                                    <th> {{ __('Category Name') }}</th>
                                                                    <th> </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($cats as $cat)
                                                                <tr>
                                                                    <td>{{ $cat->id }}</td>
                                                                    <td>{{ $cat->name }}</td>
                                                                    <td>
                                                                        @if( \App\Models\Role::havePremission(['referral_cat_del']))
                                                                            <a href="{{route('admin.referral.cat.delete',$cat->id)}}" class="btn btn-danger" ><i class="ft-trash-2"></i></a>
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
                <!-- // Basic form layout section end -->
            
            </div>
        </div>
    </div>
@endsection
