<?php

namespace AngryMoustache\Rambo\Traits;

trait GlobalSearch
{
    public $isGlobalSearchable = true;
    public $globalSearchWeight = null;
    public $globalSearchPagination = 10;
    public $globalSearchBladeComponent = 'rambo::components.global-search.item';

    public function search($query, $item = null)
    {
        $searchableFields = $this->searchableFields();
        foreach ($searchableFields as $field) {
            if ($field->search($query, $item ?? $this->item)) {
                return true;
            }
        }

        return false;
    }

    public function isGlobalSearchable()
    {
        return $this->isGlobalSearchable;
    }

    public function globalSearchWeight()
    {
        return $this->globalSearchWeight;
    }

    public function globalSearchPagination()
    {
        return $this->globalSearchPagination;
    }

    public function globalSearchBladeComponent()
    {
        return $this->globalSearchBladeComponent;
    }
}
