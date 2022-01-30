<?php

namespace AngryMoustache\Rambo\Http\Livewire\Pickers;

use AngryMoustache\Rambo\Fields\Field;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;
use AngryMoustache\Rambo\Resource;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class HabtmPicker extends RamboComponent
{
    use WithFileUploads;
    use WithPagination;

    public Field $field;
    public Resource $resource;

    public $component = 'rambo::livewire.pickers.habtm-picker';

    public $value;

    public $search = '';

    public $selecting = false;

    public $items;
    public $selections = [];

    public function mount()
    {
        $this->resource = $this->field->getResource();
        $this->items = $this->resource->relationQuery()->get();
        $this->selections = $this->value;
    }

    public function toggleModal()
    {
        $this->selecting = ! $this->selecting;
        $this->emitUp('changed-value', $this->selections, $this->field->toLivewire());
    }

    public function toggleItem($id)
    {
        if (in_array($id, $this->selections)) {
            unset($this->selections[$id]);
        } else {
            $this->selections[$id] = $id;
        }
    }

    public function getComponentData()
    {
        // Search
        $shouldSearch = ($this->search !== '' && $this->selecting);
        $items = $this->items->when($shouldSearch, function ($items) {
            return $items->filter(function ($item) {
                return $this->resource->search($this->search, $item);
            });
        });

        // Split into selected & unselected items
        $selectedItems = $items->filter(function ($item) {
            return in_array($this->resource->item($item)->itemId(), $this->selections);
        });

        $unselectedItems = $items->reject(function ($item) {
            return in_array($this->resource->item($item)->itemId(), $this->selections);
        });

        return array_merge([
            'selectedItems' => $selectedItems,
            'unselectedItems' => $unselectedItems,
        ], parent::getComponentData());
    }
}
