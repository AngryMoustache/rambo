<?php

namespace AngryMoustache\Rambo\Fields;

class ManyAttachmentField extends Field
{
    public $bladeShowComponent = 'rambo::livewire.fields.show.many-attachment';
    public $livewireFormComponent = 'rambo-form-many-attachment-field';

    public $folder = 'uploads';

    public $hasManyRelation = true;

    public function getValue()
    {
        $value = parent::getValue();
        if (! $value) {
            return [];
        }

        return parent::getValue()->pluck('id')->toArray();
    }

    public function getShowValue()
    {
        return $this->item->{$this->getName()};
    }

    public function getWithPivotData($values)
    {
        if ($this->getSortField()) {
            $count = 1000;

            return collect($values)->mapWithKeys(function ($id) use (&$count) {
                return [$id => [
                    $this->getSortField() => ++$count,
                ]];
            })->toArray();
        }

        return $values;
    }
}
