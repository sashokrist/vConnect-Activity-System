<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/d139188ea5.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Exo+2:100,200,400|Open+Sans:400,700&display=swap"
    rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {!! htmlScriptTagJsApiV3([
            'action' => 'homepage'
        ]) !!}
</head>
<body>
    <div id="app">
        <main class="login-page">
            @include('flash-message')
            <div class="wrapper-login-page">
                <div class="login-wrap">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>