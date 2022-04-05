<style>
    .single-page .nav-bar{
        display:block;
        position:fixed;
        background-color: #f0f4f8;
        padding: 0px;
    }
</style>

<div class="nav-bar">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                <div class="site-branding d-flex align-items-center">
                    <a class="d-block" href=" {{ route('home', app()->getLocale())}} " rel="home">
                        <img class="d-block" src="{{asset('assets/front/images/logo.png')}}" alt="logo">
                    </a>
                </div><!-- .site-branding -->
                <nav class="site-navigation d-flex justify-content-end align-items-center" id="navbarNavDropdown">
                    <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-items-center navbar-nav">
                        <li><a href="{{ route('home', app()->getLocale()) }}">{{ __('Home') }}</a></li> {{--  class="current-menu-item" --}}
{{--                        <li><a href="about.html">About us</a></li>--}}
{{--                        <li><a href="contact.html">Contact</a></li>--}}
                        @guest
                            <li><a href="{{ route('login', app()->getLocale()) }}">{{ __('Login') }}</a></li>
                            <li class="call-btn button gradient-bg mt-1 mt-md-0" style="min-width: auto">
                                <a class="d-flex justify-content-center align-items-center" href="{{ route('register', app()->getLocale())}}">
                                    {{ __('Sign up') }}</a>
                            </li>
                        @else
                            @if(\Illuminate\Support\Facades\Auth::user()->type == '2')
                            <li><a href="{{ route('user.doc.request', app()->getLocale()) }}">{{ __('Doctor Request') }}</a></li>
                            @endif
                            <li><a href="{{ route('user.all.request', app()->getLocale()) }}">{{ __('All Request') }}</a></li>

                            <li><a href=" {{ route('logout', app()->getLocale()) }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a></li>
                            <form id="logout-form" action=" {{ route('logout', app()->getLocale()) }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <li class="call-btn button gradient-bg mt-1 mt-md-0" style="min-width: auto">
                                <a class="d-flex justify-content-center align-items-center" href="{{ route('home.user.info', app()->getLocale()) }}">
                                    {{ Auth::user()->title." ". Auth::user()->fname }}</a>
                            </li>
                        @endguest

                        @if(app()->getLocale() == 'ar')
                            <li class="call-btn button gradient-bg mt-1 mt-md-0" style="min-width: auto">
                                <a class="d-flex justify-content-center align-items-center"
                                   href="{{ route('home','en') }}">
                                    EN</a>
                            </li>
                        @else
                            <li class="call-btn button gradient-bg mt-1 mt-md-0" style="min-width: auto">
                                <a class="d-flex justify-content-center align-items-center"
                                   href="{{ route('home','ar') }}">
                                    ع</a>
                            </li>
                        @endif

                        <li class="call-btn button gradient-bg mt-3 mt-md-0" style="min-width: auto">
                            <a class="d-flex justify-content-center align-items-center" href="tel:15848" ><img
                                    src="{{asset('assets/front/images/emergency-call.png')}}"> 15848</a>
                        </li>
                        <li class="call-btn button gradient-bg00 mt-1 mt-md-0" style="min-width: auto;background-color: #25D366;border-bottom-color: #25D366;">
                            <a class="d-flex justify-content-center align-items-center"
                               href="https://api.whatsapp.com/send?phone=15848">
                                <i style="font-size: 32px;" class="fa fa-whatsapp" aria-hidden="true"></i></a>
                        </li>

                    </ul>
                </nav><!-- .site-navigation -->

                <div class="hamburger-menu d-lg-none">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div><!-- .hamburger-menu -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .nav-bar -->
