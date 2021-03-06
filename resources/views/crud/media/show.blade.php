@extends('rambo::layouts.admin')

@section('content')
    <div class="border p-5 pt-3 rounded-lg bg-white shadow">
        <div class="flex mb-4 pb-4 border-b">
            <h2 class="text-4xl">
                {{ $resource::getLabelSingular() }}:
                {{ $item[$resource::getNameField()] }}
            </h2>

            <x-rambo::crud.show-buttons :resource="$resource" :item="$item" />
        </div>

        <div class="flex flex-wrap">
            @foreach ($resource->getOnlyFieldsStack() as $field)
                <div class="w-1/6 @if(!$loop->last) border-b @endif p-4 border-opacity-25">
                    {{ $field->getLabel() }}
                </div>

                <div class="w-5/6 @if(!$loop->last) border-b @endif p-4 border-opacity-25">
                    {{ $field->item($item)->renderShow() }}
                </div>
            @endforeach

            <div class="w-full p-4 border-opacity-25">
                <a target="_blank" class="inline-block w-1/2" href="{{ $item->path() }}">
                    <img class="w-full" src="{{ $item->path() }}">
                </a>
            </div>
        </div>
    </div>
@endsection
