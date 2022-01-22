<?php

namespace AngryMoustache\Rambo;

use AngryMoustache\Rambo\Http\Middleware\RamboAuthMiddleware;
use AngryMoustache\Rambo\Models\Administrator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Rambo
{
    public $session = 'rambo.auth';

    public $resources;

    public $user;

    public $guard;

    public function __construct()
    {
        $this->guard = config('rambo.admin-guard', 'rambo');
        $this->user = Administrator::find(optional(session($this->session))->id);
    }

    public function user()
    {
        return $this->user;
    }

    public function passwordHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function login($email, $password)
    {
        $user = Administrator::where('email', $email)
            ->online()
            ->get()
            ->skipUntil(fn ($user) => password_verify($password, $user->password))
            ->first();

        session([$this->session => $user]);

        return $user;
    }

    public function logout()
    {
        session()->forget($this->session);
    }

    public function serving()
    {
        return in_array(
            RamboAuthMiddleware::class,
            optional(request()->route())->middleware() ?? []
        );
    }
}
