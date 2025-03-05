<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')

            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		<link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <wireui:scripts />
        @livewireStyles
        @livewireScripts

        <!-- Confetti.js -->
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        <x-dialog z-index="z-50" blur="md" align="center" width="lg" />
        <x-notifications position="top-right" z-index="z-50" />
        <div class="bg-kolej-tafe"></div>
        @yield('body')
    </body>
</html>
