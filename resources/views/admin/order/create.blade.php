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
                                        <form class="form" action="" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> البيانات   </h4>

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="supplier_id"> {{ __('Supplier') }}  </label>
                                                            <select class="select2 form-control" id="supplier_id">
                                                                <option value="">-- {{ __('Supplier') }} --</option>
                                                                @foreach($sups as $sup)
                                                                    <option value="{{ $sup->id }}">
                                                                        {{ $sup->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="contract_no"> {{ __('Contract No.') }}  </label>
                                                            <input type="number" value="" id="contract_no"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Contract No.') }}">
                                                            @error('contract_no')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="date_order"> {{ __('Order Date') }}  </label>
                                                            <input type="date" value="" id="date_order"
                                                                   class="form-control" required
                                                                   placeholder="{{ __('Order Date') }} ">
                                                            @error('date_order')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="date_arrive"> {{ __('Arrive Date') }}  </label>
                                                            <input type="date" value="" id="date_arrive"
                                                                   class="form-control" required
                                                                   placeholder="{{ __('Arrive Date') }} ">
                                                            @error('date_arrive')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="payment_way"> {{ __('Payment Way') }} </label>
                                                            <select id="payment_way" required class="form-control">
                                                                <option value="" >-- {{ __('Payment Way') }}  --</option>
                                                                <option value="1" >{{ __('Cash') }}</option>
                                                                <option value="2" >{{ __('Pay Later') }}</option>
                                                            </select>
                                                            @error('payment_way')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>

                                                <h4 class="form-section"><i class="ft-home"></i> {{ __('Product') }} </h4>


                                                <div class="row">

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="product_id"> {{ __('Product') }}  </label>
                                                            <select class="select2 form-control" id="product_id">
                                                                <option value="">-- {{ __('Unit') }} --</option>
                                                                @foreach($pros as $pro)
                                                                    <option value="{{ $pro->id }}">
                                                                        {{ $pro->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="amount"> {{ __('Amount') }}  </label>
                                                            <input type="number" step="0.01" value="" id="amount" 
                                                                class="form-control"  max="6"
                                                                placeholder="{{ __('0.00') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="unit_id"> {{ __('Unit') }}  </label>
                                                            <select class="select2 form-control" id="unit_id">
                                                                <option value="">-- {{ __('Unit') }} --</option>
                                                                @foreach($units as $unit)
                                                                    <option value="{{ $unit->id }}">
                                                                        {{ $unit->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="price"> {{ __('Price') }}  </label>
                                                            <input type="number" step="0.01" value="" id="price" 
                                                                class="form-control"  max="6"
                                                                placeholder="{{ __('Price') }}">
                                                        </div>
                                                    </div>

                                                    <input type="hidden" id="ordid" value="">

                                                    <div class="col-md-1">
                                                        <button type="button" style="margin-top: 25px;" class="btn btn-primary" id="btnOrdInfo">
                                                            {{ __('Add') }}
                                                    </button>
                                                    </div>
                                                </div>
                                            
                                                <div class="row">
                                                    <table class="table table-striped table-bordered" id="tblService">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('Product') }}</th>
                                                                <th>{{ __('Amount') }}</th>
                                                                <th>{{ __('Unit') }}</th>
                                                                <th>{{ __('Price') }}</th>
                                                                <th> </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        {{-- @if (isset($prbuys))
                                                        @foreach ($prbuys as $prbuy)
                                                            <tr>
                                                                <td>{{ $prbuy->getProduct() }}</td>
                                                                <td>{{ $prbuy->amount }}</td>
                                                                <td>{{ $prbuy->getUnit() }}</td>
                                                                <td>{{ $prbuy->price }}</td>
                                                                <td>
                                                                    <a href="{{route('admin.order.info.delete',[$datas->id, $prbuy->id])}}" class="btn btn-danger" ><i class="ft-trash-2"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @endif --}}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            {{-- End Add Servese --}}
                                               
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
        jQuery(document).ready(function ($) {

            // add order info
            $('#btnOrdInfo').click(function () {

            let unit_id = $("#unit_id option:selected").val();
            let unit_id_text = $("#unit_id option:selected").text();
            let amount = $("#amount").val();
            let category = $("#category").val();
            let product_id = {{ $datas->id }}
            let _token = '{{ csrf_token() }}';

            if(unit_id == ""){
                alert("يجب اضافه الوحده");
            }else if(amount == ""){
                alert("اضافه الكميه");
            }else if(category == ""){
                alert("يجب اضافه القسم");
            }else if(amount.length  > 9 ){
                alert("الكميه لا يجب ان تتجاوز 6 ارقام صحيحه");
            }else{
                $.ajax({
                    url: "{{ route('ajax.product.set.buy') }}",
                    type: 'POST',
                    dataType: 'json',
                    data:{
                        unit_id :unit_id,
                        amount :amount,
                        category :category,
                        product_id :product_id,
                        _token: _token
                    },
                    success: function (response) {
                        $('#unit_id').val('').change();
                        $('#amount').val(0);
                        $('#category').val('');
                        let url = '{{route("admin.product.buy.delete",[ $datas->id,":srvid"])}}';
                        url = url.replace(':srvid', response.srvid);
                        $('#tblService tr:last').after('<tr><td>'+category+'</td><td>'+amount+'</td><td>'+unit_id_text+'</td><td>'+
                            '<a href="'+url+'" class="btn btn-danger" ><i class="ft-trash-2"></i></a>'+'</td></tr>');
                        
                    }
                    // error: function (xhr, ajaxOptions, thrownError) {
                    //     // console.log(xhr);
                    // }
                });
            }
            });

        });
    </script>
@endsection
