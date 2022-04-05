@extends('layouts.admin')
@section('title', __('Out Patient') )
@section('report_out','')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">  {{ __('Out Patient') }} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item">{{ __('Out Patient') }}</li>
                                
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"> {{ __('Out Patient') }} </h4>
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

                                @include('admin.include.alerts.success')
                                @include('admin.include.alerts.errors')

                                

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        @if (isset($erorrMsg))
                                            <div class="alert alert-danger text-center" role="alert">
                                                <p>{{ $erorrMsg }} </p>
                                            </div>
                                        @endif
                                        <form class="form form-horizontal" action="{{route('admin.report.out')}}" method="GET" >
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <label>{{ __('Type') }} </label>
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="">{{ __('All') }}</option>
                                                        <option value="1" @if(isset($_GET['type'])) @if ($_GET['type'] == "1") selected @endif @endif >
                                                            {{ __('Emergency Call') }}</option>
                                                        <option value="2" @if(isset($_GET['type'])) @if ($_GET['type'] == "2") selected @endif @endif >
                                                            {{ __('Out Patient') }}</option>
                                                        <option value="3" @if(isset($_GET['type'])) @if ($_GET['type'] == "3") selected @endif @endif >
                                                            {{ __('In Patient') }}</option>
                                                        <option value="4" @if(isset($_GET['type'])) @if ($_GET['type'] == "4") selected @endif @endif >
                                                            {{ __('Lab') }}</option>    
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>{{ __('State') }} </label>
                                                    <select name="state" id="state" class="form-control">
                                                        <option value="">{{ __('All') }}</option>
                                                        <option value="1" @if(isset($_GET['state'])) @if ($_GET['state'] == "1") selected @endif @endif >
                                                            {{ __('New Request') }}</option>
                                                        <option value="2" @if(isset($_GET['state'])) @if ($_GET['state'] == "2") selected @endif @endif >
                                                            {{ __('Hold') }}</option>
                                                        <option value="6" @if(isset($_GET['state'])) @if ($_GET['state'] == "6") selected @endif @endif >
                                                            {{ __('Hold to Approve') }}</option>
                                                        <option value="7" @if(isset($_GET['state'])) @if ($_GET['state'] == "7") selected @endif @endif >
                                                            {{ __('Following') }}</option>
                                                        <option value="4" @if(isset($_GET['state'])) @if ($_GET['state'] == "4") selected @endif @endif >
                                                            {{ __('DONE') }}</option>
                                                        <option value="5" @if(isset($_GET['state'])) @if ($_GET['state'] == "5") selected @endif @endif >
                                                            {{ __('Cancel') }}</option>    
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>{{ __('Date') }} </label>
                                                    <select name="date" id="type" class="form-control">
                                                        <option value="">{{ __('All') }}</option>
                                                        <option value="Schedule" @if(isset($_GET['date'])) @if ($_GET['date'] == "1") selected @endif @endif >
                                                            {{ __('Schedule') }}</option>
                                                        <option value="ServiceEnd" @if(isset($_GET['date'])) @if ($_GET['date'] == "2") selected @endif @endif >
                                                            {{ __('End of Service Date') }}</option>
                                                        <option value="RequestEnd" @if(isset($_GET['date'])) @if ($_GET['date'] == "3") selected @endif @endif >
                                                            {{ __('Request End Date') }}</option>
                                                        <option value="Created" @if(isset($_GET['date'])) @if ($_GET['date'] == "4") selected @endif @endif >
                                                            {{ __('Created at') }}</option>    
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>{{ __('Date From') }} </label>
                                                    <input type="date" @if(isset($_GET['date_from'])) value="{{ $_GET['date_from'] }}" @endif 
                                                        class="form-control" placeholder="{{ __('From') }}" name="date_from">
                                                </div>
                                                <div class="col-md-2">
                                                    <label>{{ __('Date To') }} </label>
                                                    <input type="date" @if(isset($_GET['date_to'])) value="{{ $_GET['date_to'] }}" @endif 
                                                        class="form-control" placeholder="{{ __('To') }}" name="date_to">
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="submit" class="btn btn-primary" style="margin-top:30px">
                                                        {{ __('Search') }}
                                                    </button>
                                                </div>
                                                {{-- <div class="col-md-1">
                                                    <a class="btn btn-danger" href="{{ route('admin.request.in') }}">
                                                        {{ __('Reset') }}</a>
                                                </div> --}}
                                            </div>

                                        </form>

                                        <div class="table-responsive">
                                                <table
                                                    class="table table-striped table-bordered ordering-print">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('Created at') }}</th>
                                                        <th>{{ __('Request End Date') }}</th>
                                                        <th>{{ __('End of Service Date') }}</th>
                                                        <th>{{ __('Schedule') }}</th>
                                                        <th>{{ __('Type') }}</th>
                                                        <th>الاسم</th>
                                                        <th>القائم بالرعاية</th>
                                                        <th>الهاتف</th>
                                                        @foreach ($cats as $cat)
                                                            <th>{{ $cat }}</th>
                                                        @endforeach
                                                        <th> الطبيب المعالج</th>
                                                        <th> كوفيد19</th>
                                                        <th> Time</th>
                                                        <th> العنوان</th>
                                                        <th> {{ __('CC Agent') }}</th>
                                                        <th> OPD</th>
                                                        <th> {{ __('Feedback') }}</th>
                                                        <th> {{ __('request state') }}</th>
                                                        <th> {{ __('name of nurse') }}</th>
                                                        <th> {{ __('name of doc') }}</th>
                                                        <th> {{ __('notes') }}</th>
                                                        <th> {{ __('fees') }}</th>
                                                        <th> {{ __('bill serial number') }}</th>
                                                        <th> {{ __('paid') }}</th>
                                                        <th> {{ __('is codezone') }}</th>
                                                        <th> {{ __('Call') }}</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @isset($requests)
                                                        @if (count($requests) > 0)
                                                        @foreach($requests as $request)
                                                            <tr>
                                                                <th>{{$request->created_at}}</th>
                                                                <th>{{$request->date_out}}</th>
                                                                <th>{{$request->end_service_date}}</th>
                                                                <th>{{$request->schedule_date}}</th>
                                                                <td>{{$request->getMyType()}}</td>
                                                                <td>{{$request->fullname}}</td>
                                                                <td>{{$request->name_caregiver}}</td>
                                                                <td>{{$request->phone}}</td>
                                                                @foreach ($cats as $id => $cat)
                                                                    @if (isset($request ->status_cc[$id]))
                                                                        <th>{{ $request ->status_cc[$id] }}</th>
                                                                    @else
                                                                        <th></th>
                                                                    @endif
                                                                @endforeach
                                                                <th>{{$request->physician}}</th>
                                                                <td>{{ __($request->covid19)}}</td>
                                                                <th> ___</th>
                                                                <td>{{$request->adress}}</td>
                                                                <td>{{$request->cc_admin_id }}</td>
                                                                <td>{{$request->opd_admin_id }}</td>
                                                                <th>{{$request->feedback}}</th>
                                                                <td>{{$request->getRequestState($request -> status_in_out) }}</td>
                                                                <th>{{$request->nurse_id}} </th>
                                                                <th>{{$request->doctor_id}} </th>
                                                                <td>{{$request->doc_note}}</td>
                                                                <td>{{$request->real_cost}}</td>
                                                                <td>{{$request->bill_serial}}</td>
                                                                <th>{{ __($request->pay_or_not)}}</th>
                                                                <th>{{$request->code_zone_patient_id}}</th>
                                                                <th>
                                                                    @foreach ($request->getMyCalls() as $call)
                                                                        {{ $call }};
                                                                    @endforeach 
                                                                </th>

                                                            </tr>
                                                        @endforeach
                                                        @endif
                                                    @endisset
                                                    </tbody>
                                                    {{-- <tfoot>
                                                        <tr>
                                                            <th> id</th>
                                                            <th>العميل</th>
                                                            <th> موبيل</th>
                                                            <th> موبيل</th>
                                                            <th> OPD</th>
                                                            <th> {{ __('Date') }}</th>
                                                            <th> الحاله</th>
                                                        </tr>
                                                    </tfoot> --}}
                                                </table>
                                            
                                            <div class="justify-content-center d-flex">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
