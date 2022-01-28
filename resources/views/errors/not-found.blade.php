@extends('rambo::layouts.admin')

@section('content')
    <div class="card">
        <h1 class="h2">404 - Page not found</h1>
        <p class="mt-1 mb-2">
            The page that you are looking for does not exist.
        </p>

        <a href="{{ route('rambo.dashboard') }}" class="button">
            Return to the dashboard
        </a>
    </div>
@endsection
