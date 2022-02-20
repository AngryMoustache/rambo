<?php

namespace AngryMoustache\Rambo\Http;

use AngryMoustache\Rambo\Facades\Rambo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class RamboController extends Controller
{
    public function __invoke(Request $request, $resource, $itemId = null)
    {
        $resource = Rambo::resource($resource, $itemId);
        $page = Str::afterLast($request->route()->getName(), '.');
        $component = $resource->{"${page}LivewireComponent"}();

        return view('rambo::router', [
            'resource' => $resource,
            'component' => $component,
        ]);
    }
}
