@extends('layouts.admin')
@section('title','التقييم')
@section('serves_static','')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">  التقييم </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">  التقييم
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <!-- Data Color Chart -->
                    <div class="row">
                        <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                            <h4 class="card-title">ايه رائيك في خدمة المستشفي المنزلي</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
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
                                <div id="data-color"></div>
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
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/charts/c3.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css-rtl/plugins/charts/c3-chart.css')}}">
@endsection



@section('script')
   

    <script src="{{asset('assets/admin/vendors/js/charts/d3.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/vendors/js/charts/c3.min.js')}}" type="text/javascript"></script>
    <script>
        $(window).on("load",function(){
            var dataColor=c3.generate({
                bindto:"#data-color",
                size:{height:400},
                axis: {
                    x: {
                        type: 'category',
                        categories: ['واقعية', 'غير واقعية', 'ممكن اجربها', 'لم اجربها']
                    }
                },
                data:{
                    columns:[
                        ["20:30" {{ $data['opinion1'] }} ],
                        ["30:40" {{ $data['opinion2'] }} ],
                        ["40:50" {{ $data['opinion3'] }} ],
                        ["50<" {{ $data['opinion4'] }} ],
                    ],
                type:"bar",
                colors:{data1:"#673AB7",data2:"#E91E63"},
                color:function(color,d){
                    return d.id&&"data3"===d.id?d3.rgb(color).darker(d.value/150):color}
                },
                grid:{y:{show: true}}
            });
            $(".menu-toggle").on("click",function(){
                dataColor.resize()
            })
        });
    </script>
@endsection
