<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ isset($titleForLayout) ? $titleForLayout : config('app.name') }} | Rambo</title>
        <link href="{{ asset('vendor/rambo/css/app.css') }}" rel="stylesheet">
        <script src="https://kit.fontawesome.com/989b502037.js" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="{{ asset('vendor/rambo/images/favicon.png') }}">
        <livewire:styles>
    </head>
    <body>
        {{-- Nav --}}
        <x-rambo::navigation />

        {{-- Content --}}
        <div class="main">
            <x-rambo::header />

            <div class="main-content">
                @yield('content')
            </div>
        </div>

        {{-- Toasts --}}
        <x-rambo::toasts />

        <livewire:scripts>
        <script src="{{ asset('vendor/rambo/js/index.js') }}"></script>
    </body>
</html>
