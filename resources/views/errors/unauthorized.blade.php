@extends('rambo::layouts.admin')

@section('content')
    <div class="card">
        <h1 class="h2">401 - Unauthorized</h1>
        <p class="mt-1 mb-2">
            Whoops! You are not allowed to view this page!
        </p>

        <a href="{{ route('rambo.dashboard') }}" class="button">
            Return to the dashboard
        </a>
    </div>
@endsection
