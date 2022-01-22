<?php

namespace AngryMoustache\Rambo\Traits;

trait Queries
{
    public $defaultOrderCol = 'id';
    public $defaultOrderDir = 'desc';

    public function query()
    {
        return $this->model()::withoutGlobalScopes();
    }

    public function indexQuery()
    {
        return $this->query()->orderBy(
            $this->defaultOrderCol(),
            $this->defaultOrderDir()
        );
    }

    public function defaultOrderCol()
    {
        return $this->defaultOrderCol;
    }

    public function defaultOrderDir()
    {
        return $this->defaultOrderDir;
    }
}
