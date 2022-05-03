@extends('layouts.admin')
@section('title',__('Order'))
@section('order_cr','')
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
                                <li class="breadcrumb-item"><a href="{{route('admin.order')}}">  {{ __('Order') }} </a>
                                </li>
                                <li class="breadcrumb-item active">إضافة  
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة   </h4>
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
                                        <form class="form" action="{{route('admin.order.receive.store',[$oid])}}" method="POST">
                                            @csrf

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> البيانات   </h4>

                                                <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="date_receive"> {{ __('Date') }}  </label>
                                                            <input type="date" id="date_receive" name="date_receive"
                                                                   class="form-control" required
                                                                   @if (isset($order->date_receive)) value="{{ $order->date_receive }}" @endif
                                                                   placeholder="{{ __('Date') }} ">
                                                            @error('date_receive')
                                                                <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="clearance_id"> {{ __('Clearance Company') }}  </label>
                                                            <select class="select2 form-control" name="clearance_id" id="clearance_id">
                                                                <option value="">-- {{ __('Clearance Company') }} --</option>
                                                                @foreach($clears as $clear)
                                                                    <option value="{{ $clear->id }}">
                                                                        {{ $clear->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="clearance_cost"> {{ __('Cost') }}  </label>
                                                            <input type="number" step="0.01" value="" id="clearance_cost" 
                                                                class="form-control"  max="6"  name="clearance_cost"
                                                                placeholder="{{ __('Cost') }}">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="transfer_id"> {{ __('Transfer Company') }}  </label>
                                                            <select class="select2 form-control" name="transfer_id" id="transfer_id">
                                                                <option value="">-- {{ __('Transfer Company') }} --</option>
                                                                @foreach($trans as $tran)
                                                                    <option value="{{ $tran->id }}">
                                                                        {{ $tran->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="transfer_cost"> {{ __('Cost') }}  </label>
                                                            <input type="number" step="0.01" value="" id="transfer_cost" 
                                                                class="form-control"  max="6"  name="transfer_cost"
                                                                placeholder="{{ __('Cost') }}">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <label for="where"
                                                                   class="card-title ml-1">{{ __('Customer') }} </label>
                                                            <input type="checkbox" value="1" id="where" name="where"
                                                                    onchange="stockOrCustomer()"
                                                                   class="switchery" />
                                                            <label for="where"
                                                                   class="card-title ml-1">{{ __('Stock') }} </label>
                                                            @error('where')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" id="customer" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="customer_id"> {{ __('Customer') }}  </label>
                                                            <select class="select2 form-control" style="width: 100%"
                                                                name="customer_id" id="customer_id">
                                                                <option value="">-- {{ __('Customer') }} --</option>
                                                                @foreach($customers as $customer)
                                                                    <option value="{{ $customer->id }}">
                                                                        {{ $customer->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" id="stock">
                                                        <div class="form-group">
                                                            <label for="stock_id"> {{ __('Stock') }}  </label>
                                                            <select class="select2 form-control" style="width: 100%"
                                                                name="stock_id" id="stock_id">
                                                                <option value="">-- {{ __('Stock') }} --</option>
                                                                @foreach($stocks as $stock)
                                                                    <option value="{{ $stock->id }}">
                                                                        {{ $stock->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                               
                                            </div>


                                            <div class="form-actions">
                                                
                                                <a href="{{ route('admin.order') }}" class="btn btn-warning">
                                                     تراجع
                                                </a>
                                                
                                                <button type="submit" class="btn btn-primary">
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
                <!-- // Basic form layout section end -->

            </div>
        </div>
    </div>

@endsection


@section('script')
    <script>
        // jQuery(document).ready(function ($) {


        // });

        // Show/hide 
        function stockOrCustomer()
        {
            if($('#where').is(":checked")){
                $("#customer").show(); 
                $("#stock").hide();  
            }else{
                $("#customer").hide(); 
                $("#stock").show();
            } 
        }

        
    </script>
@endsection

