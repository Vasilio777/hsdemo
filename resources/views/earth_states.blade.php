<x-site-layout title="Earth States">
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
    </x-slot>

    <x-earth_slider :data="$data" />

    <x-slot name="scripts">
        <script src="{{ asset('js/slider.js') }}"></script>
    </x-slot>
</x-site-layout>
