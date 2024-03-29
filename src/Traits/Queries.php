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

    public function sortedQuery()
    {
        return $this->indexQuery()->orderBy(
            $this->defaultOrderCol(),
            $this->defaultOrderDir(),
        );
    }

    public function globalSearchQuery()
    {
        return $this->sortedQuery();
    }

    public function relationQuery()
    {
        return $this->sortedQuery();
    }

    public function fetch($id)
    {
        $this->item = $this->query()->find($id);
        return $this;
    }

    public function item($item)
    {
        if (is_integer($item)) {
            $this->fetch($item);
        } else {
            $this->item = $item;
        }

        return $this;
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
