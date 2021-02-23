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
    <script type="module" src="{{ asset('js/plastimedia.js') }}" defer></script>
    <!-- Fonts -->
    <link defer href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
</head>
<body>

    @guest
        @yield('content')
    @else
        {{-- menu latear --}}
        @include('layouts.partials.menu')

        {{-- contenido de la app --}}
        <div class="contenido-app">
            @include('layouts.partials.bar')
            @yield('content')
        </div>
    @endif
</body>
</html>
