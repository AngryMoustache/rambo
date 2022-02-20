@extends('rambo::layouts.admin')

@section('content')
    <livewire:is
        :component="$component"
        :resource="$resource"
    />
@endsection
