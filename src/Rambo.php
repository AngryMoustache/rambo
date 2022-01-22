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
        $this->resources = collect(config('rambo.resources', []))
            ->map(fn ($resource) => $this->fetchResource($resource))
            ->flatten();

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
        if (Auth::check($this->guard) && $this->attemptLogin($email, $password)) {
            session([$this->session => $this->guard()->user()]);
            return $this->guard()->user();
        }

        $user = Administrator::where('email', $email)->online()->get()
            ->skipUntil(fn ($user) => password_verify($password, $user->password))
            ->first();

        session([$this->session => $user]);

        return $user;
    }

    protected function attemptLogin($email, $password)
    {
        return $this->guard()->attempt([
            'email' => $email,
            'password' => $password,
        ], false);
    }

    protected function guard()
    {
        return Auth::guard($this->guard);
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
