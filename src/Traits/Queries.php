<?php

namespace AngryMoustache\Rambo\Traits;

trait Queries
{
    public $defaultOrderCol = 'id';
    public $defaultOrderDir = 'desc';
    public $pagination = 25;
    public $item;

    public function query()
    {
        return $this->model()::withoutGlobalScopes();
    }

    public function indexQuery()
    {
        return $this->query();
    }

    public function fetch($id)
    {
        $this->item = $this->query()->find($id);
        return $this;
    }

    public function item()
    {
        return $this->item;
    }

    public function defaultOrderCol()
    {
        return $this->defaultOrderCol;
    }

    public function defaultOrderDir()
    {
        return $this->defaultOrderDir;
    }

    public function pagination()
    {
        return $this->paginate ?? $this->pagination;
    }
}
