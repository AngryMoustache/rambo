<?php

namespace AngryMoustache\Rambo\Traits;

use AngryMoustache\Rambo\Filters\Filter;
use Illuminate\Support\Collection;

trait Filters
{
    public function filters()
    {
        return [];
    }

    public function getFilters()
    {
        return Collection::wrap($this->filters())
            ->filter(fn (Filter $filter) => $filter->canSee($this));
    }
}
