<?php

namespace AngryMoustache\Rambo\Traits;

trait Routing
{
    public $routebase;

    public function routebase()
    {
        return $this->routebase;
    }

    public function isActive()
    {
        return optional(request()->route('resource'))->routebase === $this->routebase();
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

    // public function routeAfterCreate($item)
    // {
    //     return $this->show($item->id);
    // }

    // public function routeAfterEdit($item)
    // {
    //     return $this->show($item->id);
    // }
}
