<?php

namespace AngryMoustache\Rambo\Resource\Traits;

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

    public function show($id)
    {
        return route('rambo.crud.show', [
            'resource' => $this->routebase(),
            'id' => $id,
        ]);
    }

    public function edit($id)
    {
        return route('rambo.crud.edit', [
            'resource' => $this->routebase(),
            'id' => $id,
        ]);
    }

    public function delete($id)
    {
        return route('rambo.crud.delete', [
            'resource' => $this->routebase(),
            'id' => $id,
        ]);
    }
}
