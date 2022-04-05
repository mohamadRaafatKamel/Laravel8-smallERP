<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
          content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>CareHub | @yield('title')</title>
    <link rel="apple-touch-icon" href="{{asset('assets/front/images/Logo.png')}}">
{{--    <link rel="apple-touch-icon" href="{{asset('assets/admin/images/ico/apple-icon-120.png')}}">--}}
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/admin/images/ico/favicon.ico')}}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
          rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css-rtl/plugins/animate/animate.css')}}">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css-rtl/vendors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/tables/datatable/datatables.min.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/weather-icons/climacons.min.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/fonts/meteocons/style.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/charts/morris.css')}}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/charts/chartist.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/forms/selects/select2.min.css')}}">
    {{-- <link rel="stylesheet" type="text/css" --}}
          {{-- href="{{asset('assets/admin/vendors/css/charts/chartist-plugin-tooltip.css')}}"> --}}
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/forms/toggle/switchery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css-rtl/pages/chat-application.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css-rtl/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css-rtl/custom-rtl.css')}}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/admin/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css-rtl/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css-rtl/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css-rtl/pages/timeline.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/cryptocoins/cryptocoins.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/extensions/datedropper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/extensions/timedropper.min.css')}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css-rtl/style-rtl.css')}}">
    <!-- END Custom CSS-->
{{--    @notify_css--}}
    @yield('style')
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        .mr15 {
            margin-right: 15px;
        }
    </style>
</head>
<body class="vertical-layout vertical-menu 2-columns  @if(Request::is('admin/users/tickets/reply*')) chat-application @endif menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-menu" data-col="2-columns">
<!-- fixed-top-->
@include('admin.include.header')
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('admin.include.sidebar')

@yield('content')
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('admin.include.footer')

{{--@notify_js--}}
{{--@notify_render--}}

<!-- BEGIN VENDOR JS-->
<script src="{{asset('assets/admin/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<script src="{{asset('assets/admin/vendors/js/tables/datatable/datatables.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/vendors/js/tables/datatable/dataTables.buttons.min.js')}}"
        type="text/javascript"></script>

<script src="{{asset('assets/admin/vendors/js/forms/toggle/bootstrap-switch.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/vendors/js/forms/toggle/bootstrap-checkbox.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/scripts/forms/switch.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/scripts/forms/select/form-select2.js')}}" type="text/javascript"></script>

<!-- BEGIN PAGE VENDOR JS-->

{{-- <script src="{{asset('assets/admin/vendors/js/extensions/datedropper.min.js')}}" type="text/javascript"></script> --}}
{{-- <script src="{{asset('assets/admin/vendors/js/extensions/timedropper.min.js')}}" type="text/javascript"></script> --}}

{{-- <script src="{{asset('assets/admin/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script> --}}
{{-- <script src="{{asset('assets/admin/js/scripts/pages/chat-application.js')}}" type="text/javascript"></script> --}}
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{asset('assets/admin/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/core/app.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/scripts/customizer.js')}}" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('assets/admin/js/scripts/pages/dashboard-crypto.js')}}" type="text/javascript"></script>


<script src="{{asset('assets/admin/js/scripts/tables/datatables/datatable-basic.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/scripts/tables/datatables/datatable-api.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/admin/js/scripts/extensions/date-time-dropper.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->

<script src="{{asset('assets/admin/js/scripts/forms/checkbox-radio.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/scripts/notify.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/scripts/modal/components-modal.js')}}" type="text/javascript"></script>

<!-- Firbase -->

{{-- <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script> --}}
{{-- <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-messaging.js"></script> --}}
{{-- <script src="{{asset('assets/admin/js/scripts/firebase.js')}}" type="text/javascript"></script> --}}


<script>
    // Notification 
    $(document).ready(function() {


        function CountEmergency() {
            $.ajax({
                url: 'https://' + window.location.hostname +'/admin/getnotification',
                // url: 'http://' + window.location.hostname +'/carehome/admin/getnotification',
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    // console.log(response);
                    let note_dev = "";
                    let note_total = response.newCC + response.newEM + response.newIN + response.newOUT;
                    
                    if(response.newCC != 0){
                        note_dev +='<a href="{{route("admin.request.cc")}}"><div class="media">'+
                                '<div class="media-left align-self-center"><i class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i></div><div class="media-body">'+
                                    '<h6 class="media-heading yellow darken-3"> <span> New '+ response.newCC +'</span> <span> in All Request </span> </h6>'+
                                '</div></div></a>';
                        $.notify("New "+ response.newCC +" in All Request", "warn");
                    }
                    if(response.newEM != 0){
                        note_dev +='<a href="{{route("admin.request.emergency")}}"><div class="media">'+
                                '<div class="media-left align-self-center"><i class="ft-alert-triangle icon-bg-circle bg-red bg-darken-1"></i></div><div class="media-body">'+
                                    '<h6 class="media-heading red darken-1"> <span> New '+ response.newEM +'</span> <span> in Emergency Request </span> </h6>'+
                                '</div></div></a>';
                        $.notify("New "+ response.newEM +" in Emergency Request", "error");
                    }
                    if(response.newIN != 0){
                        note_dev +='<a href="{{route("admin.request.in")}}"><div class="media">'+
                                '<div class="media-left align-self-center"><i class="ft-alert-triangle icon-bg-circle bg-cyan"></i></div><div class="media-body">'+
                                    '<h6 class="media-heading"> <span> New '+ response.newIN +'</span> <span> in InPatient </span> </h6>'+
                                '</div></div></a>';
                        $.notify("New "+ response.newIN +" in InPatient", "info");
                        // playPromise;
                        // $.playSound( "{{ asset( 'assets/admin/sound/samsung_galaxy_s_iii.mp3' ) }}" );
                    }
                    if(response.newOUT != 0){
                        note_dev +='<a href="{{route("admin.request.out")}}"><div class="media">'+
                                '<div class="media-left align-self-center"><i class="ft-alert-triangle icon-bg-circle bg-cyan"></i></div><div class="media-body">'+
                                    '<h6 class="media-heading"> <span> New '+ response.newOUT +'</span> <span> in OutPatient </span> </h6>'+
                                '</div></div></a>';
                        $.notify("New "+ response.newOUT +" in OutPatient", "info" );
                    }

                    if(note_total == 0){
                        note_dev ='<li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="#">No Any Request</a></li>';
                    }

                    $('#note_count_total').text(note_total);
                    $('#note_all_massage').html(note_dev);

                    // console.log(note_dev);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    // input.val(0);
                    // console.log('Error');
                }
            });
        }
        
        CountEmergency();

        setInterval(function() {
            CountEmergency();
        }, 120 * 1000);

    });


</script>

@yield('script')
</body>
</html>
