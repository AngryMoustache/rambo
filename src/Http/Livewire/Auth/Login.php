<?php

namespace AngryMoustache\Rambo\Http\Livewire\Auth;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;

class Login extends RamboComponent
{
    public $email = '';
    public $password = '';

    public $component = 'rambo::livewire.auth.login';
    public $layout = 'rambo::layouts.auth';

    public function attemptLogin()
    {
        if (! Rambo::login($this->email, $this->password)) {
            $this->toastError('We could not log you in, please try again.');
            return;
        }

        $url = session()->pull('intended-redirect') ?? route('rambo.dashboard');
        $this->redirect($url);
    }
}
