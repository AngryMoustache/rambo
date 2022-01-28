<?php

namespace AngryMoustache\Rambo\Actions;

class DeleteAction extends Action
{
    public $icon = 'far fa-trash-alt';
    public $label = 'Delete';

    public static $livewireComponent = 'rambo-action-delete';
}
