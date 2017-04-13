<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Naija Skill Hub') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script src="{{ asset('js/nsh-polyfills.js') }}"></script>
    <script src="{{ asset('js/nsh-declarations.js') }}"></script>
</head>
<body>
    <div id="app">

        @yield('body')
        <!-- spinner -->
		<div id="mdl-spinner-global" class="mdl-spinner mdl-spinner--single-color mdl-js-spinner global-spinner nsh-hide"></div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/nsh-common-functions.js') }}"></script>
    @stack('nsh-scripts')
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</body>
</html>
