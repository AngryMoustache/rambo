<?php

namespace AngryMoustache\Rambo\Resource\Fields;

class HabtmField extends LivewireCustomField
{
    public $livewireComponent = 'rambo-fields-habtm-picker';

    public $showComponent = 'rambo::fields.show.habtm';

    public $hasManyRelation = true;

    public function getValue()
    {
        $value = (parent::getValue() ?? collect());

        // Data is an array of IDs (page architect)
        if (is_array($value)) {
            return $value;
        }

        return $value->pluck('id')->toArray();
    }

    public function getShowValue()
    {
        $value = $this->getValue();

        if (is_array($value)) {
            $model = (new $this->resource)->model();
            $value = $model::withoutGlobalScopes()->whereIn('id', $value)->get();
        }

        return $value;
    }

    public function getDisplayNameResource()
    {
        return (new $this->resource)->getDisplayName();
    }

    public function getShowRouteItem($item)
    {
        return route('rambo.crud.show', [
            'resource' => (new $this->resource)->routebase(),
            'id' => $item->id,
        ]);
    }
}
