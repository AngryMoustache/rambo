@extends('rambo::layouts.admin')

@section('content')
    <div>
        <div class="card">
            <h1 class="h3">{{ $message }}</h1>

            @isset($longMessage)
                <p class="mt-1">{{ $longMessage }}</p>
            @endisset
        </div>
    </div>
@endsection
