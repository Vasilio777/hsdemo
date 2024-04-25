<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$title}} | HS Demo</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
   
    <!-- Icons -->
    <link href="css/nucleo-icons.css" rel="stylesheet" />
    <link href="css/nucleo-svg.css" rel="stylesheet" />

    <!-- Styles -->
    {{-- <link id="pagestyle" href="css/material-dashboard.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('css/material-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hsdemo.css') }}">
    {{ $styles ?? '' }}



</head>
<body>
<div class="min-h-full">

    <x-navigation/>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{$title}}</h1>
        </div>
    </header>

    <main>
        <div class="mx-auto max-w-7xl py-4 sm:px-6 lg:px-8">
            {{$slot}}
        </div>
    </main>
</div>

<x-footer/>

<!-- Scripts -->
<script src={{ asset('js/core/popper.min.js') }}></script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src={{ asset('js/material-dashboard.min.js') }}></script>
{{ $scripts ?? '' }} 

</body>
</html>
