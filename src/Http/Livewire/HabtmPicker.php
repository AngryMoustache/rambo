<?php

namespace AngryMoustache\Rambo\Http\Livewire;

use Livewire\Component;

class HabtmPicker extends Component
{
    public $name;
    public $targetResource;
    public $targetModel;
    public $items;
    public $search = '';
    public $searchFields = [];
    public $defaultSort;
    public $defaultSortDir = 'asc';
    public $selecting = false;
    public $habtmComponent = 'rambo::habtm.item';
    public $selections = [];
    public $sortable;

    public function mount($field)
    {
        $this->name = $field->getName();
        $this->sortable = $field->sortable;
        $this->targetResource = $field->targetResource;
        $this->targetModel = $field->targetResource::getModel();
        $this->habtmComponent = $field->targetResource::$habtmComponent;
        $this->searchFields = $field->targetResource::$searchFields;
        $this->defaultSort = $field->targetResource::$defaultSort;
        $this->defaultSortDir = $field->targetResource::$defaultSortDir;

        $this->selections = $field->getValue() ?? [];
        if ($this->selections !== []) {
            $this->selections = $this->selections->pluck('id')->toArray();
        }
    }

    public function render()
    {
        $this->items = $this->targetModel::orderBy($this->defaultSort, $this->defaultSortDir);
        foreach ($this->searchFields as $field) {
            $this->items = $this->items->orWhere($field, 'LIKE', "%{$this->search}%");
        }

        $this->items = $this->items->get();

        $this->emit('field:update', $this->selections, $this->name);

        return view('rambo::livewire.habtm-picker');
    }

    public function openModal()
    {
        $this->selecting = true;
    }

    public function closeModal()
    {
        $this->selecting = false;
    }

    public function sortSelections($items)
    {
        $this->selections = collect($items)
            ->pluck('value')
            ->toArray();
    }

    public function addToSelections($key)
    {
        if (in_array($key, $this->selections)) {
            unset($this->selections[array_search($key, $this->selections)]);
        } else {
            $this->selections[] = $key;
        }
    }
}
