<?php

namespace AngryMoustache\Rambo;

use AngryMoustache\Rambo\Http\Exceptions\RamboNotFoundHttpException;
use AngryMoustache\Rambo\Http\Middleware\RamboAuthMiddleware;
use AngryMoustache\Rambo\Models\Administrator;

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

        $this->resources = $this->navigation()->flatten();
    }

    public function navigation()
    {
        return collect(config('rambo.resources', $this->resources))
            ->map(fn ($resource) => $this->fetchResource($resource));
    }

    public function resources()
    {
        return $this->resources;
    }

    public function resource($value, $id = null, $key = null)
    {
        return optional($this->resources->where($key ?? 'routebase', $value)->first())
            ->fetch($id);
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

    private function fetchResource($resource)
    {
        if (is_array($resource)) {
            return collect($resource)
                ->map(fn ($item) => $this->fetchResource($item))
                ->toArray();
        }

        return (new $resource());
    }

    public function notFound()
    {
        throw new RamboNotFoundHttpException();
    }
}
