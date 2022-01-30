<?php

namespace AngryMoustache\Rambo\Traits;

use AngryMoustache\Rambo\Facades\Rambo;

trait Routing
{
    public $routebase;

    public static function resolveRouteBinding($resource)
    {
        $itemId = request()->route()->parameter('itemId');
        $resource = Rambo::resource($resource, $itemId);
        return $resource;
    }

    public function routebase()
    {
        return $this->routebase;
    }

    public function index()
    {
        return route('rambo.crud.index', $this->routebase());
    }

    public function create()
    {
        return route('rambo.crud.create', $this->routebase());
    }

    public function show($id = null)
    {
        return route('rambo.crud.show', [
            'resource' => $this->routebase(),
            'itemId' => $id ?? $this->itemId(),
        ]);
    }

    public function edit($id = null)
    {
        return route('rambo.crud.edit', [
            'resource' => $this->routebase(),
            'itemId' => $id ?? $this->itemId(),
        ]);
    }

    public function routeAfterCreate()
    {
        return $this->show();
    }

    public function routeAfterEdit()
    {
        return $this->show();
    }
}
