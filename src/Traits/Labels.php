<?php

namespace AngryMoustache\Rambo\Traits;

trait Labels
{
    public $label;
    public $singularLabel;
    public $displayName = 'id';
    public $primaryField = 'id';

    public function displayName()
    {
        return $this->displayName;
    }

    public function primaryField()
    {
        return $this->primaryField;
    }

    public function itemName()
    {
        return $this->item->{$this->displayName()};
    }

    public function label()
    {
        return $this->label;
    }

    public function singularLabel()
    {
        return $this->singularLabel;
    }
}
