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
                                        <form class="form" action="{{route('admin.order.store')}}" method="POST">
                                            @csrf

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> البيانات   </h4>

                                                <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="supplier_id"> {{ __('Supplier') }}  </label>
                                                            <select class="select2 form-control" name="supplier_id" id="supplier_id">
                                                                <option value="">-- {{ __('Supplier') }} --</option>
                                                                @foreach($sups as $sup)
                                                                    <option value="{{ $sup->id }}"
                                                                        @if (isset($order->supplier_id))
                                                                            @if ($order->supplier_id == $sup->id) selected @endif
                                                                        @endif>
                                                                        {{ $sup->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" name="orderid" id="order" @if (isset($order->id)) value="{{ $order->id }}" @endif />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="contract_no"> {{ __('Contract No.') }}  </label>
                                                            <input type="number" id="contract_no"
                                                                   class="form-control" name="contract_no"
                                                                   @if (isset($order->contract_no)) value="{{ $order->contract_no }}" @endif
                                                                   placeholder="{{ __('Contract No.') }}">
                                                            @error('contract_no')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="date_order"> {{ __('Order Date') }}  </label>
                                                            <input type="date" id="date_order" name="date_order"
                                                                   class="form-control" required
                                                                   @if (isset($order->date_order)) value="{{ $order->date_order }}" @endif
                                                                   placeholder="{{ __('Order Date') }} ">
                                                            @error('date_order')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="date_arrive"> {{ __('Arrive Date') }}  </label>
                                                            <input type="date" id="date_arrive" name="date_arrive"
                                                                   class="form-control" required
                                                                   @if (isset($order->date_arrive)) value="{{ $order->date_arrive }}" @endif
                                                                   placeholder="{{ __('Arrive Date') }} ">
                                                            @error('date_arrive')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="payment_way"> {{ __('Payment Way') }} </label>
                                                            <select id="payment_way" class="form-control" name="payment_way">
                                                                <option value="" >-- {{ __('Payment Way') }}  --</option>
                                                                @if (isset($order->payment_way))
                                                                    <option value="1" @if ($order->payment_way == '1') selected @endif>
                                                                        {{ __('Cash') }}</option>
                                                                    <option value="2" @if ($order->payment_way == '2') selected @endif>
                                                                        {{ __('Pay Later') }}</option>
                                                                @else
                                                                    <option value="1" >{{ __('Cash') }}</option>
                                                                    <option value="2" >{{ __('Pay Later') }}</option>
                                                                @endif
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
                                                                class="form-control"  max="6"
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
                                                        {{-- @isset($order->status) --}}
                                                            @if (! isset($order->status) || $order->status == 0)
                                                                <button type="button" style="margin-top: 25px;" class="btn btn-primary" id="btnOrdInfo">
                                                                    {{ __('Add') }}
                                                                </button>
                                                            @endif
                                                        {{-- @endisset --}}
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
                                                        @if (isset($orderinfos))
                                                            @foreach ($orderinfos as $orderinfo)
                                                                <tr>
                                                                    <td>{{ $orderinfo->getProduct() }} {{ $orderinfo->product_cat }}</td>
                                                                    <td>{{ $orderinfo->amount }}</td>
                                                                    <td>{{ $orderinfo->getUnit() }}</td>
                                                                    <td>{{ $orderinfo->price }}</td>
                                                                    <td>
                                                                        @if (isset($order->status)) 
                                                                            @if ($order->status == 0)
                                                                                <button type="button" class="btn btn-danger btnDelOrderInfo" name="btn" value="{{ $orderinfo->id }}">
                                                                                    <i class="ft-trash-2"></i>
                                                                                </button>
                                                                            @endif
                                                                        @endif
                                                                        {{-- <a href="{{route('admin.order.info.delete',[$datas->id, $prbuy->id])}}" class="btn btn-danger" ><i class="ft-trash-2"></i></a> --}}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            {{-- End Add Servese --}}
                                               
                                            </div>


                                            <div class="form-actions">
                                                
                                                <a href="{{ route('admin.order') }}" class="btn btn-warning">
                                                     تراجع
                                                </a>
                                                {{-- @isset($order->status)  --}}
                                                @if (! isset($order->status) || $order->status == 0)
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Save') }}
                                                        </button>
        
                                                        <button type="submit" name="btn" value="ConfBtn" class="btn btn-primary">
                                                            {{ __('Confirm') }}
                                                        </button>

                                                    @endif
                                                {{-- @endisset --}}

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->

                @isset($order->status)
                @if ($order->status != '0')

                <!--  Order Receive Table -->
                {{-- <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"> {{ __('Order Receive') }}</h4>
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
                                        @if(\App\Models\Role::havePremission(['order_cr']))
                                        <a class="btn btn-primary mb-2 mr15" href="{{ route('admin.order.receive.create') }}"><i class="ft-plus"></i>&nbsp; {{ __('Create') }}</a>
                                        @endif
                                        <table
                                            class="table table-striped table-bordered ordering-print ">
                                            <thead>
                                            <tr>
                                                <th>ID </th>
                                                <th>{{ __('Supplier') }} </th>
                                                <th>{{ __('Order Date') }} </th>
                                                <th>{{ __('Arrive Date') }} </th>
                                                
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($datas)
                                                @foreach($datas as $data)
                                                    <tr>
                                                        <td>{{$data -> id}}</td>
                                                        <td>{{$data -> supplier_id}}</td>
                                                        <td>{{$data -> date_order}}</td>
                                                        <td>{{$data -> date_arrive}}</td>
                                                        
                                                        <td>
                                                                 @if(\App\Models\Role::havePremission(['order_idt']))
                                                                <a href="{{route('admin.order.create',['id'=> $data->id ])}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                                   @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset 


                                            </tbody>

                                        </table>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}
                {{-- Order Receive Table --}}
                @endif
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
            // add order
            function addOrder() {


                console.log('in');

                let supplier_id = $("#supplier_id option:selected").val();
                let supplier_id_text = $("#supplier_id option:selected").text();
                let contract_no = $("#contract_no").val();
                let date_order = $("#date_order").val();
                let date_arrive = $("#date_arrive").val();
                let payment_way = $("#payment_way option:selected").val();
                let payment_way_text = $("#payment_way option:selected").text();
                
                let _token = '{{ csrf_token() }}';

                if(supplier_id == ""){
                    alert("يجب اضافه المعامل");
                }else if(date_order == ""){
                    alert("اضافه تاريخ الطلب");
                }else if(date_arrive == ""){
                    alert("اضافه تاريخ الوصول");
                }else{
                    $.ajax({
                        url: "{{ route('ajax.order.set') }}",
                        type: 'POST',
                        dataType: 'json',
                        data:{
                            supplier_id :supplier_id,
                            contract_no :contract_no,
                            date_order :date_order,
                            date_arrive :date_arrive,
                            payment_way :payment_way,
                            _token: _token
                        },
                        success: function (response) {
                            $('#order').val(response.orderid);
                            return response.orderid;
                        }
                        // error: function (xhr, ajaxOptions, thrownError) {
                        //     // console.log(xhr);
                        // }
                    });
                }


                return "";
            }
            // add order info
            $('#btnOrdInfo').click(function () {

                let order_id = $("#order").val();
                if(order_id == ''){
                    order_id = addOrder();
                    if(order_id == '') 
                        return false;
                }
                
                let product_id = $("#product_id option:selected").val();
                let product_id_text = $("#product_id option:selected").text();
                let product_cat = $("#procat option:selected").val();
                let amount = $("#amount").val();
                let unit_id = $("#unit_id option:selected").val();
                let unit_id_text = $("#unit_id option:selected").text();
                let price = $("#price").val();
                
                let _token = '{{ csrf_token() }}';

                // console.log(product_cat);

                if(unit_id == ""){
                    alert("يجب اضافه الوحده");
                }else if(product_cat == ""){
                    alert("يجب اضافه المواصفات");
                }else if(amount == ""){
                    alert("اضافه الكميه");
                }else if(price == ""){
                    alert("اضافه السعر");
                }else if(product_id == ""){
                    alert("يجب اضافه المنتج");
                }else if(amount.length  > 9 ){
                    alert("الكميه لا يجب ان تتجاوز 6 ارقام صحيحه");
                }else if(price.length  > 9 ){
                    alert("السعر لا يجب ان تتجاوز 6 ارقام صحيحه");
                }else{
                    $.ajax({
                        url: "{{ route('ajax.order.set.info') }}",
                        type: 'POST',
                        dataType: 'json',
                        data:{
                            unit_id :unit_id,
                            amount :amount,
                            price :price,
                            product_id :product_id,
                            product_cat :product_cat,
                            order_id :order_id,
                            _token: _token
                        },
                        success: function (response) {
                            $('#product_id').val('').change();
                            $('#unit_id').val('').change();
                            $('#procat').val('').change();
                            $('#amount').val('');
                            $('#price').val('');
                            // let url = '{{route("admin.product.buy.delete",[ 5,":srvid"])}}';
                            // url = url.replace(':srvid', response.ordinfoid);
                            $('#tblService tr:last').after('<tr><td>'+product_id_text+ ' '+ product_cat +'</td><td>'+
                                amount+'</td><td>'+unit_id_text+ '</td><td>'+price+'</td><td>'+
                                    '<button type="button" class="btn btn-danger btnDelOrderInfo" value='+response.ordinfoid+'>'+
                                    '<i class="ft-trash-2"></i></button></td></tr>');
                                // '<a href="'+url+'" class="btn btn-danger" ><i class="ft-trash-2"></i></a>'+'</td></tr>');
                            
                        }
                        // error: function (xhr, ajaxOptions, thrownError) {
                        //     // console.log(xhr);
                        // }
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
                        url: "{{ route('admin.order.info.delete') }}",
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
    </script>
@endsection

