<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ URL::asset('web-geo_icon.ico') }}" type="image/x-icon"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{-- {{ config('app.name', 'WebGeo') }} --}} Web Geo</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-secondary">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Web') }} --}}
                    Web Geo
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">COVID Map <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Explore <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('blog') }}">Blog <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register author') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->img)
                                        <img src="{{ route('get_avatar', ['img' => Auth::user()->img]) }}" alt="profile_pic" style="width: 40px; height: 40px; border-radius: 50px;">
                                    @endif
                                    <span class="caret"> {{ Auth::user()->f_name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                        {{ __('Administration') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container col-md-12">
                <div class="row justify-content-center" >
                    <div class="col-md-12">
                        <div class="card " style="background-color: #ff8300;">
                            <div class="card-header text-center text-white"><b>{{ __('Dashboard') }}</b></div>
                        </div>
                    </div>
                </div>
            
                <div class="row justify-content-center" >
                    <div class="col-md-2" style="margin-top: 20px">
                        <div class="card text-white bg-dark">
                            <div class="card-header text-center">{{ __('OPTIONS') }}</div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-dark"><a class="text-white" href="{{ route('home') }}"> Profile </a></li>
                                <li class="list-group-item bg-dark"><a class="text-white" href="{{ route('posts', ['id' => Auth::user()->id ]) }}"> Posts </a></li>
                                <li class="list-group-item bg-dark"><a class="text-white" href="{{ route('authors', ['id' => Auth::user()->id ]) }}"> Authors </a></li>
                                {{-- j --}}
                                @if (Auth::user()->role == 'admin')
                                    <li class="list-group-item bg-dark"><a class="text-white" href="{{ route('categories', ['id' => Auth::user()->id ]) }}"> Categories </a></li>
                                    <li class="list-group-item bg-dark"><a class="text-white" href="{{ route('countries', ['id' => Auth::user()->id ]) }}"> Countries </a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
            
                    <div class="col-md-10" style="margin-top: 20px">
                        <div class="card">
                            <div class="card-header text-center">@yield('title')</div>
                            <div class="card-body justify-content-center">
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ __('Process executed successfully') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>  
                                @elseif (session()->has('alert'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ __('You can not delete this user') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>     
                                @elseif (session()->has('alert-delete-post'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ __('You can not delete this post') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>  
                                @elseif (session()->has('alert-edit'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ __('You can not edit this user') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>                                    
                                @endif
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>