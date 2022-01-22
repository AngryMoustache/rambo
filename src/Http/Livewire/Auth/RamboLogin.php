<?php

namespace AngryMoustache\Rambo\Http\Livewire\Auth;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;

class RamboLogin extends RamboComponent
{
    public $email = '';
    public $password = '';
    public $error = '';

    public function render()
    {
        return view('rambo::livewire.auth.login')
            ->extends('rambo::layouts.auth');
    }

    public function attemptLogin()
    {
        $this->error = '';
        if (Rambo::login($this->email, $this->password)) {
            return redirect(
                session()->pull('intended-redirect') ??
                    config('rambo::admin-route', 'admin')
            );
        }

        $this->error = 'We could not log you in, please try again.';
    }
}
