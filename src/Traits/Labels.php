<?php

namespace AngryMoustache\Rambo\Traits;

trait Labels
{
    public $label;
    public $singularLabel;
    public $displayName = 'id';
    public $primaryField = 'id';

    public function displayNameField()
    {
        return $this->displayName;
    }

    public function primaryField()
    {
        return $this->primaryField;
    }

    public function itemName()
    {
        return $this->item->{$this->displayNameField()};
    }

    public function itemId()
    {
        return $this->item->{$this->primaryField()};
    }

    public function label()
    {
        return $this->label;
    }

    public function singularLabel()
    {
        return $this->singularLabel;
    }

    public function globalSearchLabel()
    {
        return $this->label();
    }
}
