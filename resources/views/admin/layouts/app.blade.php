<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/ajax.js')}}"></script>
    <script src="{{asset('js/pusher.js')}}"></script>
    <script src="{{asset('js/select2.js')}}"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown dropdown-notifications">
                                <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{asset('/img/bell.png')}}" alt="">
                                    <span class="badge badge-light" id="count-notification">{{Auth::user()->unreadNotifications->count()}}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right menu-notification" aria-labelledby="navbarDropdown">
                                    <div class="menu-body">
                                       @for ($i = 0; $i < config('app.limit_notifications') ; $i++)
                                            @if (isset(Auth::user()->notifications[$i]))
                                                <a class="dropdown-item card notification-item @if(!Auth::user()->notifications[$i]->read_at) read @endif" href="{{Auth::user()->notifications[$i]->data['link']}}">
                                                    <h5 class="card-title">{{Auth::user()->notifications[$i]->data['title']}}</h5>
                                                    <p class="card-text">{{Auth::user()->notifications[$i]->data['content']}}</p>
                                                    <p class="card-text">{{Auth::user()->notifications[$i]->data['time']}}</p>
                                                </a>
                                            @endif
                                        @endfor 
                                    </div>
                                    <a class="dropdown-item" id="all" data-toggle="modal" data-target="#myModal">
                                        <p class="card-text all-text" >View all</p>
                                    </a>
                                </div>
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">All notifications</h4>
                                            </div>
                                            <div class="modal-body">
                                                @foreach (Auth::user()->notifications as $noti)
                                                    <a class="dropdown-item notification-item card @if(!$noti->read_at) read @endif" href="{{$noti->data['link']}}">
                                                        <h5 class="card-title">{{$noti->data['title']}}</h5>
                                                        <p class="card-text">{{$noti->data['content']}}</p>
                                                        <p class="card-text">{{$noti->data['time']}}</p>
                                                    </a>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="">
            @include('common.sidebar')
            @include('common.language')
            @yield('content')
        </main>
    </div>
    <script type="text/javascript">
        var key = '{{env("PUSHER_APP_KEY")}}'
        var count = {{Auth::user()->unreadNotifications->count()}}
    </script>
    <script type="text/javascript" src="{{asset('js/noti.js')}}"></script>
</body>
</html>
