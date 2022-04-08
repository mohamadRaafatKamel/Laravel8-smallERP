@extends('layouts.admin')
@section('title','تعديل')
@section('product_view','')
@section('content')
<?php 
if(! $permissoin = \App\Models\Role::havePremission(['product_idt']))
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
                                <li class="breadcrumb-item"><a href="{{route('admin.product')}}">  {{ __('Product') }} </a>
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
                                        <form class="form" action="{{route('admin.product.update',$datas -> id)}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                        @endif
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> البيانات  </h4>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاسم  </label>
                                                            <input type="text" value="{{ $datas -> name }}" id="name"
                                                                   class="form-control" required
                                                                   placeholder="الاسم "
                                                                   name="name">
                                                            @error('name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="1" name="exp_have"
                                                                   id="exp_have"
                                                                   class="switchery" data-color="success"
                                                                   @if($datas->exp_have  == 1 ) checked @endif/>
                                                            <label for="exp_have"
                                                                   class="card-title ml-1">{{ __('Have Exp') }} </label>
                                                            @error('exp_have')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exp_long"> {{ __('Exp Long') }}  </label>
                                                            <input type="number" value="{{ $datas -> exp_long }}" id="exp_long"
                                                                   class="form-control"
                                                                   placeholder="{{ __('Exp Long') }}"
                                                                   name="exp_long">
                                                            @error('exp_long')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"  value="0" name="status" {{ $readonly }}
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"

                                                                   @if($datas -> status  == 0 ) checked @endif
                                                            />
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة </label>

                                                            @error('status')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                @if ($permissoin)
                                                <div class="form-actions">
                                                    <button type="button" class="btn btn-warning mr-1"
                                                            onclick="history.back();">
                                                         تراجع
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                          تحديث
                                                    </button>
                                                </div>
                                            @endif



                                                <h4 class="form-section"><i class="ft-home"></i> شراء </h4>


                                            <div class="row">

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="category"> الاقسام  </label>
                                                        <input type="text" id="category"
                                                               class="form-control" 
                                                               placeholder="الاقسام ">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="amount"> {{ __('Value') }}  </label>
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

                                                <div class="col-md-1">
                                                    <button type="button" style="margin-top: 25px;" class="btn btn-primary" id="btnBuy">
                                                        {{ __('New') }}
                                                   </button>
                                                </div>
                                            </div>
                                          
                                            <div class="row">
                                                <table class="table table-striped table-bordered" id="tblService">
                                                    <thead>
                                                        <tr>
                                                            <th>الاقسام</th>
                                                            <th>{{ __('Value') }}</th>
                                                            <th>{{ __('Unit') }}</th>
                                                            <th> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if (isset($prbuys))
                                                    @foreach ($prbuys as $prbuy)
                                                        <tr>
                                                            <td>{{ $prbuy->category }}</td>
                                                            <td>{{ $prbuy->amount  }}</td>
                                                            <td>{{ $prbuy->getUnit() }}</td>
                                                            <td>
                                                                <a href="{{route('admin.product.buy.delete',[$datas->id, $prbuy->id])}}" class="btn btn-danger" ><i class="ft-trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        {{-- End Add Buy --}}
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

           
            // add Service
            $('#btnBuy').click(function () {

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
                        
                        // console.log(response.srvid);

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
