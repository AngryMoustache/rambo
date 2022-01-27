<?php

namespace AngryMoustache\Rambo\Actions;

class DeleteAction extends Action
{
    public static $icon = 'far fa-trash-alt';
    public static $label = 'Delete';

    public static $livewireComponent = 'rambo-action-delete';
}
