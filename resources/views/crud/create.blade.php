@extends('rambo::layouts.admin')

@section('content')
    <div class="border p-5 pt-3 rounded-lg bg-white">
        <h2 class="text-4xl mb-4 pb-4 border-b">
            Creating {{ $resource::$label }}
        </h2>

        <livewire:rambo-form :form="get_class($resource)" />
    </div>
@endsection
