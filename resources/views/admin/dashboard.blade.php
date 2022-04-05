@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div id="crypto-stats-3" class="row">

                    {{-- <center>
                        <button id="btn-nft-enable" onclick="setnotificationtocken()" class="btn btn-danger btn-xs btn-flat">Notification</button>
                        <input type="text" id="tokk"/>
                    </center> --}}

                   
                </div>
                <!-- Candlestick Multi Level Control Chart -->
            </div>
        </div>
    </div>
@endsection

@section('script')

{{-- <script src="https://www.gstatic.com/firebasejs/9.6.8/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-messaging.js"></script> --}}

<script>
    jQuery(document).ready(function ($) {
        // console.log("123456");
        // messaging.getToken({ vapidKey: 'BETYgBkKbhosE_P53uzEFZWCs5shhvV92QAshApvlyC6w-E3H7YKrp1RQAECHNvsBtMUF8R0be8IIGJC-KNNkYg' }).then((currentToken) => {
        //     if (currentToken) {
        //         console.log(currentToken);
        //         // Send the token to your server and update the UI if necessary
        //         // ...
        //     } else {
        //         // Show permission request UI
        //         console.log('No registration token available. Request permission to generate one.');
        //         // ...
        //     }
        //     }).catch((err) => {
        //     console.log('An error occurred while retrieving token. ', err);
        //     // ...
        // });

        // Your web app's Firebase configuration
        // const firebaseConfig = {
        //     apiKey: "{{ config('services.firebase.api_key') }}",
        //     authDomain: "{{ config('services.firebase.auth_domain') }}",
        //     projectId: "{{ config('services.firebase.project_id') }}",
        //     storageBucket: "{{ config('services.firebase.storage_bucket') }}",
        //     messagingSenderId: "{{ config('services.firebase.messaging_sender_id') }}",
        //     appId: "{{ config('services.firebase.app_id') }}",
        //     measurementId: "{{ config('services.firebase.measurement_id') }}"
        // };

        // // Initialize Firebase
        // const app = firebase.initializeApp(firebaseConfig);

        // const messaging = firebase.messaging();
        // $('#tokk').val("qqqqqqqqq");
        // // messaging
        // .requestPermission()
        // .then(function () {
        //     return messaging.getToken()
        //     console.log("xxxxxxxxxxxx");
        // })
        // .then(function(token) {
        //     console.log(token);
        // }

        // const audio = new Audio( 'https://dl.dropboxusercontent.com/s/h8pvqqol3ovyle8/tom.mp3' );
        // audio.muted = true;

        // const alert_elem = confirm('Are you sure ?');
        // if (confirm('Are you sure ?')) {
        //     console.log('ok');
        // }else{
        //     console.log('cancel')
        // }
        

        // audio.play().then( () => {
        //     // already allowed
        //     alert_elem.remove();
        //     resetAudio();
        // } )
        // .catch( () => {
        // // need user interaction
        // alert_elem.addEventListener( 'click', ({ target }) => {
        //     if( target.matches('button') ) {
        //         const allowed = target.value === "1";
        //         if( allowed ) {
        //             audio.play()
        //             .then( resetAudio );
        //         }
        //         alert_elem.remove();
        //         }
        //     } );
        // } );


        // document.getElementById( 'btn' ).addEventListener( 'click', (e) => {
        // if( audio.muted ) {
        //     console.log( 'silent notification' );
        // }
        // else {
        //     audio.play();
        // }
        // } );

        // function resetAudio() {
        //     audio.pause();
        //     audio.currentTime = 0;
        //     audio.muted = false;
        // }

        // setInterval(function() {
        //     audio.play();
        // }, 20 * 1000);

        

    });
</script>
@endsection