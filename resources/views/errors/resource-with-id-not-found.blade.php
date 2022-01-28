@extends('rambo::layouts.admin')

@section('content')
    <div class="card">
        <h1 class="h2">404 - Page not found</h1>
        <p class="mt-1 mb-2">
            The
            <strong>{{ $resource->singularLabel() }}</strong>
            with ID
            <strong>{{ $itemId }}</strong>
            does not exist in our database.
        </p>

        <a
            href="{{ route('rambo.crud.index', $resource->routebase()) }}"
            class="button"
        >
            Return to the overview
        </a>
    </div>
@endsection
