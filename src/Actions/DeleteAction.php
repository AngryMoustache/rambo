<?php

namespace AngryMoustache\Rambo\Actions;

class DeleteAction extends Action
{
    public $icon = 'far fa-trash-alt';
    public $label = 'Delete';

    public $livewireComponent = 'rambo-action-delete';

    public function shouldHide()
    {
        return ! $this->resource->can('delete');
    }
}
