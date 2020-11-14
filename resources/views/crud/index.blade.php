@extends('rambo::layouts.crud')

@section('content')
    <div class="border p-5 pt-2 rounded-lg bg-white">
        <h2 class="text-4xl mb-4 pb-4 border-b">
            {{ (new \ReflectionClass($resource))->getShortName() }}
        </h2>

        <a
            href="/admin/{{ $resource::$routeBase }}/create"
            class="inline-block mb-4 cursor-pointer rounded bg-red-800 px-10 py-2 font-bold text-red-100 hover:bg-red-900"
        >
            <i class="mr-1 fa fa-plus"></i>
            Create
        </a>

        @if ($items->isNotEmpty())
            <table class="w-full">
                <tr>
                    @foreach ($resource->getOnlyFieldsStack() as $field)
                        <td class="py-2 px-4 bg-red-800 text-red-100 font-bold">
                            {{ $field->getLabel() }}
                        </td>
                    @endforeach
                    <td class="py-2 px-4 bg-red-800 text-red-100 font-bold" colspan="3"></td>
                </tr>
                @foreach ($items as $item)
                    <tr>
                        @foreach ($resource->getOnlyFieldsStack() as $field)
                            <td class="py-2 px-4 border-t">
                                {{ $field->item($item)->renderShow() }}
                            </td>
                        @endforeach
                        <td class="w-10 border-t">
                            <a href="/admin/{{ $resource::$routeBase }}/{{ $item->id }}">
                                <i class="py-2 px-4 far fa-eye"></i>
                            </a>
                        </td>
                        <td class="w-10 border-t">
                            <a href="/admin/{{ $resource::$routeBase }}/{{ $item->id }}/edit">
                                <i class="py-2 px-4 far fa-edit"></i>
                            </a>
                        </td>
                        <td class="w-10 border-t">
                            <a href="/admin/{{ $resource::$routeBase }}/{{ $item->id }}/delete">
                                <i class="py-2 px-4 far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>No items found.</p>
        @endif
    </div>
@endsection