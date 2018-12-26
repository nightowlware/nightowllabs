<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_TRACKING_ID') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', "{{ env('GOOGLE_ANALYTICS_TRACKING_ID') }}");
    </script>

</head>
<body>
    <div id="">
        <nav class="navbar navbar-expand-md navbar-custom navbar-laravel">
            <div style="max-width: none;" class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/owl_standalone.png" style="zoom: 50%"/>
                    {{config('app.name', 'Laravel')}}
                </a>
                <div>
                    SOMETHING HERE
                </div>

                <div class="" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{--<ul class="navbar-nav mr-auto">--}}

                    {{--</ul>--}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else

                            {{--User Menu--}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                {{--Render the navbar-menu--}}
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        {{ __('Profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('manageApi') }}">
                                        {{ __('API Keys') }}
                                    </a>

                                    {{--The logout link is a special-case that does a POST instead of a GET,--}}
                                    {{--That way the route is protected from cross-site scripting attacks.--}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    {{--TODO: Bad place for a donation button?--}}
                                    @include('include.donate')

                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <div class="flexy-start">
            @auth
                @include('include.sidebar')
                <main id="app" class="py-4 col-9 col-sm-10">
                    @yield('content')
                </main>
            @else
                <main id="app" class="py-4 col-12">
                    @yield('content')
                </main>
            @endauth
        </div>


        @if ($normalMsg = session('message'))
            <div id="messageToast" class="floating-message alert alert-success" role="alert">
                {{--@php--}}
                {{--session(['message' => "Test Message!"]);--}}
                {{--@endphp--}}
                <b> {{ $normalMsg }} </b>
            </div>
        @endif

        @if ($errorMsg = session('errorMessage'))
            <div id="errorMessageToast" class="floating-message alert alert-danger" role="alert">
                {{--@php--}}
                {{--session(['message' => "Test Message!"]);--}}
                {{--@endphp--}}
                <b> {{ $errorMsg }} </b>
            </div>
        @endif
    </div>

    @yield('js')

</body>
</html>
