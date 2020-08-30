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
    @if (request()->is('world_map'))
    <link href="{{ asset('css/charts.css') }}" rel="stylesheet">
    <script src="{{ asset('js/amchart.js') }}" defer></script>
    @endif
    
    @if (request()->is('covid_19'))
    <link href="{{ asset('css/charts.css') }}" rel="stylesheet">
    <script src="{{ asset('js/covid-chart.js') }}" defer></script>
    @endif

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        main{
            min-height: 700px;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Web') }} --}}
                    Web Geo
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ (request()->is('covid_19')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('covid_map') }}">COVID Map <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item {{ (request()->is('world_map')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('world_map') }}">Explore <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="{{ (request()->segment(1) == 'blog') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('blog') }}">Blog <span
                                    class="sr-only">(current)</span></a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if (Auth::user()->img)
                                <img src="{{ route('get_avatar', ['img' => Auth::user()->img]) }}" alt="profile_pic"
                                    style="width: 40px; height: 40px; border-radius: 50px;">
                                @endif
                                <span class="caret">{{ Auth::user()->f_name }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    {{ __('Administration') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
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
            <h1 class="text-center">@yield('title')</h1>
            @yield('content')
        </main>
    </div>
    <footer class="footer mt-auto py-3 bg-dark text-white">
        <div class="container">
            <div class="row row-cols-2">
                <div class="col-10">
                    <p class="text-center"><b> Web Geo - Just explore the world </b></p>
                    <span class="text-muted"> By Yassín Orlando Vázquez Paz | <a href="https://yassinovp.xyz" target="_blank" class="text-white">yassinovp.xyz</a></span>
                </div>
                <div class="col-2">
                    <a href="#top" style="color: white;">
                        <svg class="float-right" width="3em" height="3em" viewBox="0 0 16 16"
                            class="bi bi-arrow-up-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-10.646.354a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 6.207V11a.5.5 0 0 1-1 0V6.207L5.354 8.354z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

</body>
    @if (request()->is('world_map') || request()->is('covid_19'))
        <script src="https://cdn.amcharts.com/lib/4/core.js" ></script>
        <script src="https://cdn.amcharts.com/lib/4/maps.js" ></script>
        <script src="https://cdn.amcharts.com/lib/4/geodata/worldLow.js" ></script>
        <script src="https://cdn.amcharts.com/lib/4/geodata/data/countries2.js" ></script>
        <script src="https://cdn.amcharts.com/lib/4/themes/dark.js" ></script>
        <script src="https://cdn.amcharts.com/lib/4/themes/animated.js" ></script>
        <script src="https://cdn.amcharts.com/lib/4/charts.js" ></script>
        <script src="https://covid.amCharts.com/data/js/world_timeline.js" ></script>
        <script src="https://covid.amCharts.com/data/js/total_timeline.js" ></script>
    @endif

</html>