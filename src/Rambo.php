<?php

namespace AngryMoustache\Rambo;

use AngryMoustache\Rambo\Models\Administrator;

class Rambo
{
    public $session = 'rambo.auth';

    public $resources;

    public $user;

    public function __construct()
    {
        $this->resources = collect(config('rambo.resources', []))
            ->map(fn ($resource) => new $resource());

        $this->user = Administrator::find(optional(session($this->session))->id);
    }

    public function user()
    {
        return $this->user;
    }

    public function hash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function login($email, $password)
    {
        $user = Administrator::where('email', $email)
            ->get()
            ->skipUntil(function ($user) use ($password) {
                return (password_verify($password, $user->password));
            })
            ->first();

        session([$this->session => $user]);

        return $user;
    }

    public function logout()
    {
        session()->forget($this->session);
    }

    public function resources()
    {
        return $this->resources;
    }

    public function resource($value, $key = 'routebase')
    {
        return $this->resources->where($key, $value)->first();
    }
}
