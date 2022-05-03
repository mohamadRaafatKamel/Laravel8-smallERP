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
                                        @isset($data->id)
                                            <form class="form" action="{{route('admin.order.receive.store',[$oid,$data->id])}}" method="POST">
                                        @else
                                            <form class="form" action="{{route('admin.order.receive.store',[$oid])}}" method="POST">
                                        @endisset
                                            @csrf

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> البيانات   </h4>

                                                <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="date_receive"> {{ __('Date') }}  </label>
                                                            <input type="date" id="date_receive" name="date_receive"
                                                                   class="form-control" required
                                                                   @isset($data->date_receive) value="{{ $data->date_receive }}" @endisset
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
                                                                    <option value="{{ $clear->id }}" 
                                                                        @isset($data->clearance_id) @if ($data->clearance_id == $clear->id)
                                                                        selected @endif @endisset >
                                                                        {{ $clear->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="clearance_cost"> {{ __('Cost') }}  </label>
                                                            <input type="number" step="0.01" id="clearance_cost" 
                                                                @isset($data->clearance_cost) value="{{ $data->clearance_cost }}" @endisset
                                                                class="form-control"  max="999999.99"  name="clearance_cost"
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
                                                                    <option value="{{ $tran->id }}" 
                                                                        @isset($data->transfer_id) @if ($data->transfer_id == $tran->id)
                                                                        selected @endif @endisset >
                                                                        {{ $tran->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="transfer_cost"> {{ __('Cost') }}  </label>
                                                            <input type="number" step="0.01" id="transfer_cost" 
                                                                @isset($data->transfer_cost) value="{{ $data->transfer_cost }}" @endisset
                                                                class="form-control"  max="999999.99"  name="transfer_cost"
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
                                                                    @isset($data->where) @if ($data->where == 1) checked @endif @endisset
                                                                   class="switchery" />
                                                            <label for="where"
                                                                   class="card-title ml-1">{{ __('Stock') }} </label>
                                                            @error('where')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" id="customer"
                                                    @isset($data->where) 
                                                        @if ($data->where != 1) style="display: none;" @endif
                                                    @else
                                                        style="display: none;"
                                                    @endisset >
                                                        <div class="form-group">
                                                            <label for="customer_id"> {{ __('Customer') }}  </label>
                                                            <select class="select2 form-control" style="width: 100%"
                                                                name="customer_id" id="customer_id">
                                                                <option value="">-- {{ __('Customer') }} --</option>
                                                                @foreach($customers as $customer)
                                                                    <option value="{{ $customer->id }}"
                                                                        @isset($data->customer_id) @if ($data->customer_id == $customer->id)
                                                                        selected @endif @endisset >
                                                                        {{ $customer->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" id="stock"
                                                    @isset($data->where) @if ($data->where != 0) style="display: none;" @endif @endisset>
                                                        <div class="form-group">
                                                            <label for="stock_id"> {{ __('Stock') }}  </label>
                                                            <select class="select2 form-control" style="width: 100%"
                                                                name="stock_id" id="stock_id">
                                                                <option value="">-- {{ __('Stock') }} --</option>
                                                                @foreach($stocks as $stock)
                                                                    <option value="{{ $stock->id }}"
                                                                        @isset($data->stock_id) @if ($data->stock_id == $stock->id)
                                                                        selected @endif @endisset >
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
                                                @isset($data->id)
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Save') }}
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Next') }}
                                                    </button>
                                                @endisset
                                                
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->

                @isset($data->id)
                    <!--  Order Receive Info Table -->
                    <section>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title"> {{ __('Product') }}</h4>
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
                                        <div class="card-body card-dashboard">
                                            

                                            <div class="row">

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="product_id"> {{ __('Product') }}  </label>
                                                        <select class="select2 form-control" id="product_id">
                                                            <option value="">-- {{ __('Product') }} --</option>
                                                            @foreach($pros as $pro)
                                                                <option value="{{ $pro->id }}">
                                                                    {{ $pro->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="procat"> المواصفات </label>
                                                        <select class="select2 form-control" id="procat">
                                                            <option value="">-- المواصفات --</option>
                                                            {{-- @foreach($pros as $pro)
                                                                <option value="{{ $pro->id }}">
                                                                    {{ $pro->name}}
                                                                </option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="amount"> {{ __('Amount') }}  </label>
                                                        <input type="number" step="0.01" value="" id="amount" 
                                                            class="form-control"  max="99999.99"
                                                            placeholder="{{ __('0.00') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="unit_id"> {{ __('Unit') }}  </label>
                                                        <select class="select2 form-control" id="unit_id">
                                                            <option value="">-- {{ __('Unit') }} --</option>
                                                            {{-- @foreach($units as $unit)
                                                                <option value="{{ $unit->id }}">
                                                                    {{ $unit->name}}
                                                                </option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-1">
                                                        @if ($data->status == 0)
                                                            <button type="button" style="margin-top: 25px;" class="btn btn-primary" id="btnOrdInfo">
                                                                {{ __('Add') }}
                                                            </button>
                                                        @endif
                                                </div>
                                            </div>
                                        
                                            <div class="row">
                                                <table class="table table-striped table-bordered" id="tblService">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('Product') }}</th>
                                                            <th>{{ __('Amount') }}</th>
                                                            <th>{{ __('Unit') }}</th>
                                                            <th> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if (isset($infos))
                                                        @foreach ($infos as $info)
                                                            <tr>
                                                                <td>{{ $info->getProduct() }} {{ $info->product_cat }}</td>
                                                                <td>{{ $info->amount }}</td>
                                                                <td>{{ $info->getUnit() }}</td>
                                                                <td>
                                                                    @if ($data->status == 0)
                                                                        <button type="button" class="btn btn-danger btnDelOrderInfo" name="btn" value="{{ $info->id }}">
                                                                            <i class="ft-trash-2"></i>
                                                                        </button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    {{-- Order Receive Info Table --}}
                @endisset
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script>
        jQuery(document).ready(function ($) {

            //////////// Get Data

            // get Category from Product
            $('#product_id').change(function(){
                ProductId = $(this).find(':selected').val();
                loadCat(ProductId);
                // loadUnit(ProductId, null);
            });

            function loadCat(ProductId){
                $("#procat").children().remove();
                $.ajax({
                    url: "{{ route('ajax.order.get.product.cat') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        pro_id : ProductId,
                        _token: '{{ csrf_token() }}'
                    }
                }).done(function( result ) {
                    console.log(result.length);
                    $("#procat").append($('<option>', {
                        value: '',
                        text: '-- المواصفات --',
                    }));
                    $(result).each(function(){
                        $("#procat").append($('<option>', {
                            value: this.category,
                            text: this.category,
                        }));
                    })
                });

                // console.log('dd');
                // console.log($("#procat option:selected").val());
            }

            // get Unit from Product
            $('#procat').change(function(){
                // console.log('ggg');

                let cat = $(this).find(':selected').val();
                let ProductId = $("#product_id option:selected").val();
                loadUnit(ProductId, cat);
            });

            function loadUnit(ProductId, cat){
                
                $("#unit_id").children().remove();
                $.ajax({
                    url: "{{ route('ajax.order.get.product.unit') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        pro_id : ProductId,
                        cat : cat,
                        _token: '{{ csrf_token() }}'
                    }
                }).done(function( result ) {
                    // console.log(result);
                    
                    $(result).each(function(){
                        $("#unit_id").append($('<option>', {
                            value: this['id'],
                            text: this['name'],
                        }));
                    })
                });
            }


            //////////// Set Data

            
// add order info
$('#btnOrdInfo').click(function () {

    let product_id = $("#product_id option:selected").val();
    let product_id_text = $("#product_id option:selected").text();
    let product_cat = $("#procat option:selected").val();
    let amount = $("#amount").val();
    let unit_id = $("#unit_id option:selected").val();
    let unit_id_text = $("#unit_id option:selected").text();
    
    let _token = '{{ csrf_token() }}';

    // console.log(product_cat);

    if(unit_id == ""){
        alert("يجب اضافه الوحده");
    }else if(product_cat == ""){
        alert("يجب اضافه المواصفات");
    }else if(amount == ""){
        alert("اضافه الكميه");
    }else if(product_id == ""){
        alert("يجب اضافه المنتج");
    }else if(amount.length  > 9 ){
        alert("الكميه لا يجب ان تتجاوز 6 ارقام صحيحه");
    }else{
        $.ajax({
            url: "{{ route('ajax.receive.set.info') }}",
            type: 'POST',
            dataType: 'json',
            data:{
                unit_id :unit_id,
                amount :amount,
                product_id :product_id,
                product_cat :product_cat,
                order_id : {{ $oid }},
                order_receive_id : {{ $data->id }},
                _token: _token
            },
            success: function (response) {
                $('#product_id').val('').change();
                $('#unit_id').val('').change();
                $('#procat').val('').change();
                $('#amount').val('');
                
                $('#tblService tr:last').after('<tr><td>'+product_id_text+ ' '+ product_cat +'</td><td>'+
                    amount+'</td><td>'+unit_id_text+ '</td><td>'+
                        '<button type="button" class="btn btn-danger btnDelOrderInfo" value='+response.ordinfoid+'>'+
                        '<i class="ft-trash-2"></i></button></td></tr>');
                
            }
           
        });
    }
});

// Delete order info 
$(".btnDelOrderInfo").click(function(){

    let id = $(this).val();
    let row = $(this).closest("tr");
    let _token   = '{{ csrf_token() }}';

    if(confirm("هل انت متاكد ؟")){
        $.ajax({
            url: "{{ route('ajax.receive.info.delete') }}",
            type: 'POST',
            dataType: 'json',
            data:{
                id :id,
                _token: _token
            },
            success: function (response) {
                if(response.success == 1){
                    row.hide();
                }
            }
        });
    }else{
        return false;
    }
});

        });

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

