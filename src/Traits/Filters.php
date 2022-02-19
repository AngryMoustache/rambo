<?php

namespace AngryMoustache\Rambo\Traits;

use AngryMoustache\Rambo\Filters\Filter;
use AngryMoustache\Rambo\Filters\OnlineFilter;
use Illuminate\Support\Collection;

trait Filters
{
    public function filters()
    {
        return [
            OnlineFilter::make(),
        ];
    }

    public function getFilters()
    {
        return Collection::wrap($this->filters())
            ->filter(fn (Filter $filter) => $filter->canSee($this));
    }
}
