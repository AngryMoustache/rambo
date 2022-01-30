<?php

namespace AngryMoustache\Rambo\Http\Livewire\Auth;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;

class Login extends RamboComponent
{
    public $email = '';
    public $password = '';
    public $error = '';

    public $component = 'rambo::livewire.auth.login';
    public $layout = 'rambo::layouts.auth';

    public function attemptLogin()
    {
        $this->error = '';
        if (Rambo::login($this->email, $this->password)) {
            $this->redirect(
                session()->pull('intended-redirect') ??
                    config('rambo::admin-route', 'admin')
            );
        }

        $this->error = 'We could not log you in, please try again.';
    }
}
