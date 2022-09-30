<?php

namespace AngryMoustache\Rambo\Http\Livewire\Dashboard;

use AngryMoustache\Rambo\Facades\RamboBreadcrumbs;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;

class Dashboard extends RamboComponent
{
    public $component = 'rambo::livewire.dashboard';

    public function mount()
    {
        parent::mount();
        RamboBreadcrumbs::reset();
    }
}
