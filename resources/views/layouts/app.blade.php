<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('msg.Mentalhealth') }}</title>


    <!-- Scripts -->
    <!--<script src="{{ asset('../resources/js/app.js') }}" defer></script>-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Styles -->
    <!--had to write style here as the cpanel doesn't read my css file-->
    <!--had to use outsource picture cause it doesn't read images too here-->
    <style>
            body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://p1.pxfuel.com/preview/233/266/532/mental-health-mental-wellness-mind-mindfulness.jpg');
            background-position: 35%;
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 100vh;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }
        
        .table {
            display: table !important;
        }
        
        .table-responsive {
            width: 95% !important;
            margin: 0px auto !important;
        }
        
        .table td,
        .table th {
            overflow-y: auto;
            padding: .25rem;
            font-size: 3px;
            color: #fff;
        }
        
        .table th div ,.table td div{
            color:#000;
        }
        
        h1,
        h5,
        h6 {
            color: white;
        }
        
        .btn {
            font-size: 10px !important;
            padding: 7px !important;
        }
        
        .width {
            max-width: 95vw;
            margin: 0px auto;
        }
        
        @media (min-width:576px) {
        
            .table td,
            .table th {
                font-size: 8px;
            }
        }
        
        @media (min-width:768px) {
        
            .table td,
            .table th {
                font-size: 12px;
            }
        
            .btn {
                font-size: 14px !important;
                padding: 12px !important;
            }
        }
        
        @media (min-width:992px) {
        
            .table td,
            .table th {
                font-size: 18px;
            }
        }
    </style>
    <!--<link href="{{ asset('../resources/css/app.css') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('home') }}">
                    {{ __('msg.Mentalhealth') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div>
                            <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{__('msg.Language')}}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <div class="text-center">
                                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                    </div>
                                    <br>
                                    @endforeach
                            </div>
                            </li>
                        </div>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('msg.Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('msg.Register') }}</a>
                                </li>
                            @endif
                            @if (Route::has('adminlogin'))
                                <li class="nav-item">
                                    <a class="nav-link" href='{{ url('admin/adminlogin') }}'>{{__('msg.Admin Login')}}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->{'name_' . LaravelLocalization::getcurrentlocale()} }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('msg.Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li>
                                @if (session('admindata'))
                                <a href='{{ url('admin/adminhome') }}' class="nav-link">{{__('msg.Admin Home')}}</a>
                                @endif
                            </li>
                            <li class="nav-item">
                                @if(!session('admindata'))
                                <a class="nav-link" href='{{ url('admin/adminlogin') }}'>{{__('msg.Admin Login')}}</a>
                                @endif
                            </li>
                            <li>
                                <a href='{{ url('user/display') }}' class="nav-link">{{__('msg.Personal Data')}}</a>
                            </li>
                            <li>
                                <a href='{{ url('problem/create') }}' class="nav-link">{{__('msg.Create Problem')}}</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <div class='width'>
            @yield('content')
        </div>
    </div>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
</body>
</html>

