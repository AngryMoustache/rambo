<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Rambo</title>
        <link href="{{ asset('vendor/rambo/css/app.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('vendor/rambo/images/favicon.png') }}">
        <livewire:styles>
    </head>
    <body class="auth">
        <div class="content">
            <div class="auth-card">
                <div class="auth-card-form">
                    @yield('content')
                </div>
            </div>
        </div>

        {{-- Toasts --}}
        <x-rambo::toasts />

        <livewire:scripts>
        <script src="{{ asset('vendor/rambo/js/index.js') }}"></script>
    </body>
</html>
