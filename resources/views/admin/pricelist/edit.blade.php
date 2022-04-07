@extends('layouts.admin')
@section('title','تعديل')
@section('pricelist_view','')
@section('content')
<?php 
if(! $permissoin = \App\Models\Role::havePremission(['pricelist_idt']))
    $readonly="readonly";
else 
    $readonly="";
?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{ __('Home') }} </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.pricelist')}}">{{ __('Price List') }} </a>
                                </li>
                                <li class="breadcrumb-item active">تعديل
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
                                    <h4 class="card-title" id="basic-layout-form">تعديل</h4>
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
                                        @if ($permissoin)
                                        <form class="form form-horizontal" action="{{route('admin.pricelist.update',$datas -> id)}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                        @endif

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> البيانات   </h4>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="name">الاسم </label>
                                                <div class="col-md-6">
                                                    <input type="text" value="{{$datas -> name}}" id="name"
                                                            class="form-control" required {{ $readonly }}
                                                            placeholder="الاسم "
                                                            name="name">
                                                    @error('name')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="copy_from">{{ __('Copy From') }}</label>
                                                <div class="col-md-6">
                                                    <select class="select2 form-control" disabled>
                                                        <option value="">-- {{ __('Copy From') }} --</option>
                                                        @foreach($priceLists as $priceList)
                                                            <option value="{{ $priceList->id }}"
                                                                @if ($priceList->id == $datas ->copy_from) selected @endif>
                                                                    {{ $priceList->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('copy_from')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="disabled">الحالة</label>
                                                <div class="col-md-6">
                                                    <input type="checkbox" value="0" name="disabled" id="disabled" {{ $readonly }}
                                                            class="switchery" data-color="success" 
                                                            @if($datas -> disabled  == 0 ) checked @endif/>
                                                    @error('disabled')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="main_pl">main</label>
                                                <div class="col-md-6">
                                                    <input type="checkbox"  value="1" name="main_pl" {{ $readonly }}
                                                            id="main_pl" class="switchery" data-color="success" 
                                                            @if($datas -> main_pl  == 1 ) checked @endif/>
                                                    @error('main_pl')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            @if ($permissoin)
                                                <div class="form-actions">
                                                    
                                                    <a href="{{ route('admin.pricelist') }}" class="btn btn-warning">تراجع
                                                    </a>
                                                    <button type="submit" class="btn btn-primary">
                                                          {{ __('Save') }}
                                                    </button>
                                                </div>
                                            @endif

                                            {{-- No Copy No Roll --}}
                                            @if (isset($datas->copy_from))
                                                
                                            
                                            <h4 class="form-section"><i class="ft-home"></i> {{ __('Role') }}   </h4>

                                            @if ($datas->status == 0)
                                               
                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="category_id">{{ __('Category') }}</label>
                                                <div class="col-md-6">
                                                    <select class="select2 form-control" id="category_id">
                                                        <option value="">-- {{ __('Category') }} --</option>
                                                        @foreach($categorys as $category)
                                                            <option value="{{ $category->id }}">
                                                                @if (App::getLocale() == 'ar')
                                                                    {{ $category->name_ar}}
                                                                @else
                                                                    {{ $category->name_en}}
                                                                @endif
                                                                
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="up_down">{{ __('Up Down') }}</label>
                                                <div class="col-md-2">
                                                    <select class="select2 form-control" id="up_down">
                                                        <option value="1">{{ __('Down') }}</option>
                                                        <option value="2">{{ __('Up') }}</option>
                                                    </select>
                                                    @error('up_down')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>

                                                <label class="col-md-2 label-control" for="percentage_cash">{{ __('Percentage Cash') }}</label>
                                                <div class="col-md-2">
                                                    <select class="select2 form-control" id="percentage_cash">
                                                        <option value="1">{{ __('Percentage') }}</option>
                                                        <option value="2">{{ __('Cash') }}</option>
                                                    </select>
                                                    @error('percentage_cash')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="value">{{ __('Value') }} </label>
                                                <div class="col-md-6">
                                                    <input type="number" step="0.01" value="" id="value" class="form-control"  max="6"
                                                            placeholder="{{ __('Value') }}">
                                                    @error('value')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <button type="button" class="btn btn-primary" id="btnRoll">
                                                     {{ __('New') }}
                                                </button>
                                            </div>
                                            
                                            @endif

                                            {{-- <div class="form-group row"> --}}
                                                
                                                <div class="row">
                                                    <table class="table table-striped table-bordered" id="tblRoll">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('Category') }}</th>
                                                                <th>{{ __('Up Down') }}</th>
                                                                <th>{{ __('Percentage Cash') }}</th>
                                                                <th>{{ __('Value') }}</th>
                                                                <th> </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if (isset($rolls))
                                                        @foreach ($rolls as $roll)
                                                            <tr>
                                                                <td>{{ $roll->getCategory()  }}</td>
                                                                <td>{{ $roll->getUpDown() }}</td>
                                                                <td>{{ $roll->getPercentageCash() }}</td>
                                                                <td>{{ $roll->value }}</td>
                                                                <td>
                                                                    @if ($datas->status == 0)
                                                                        <a href="{{route('admin.pricelist.roll.delete',[$datas->id, $roll->id])}}" class="btn btn-danger" ><i class="ft-trash-2"></i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                            {{-- </div> --}}

                                        </div>
                                        @endif
                                        {{-- End No Copy No Roll --}}

                                        
                                        @if (!isset($datas->copy_from ) || $datas->status != 0)
                                        {{-- Add Servese --}}
                                        <h4 class="form-section"><i class="ft-home"></i> {{ __('Service') }}   </h4>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="service_id">{{ __('Service') }}</label>
                                                <div class="col-md-6">
                                                    <select class="select2 form-control" id="service_id">
                                                        <option value="">-- {{ __('Service') }} --</option>
                                                        @foreach($services as $service)
                                                            <option value="{{ $service->id }}">
                                                                @if (App::getLocale() == 'ar')
                                                                    {{ $service->name_ar}}
                                                                @else
                                                                    {{ $service->name_en}}
                                                                @endif
                                                                
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('service_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="value">{{ __('Value') }} </label>
                                                <div class="col-md-6">
                                                    <input type="number" step="0.01" value="" id="valueSrv" class="form-control"  max="6"
                                                            placeholder="{{ __('0.00') }}">
                                                    @error('value')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <button type="button" class="btn btn-primary" id="btnSrv">
                                                     {{ __('New') }}
                                                </button>
                                            </div>

                                            <div class="row">
                                                <table class="table table-striped table-bordered" id="tblService">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('Service') }}</th>
                                                            <th>{{ __('Price') }}</th>
                                                            <th> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if (isset($srvs))
                                                    @foreach ($srvs as $srv)
                                                        <tr>
                                                            <td>{{ $srv->getService()  }}</td>
                                                            <td>{{ $srv->price }}</td>
                                                            <td>
                                                                <a href="{{route('admin.pricelist.service.delete',[$datas->id, $srv->id])}}" class="btn btn-danger" ><i class="ft-trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        {{-- End Add Servese --}}

                                        {{-- Add Package --}}
                                        <h4 class="form-section"><i class="ft-home"></i> {{ __('Package') }}   </h4>

                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="package_id">{{ __('Package') }}</label>
                                                <div class="col-md-6">
                                                    <select class="select2 form-control" id="package_id">
                                                        <option value="">-- {{ __('Package') }} --</option>
                                                        @foreach($packages as $package)
                                                            <option value="{{ $package->id }}">
                                                                {{ $package->getMyName() }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 label-control" for="value">{{ __('Value') }} </label>
                                                <div class="col-md-6">
                                                    <input type="number" step="0.01" value="" id="valuePack" class="form-control"  max="6"
                                                            placeholder="{{ __('0.00') }}">
                                                    @error('value')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <button type="button" class="btn btn-primary" id="btnPack">
                                                     {{ __('New') }}
                                                </button>
                                            </div>

                                            <div class="row">
                                                <table class="table table-striped table-bordered" id="tblPackage">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('Package') }}</th>
                                                            <th>{{ __('Price') }}</th>
                                                            <th> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if (isset($packs))
                                                    @foreach ($packs as $pack)
                                                        <tr>
                                                            <td>{{ $pack->getPackage()  }}</td>
                                                            <td>{{ $pack->price }}</td>
                                                            <td>
                                                                <a href="{{route('admin.pricelist.service.delete',[$datas->id, $pack->id])}}" class="btn btn-danger" ><i class="ft-trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        {{-- End Add Package --}}


                                        @endif
                                        
                                            
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

            // service Price
            $('#service_id').change(function () {
                let service_id = $("#service_id option:selected").val();
                let price_list_id= {{ $datas->id }};
                let _token = '{{ csrf_token() }}';
                $.ajax({
                    url: "{{ route('ajax.service.get.price') }}",
                    type: 'post',
                    dataType: 'json',
                    data:{
                        service_id :service_id,
                        price_list_id :price_list_id,
                        _token: _token
                    },
                    success: function (response) {
                        // console.log(response)
                        if(response == null){
                            console.log('Not Found');
                        }else {
                            $('#valueSrv').val(response.price);
                        }
                    }
                });
            });

            // Package Price
            $('#package_id').change(function () {
                let package_id = $("#package_id option:selected").val();
                let price_list_id= {{ $datas->id }};
                let _token = '{{ csrf_token() }}';
                $.ajax({
                    url: "{{ route('ajax.package.get.price') }}",
                    type: 'post',
                    dataType: 'json',
                    data:{
                        package_id :package_id,
                        price_list_id :price_list_id,
                        _token: _token
                    },
                    success: function (response) {
                        // console.log(response)
                        if(response == null){
                            console.log('Not Found');
                        }else {
                            $('#valuePack').val(response.price);
                        }
                    }
                });
            });

            // add Package
            $('#btnPack').click(function () {

            let package_id = $("#package_id option:selected").val();
            let package_id_text = $("#package_id option:selected").text();
            let valuePack = $("#valuePack").val();
            let price_list_id = {{ $datas->id }}
            let _token = '{{ csrf_token() }}';

            if(package_id == ""){
                alert("Package Mandatory");
            }else if(valuePack == ""){
                alert("Price Mandatory");
            }else if(valuePack.length  > 9 ){
                alert("Price cann't be over 6 number");
            }else{
                $.ajax({
                    url: "{{ route('ajax.pricelist.set.service') }}",
                    type: 'POST',
                    dataType: 'json',
                    data:{
                        package_id :package_id,
                        price:valuePack,
                        price_list_id:price_list_id,
                        _token: _token
                    },
                    success: function (response) {
                        $('#package_id').val('').change();
                        $('#valuePack').val('');
                        let url = '{{route("admin.pricelist.service.delete",[ $datas->id,":srvid"])}}';
                        url = url.replace(':srvid', response.srvid);
                        $('#tblPackage tr:last').after('<tr><td>'+package_id_text+'</td><td>'+valuePack+'</td><td>'+
                            '<a href="'+url+'" class="btn btn-danger" ><i class="ft-trash-2"></i></a>'+'</td></tr>');
                    }
                    // error: function (xhr, ajaxOptions, thrownError) {
                    //     // console.log(xhr);
                    // }
                });
            }
            });

            // add Service
            $('#btnSrv').click(function () {

            let service_id = $("#service_id option:selected").val();
            let service_id_text = $("#service_id option:selected").text();
            let value = $("#valueSrv").val();
            let price_list_id = {{ $datas->id }}
            let _token = '{{ csrf_token() }}';

            if(service_id == ""){
                alert("Service Mandatory");
            }else if(value == ""){
                alert("Value Mandatory");
            }else if(value.length  > 9 ){
                alert("Value cann't be over 6 number");
            }else{
                $.ajax({
                    url: "{{ route('ajax.pricelist.set.service') }}",
                    type: 'POST',
                    dataType: 'json',
                    data:{
                        service_id :service_id,
                        price:value,
                        price_list_id:price_list_id,
                        _token: _token
                    },
                    success: function (response) {
                        $('#service_id').val('').change();
                        $('#valueSrv').val('');
                        let url = '{{route("admin.pricelist.service.delete",[ $datas->id,":srvid"])}}';
                        url = url.replace(':srvid', response.srvid);
                        $('#tblService tr:last').after('<tr><td>'+service_id_text+'</td><td>'+value+'</td><td>'+
                            '<a href="'+url+'" class="btn btn-danger" ><i class="ft-trash-2"></i></a>'+'</td></tr>');
                        
                        // console.log(response.srvid);

                    }
                    // error: function (xhr, ajaxOptions, thrownError) {
                    //     // console.log(xhr);
                    // }
                });
            }
            });

            // add Roll
            $('#btnRoll').click(function () {

                let category_id = $("#category_id option:selected").val();
                let category_id_text = $("#category_id option:selected").text();
                let up_down = $("#up_down option:selected").val();
                let up_down_text = $("#up_down option:selected").text();
                let percentage_cash = $("#percentage_cash option:selected").val();
                let percentage_cash_text = $("#percentage_cash option:selected").text();
                let value = $("#value").val();
                let price_list_id = {{ $datas->id }}
                let _token   = '{{ csrf_token() }}';

                if(category_id == ""){
                    alert("Category Mandatory");
                }else if(value == ""){
                    alert("Value Mandatory");
                }else if(value.length  > 9 ){
                    alert("Value cann't be over 6 number");
                }else{
                    $.ajax({
                        url: "{{ route('ajax.pricelist.set.roll') }}",
                        type: 'POST',
                        dataType: 'json',
                        data:{
                            category_id:category_id,
                            up_down:up_down,
                            percentage_cash:percentage_cash,
                            value:value,
                            price_list_id:price_list_id,
                            _token: _token
                        },
                        success: function (response) {
                            $('#category_id').val('').change();
                            $('#value').val('');
                            let url = '{{route("admin.pricelist.roll.delete",[ $datas->id,":rollid"])}}';
                            url = url.replace(':rollid', response.rollid);
                            $('#tblRoll tr:last').after('<tr><td>'+category_id_text+'</td><td>'+up_down_text+'</td><td>'+percentage_cash_text+'</td><td>'+value+'</td><td>'+
                                '<a href="'+url+'" class="btn btn-danger" ><i class="ft-trash-2"></i></a>'+'</td></tr>');
                            
                            // console.log(response.rollid);

                        }
                        // error: function (xhr, ajaxOptions, thrownError) {
                        //     // console.log(xhr);
                        // }
                    });
                }
            });

           

            
/*
            $('#user_id').change(function () {
                $.ajax({
                    url: '../getUserInfo/' + $('#user_id').val(),
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response)
                        if(response == null){
                            console.log('Not Found');
                        }else {
                            console.log(response);
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
*/
            
        });
    </script>
@endsection
