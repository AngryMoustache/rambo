<?php

namespace AngryMoustache\Rambo\Http\Livewire;

use AngryMoustache\Rambo\Fields\Field;
use AngryMoustache\Rambo\Filters\Filter;
use AngryMoustache\Rambo\Resource;

class FilterComponent extends RamboComponent
{
    public $component = 'rambo::livewire.filter';

    public Filter $filter;
    public Resource $resource;

    public $fields = [];
    public $enabled = false;
    public $filterKey;

    public function mount()
    {
        parent::mount();
        $this->fields = collect($this->filter->filterFields())->mapWithKeys(function (Field $field) {
            return [$field->getName() => $field->getFilterValue()];
        });

        $this->updateIndex();
    }

    public function updatedEnabled()
    {
        $this->updateIndex();
    }

    public function updatedFields()
    {
        $this->updateIndex();
    }

    public function updateIndex()
    {
        $this->emitUp(
            'filters-updated',
            $this->filterKey,
            $this->enabled,
            $this->fields
        );
    }
}
