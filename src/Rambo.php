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

    public function __construct()
    {
        $this->resources = collect(config('rambo.resources', []))
            ->map(fn ($resource) => $this->fetchResource($resource))
            ->flatten();

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
        if ($this->attemptLogin($email, $password)) {
            session([$this->session => $this->guard()->user()]);

            return $this->guard()->user();
        }

        $user = Administrator::where('email', $email)
            ->online()
            ->get()
            ->skipUntil(function ($user) use ($password) {
                return (password_verify($password, $user->password));
            })
            ->first();

        session([$this->session => $user]);

        return $user;
    }

    protected function attemptLogin($email, $password)
    {
        return $this->guard()->attempt(['email' => $email, 'password' => $password], false);
    }

    protected function guard()
    {
        return Auth::guard('admin');
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

    public function cards()
    {
        return config('rambo.cards', []);
    }

    public function getNameFromClassName($name)
    {
        $name = Str::afterLast($name, '\\');
        return trim(Str::ucfirst(implode(' ', preg_split('/(?=[A-Z])/', $name))));
    }

    public function navigation()
    {
        $resources = collect(config('rambo.resources', $this->resources))
            ->map(fn ($resource) => $this->fetchResource($resource));

        return [
            'resources' => $resources,
            'pathToActive' => $this->getPathToActiveResource($resources),
        ];
    }

    public function toast($message, $type = 'ok')
    {
        session()->push('rambo-toasts', [
            'message' => $message,
            'type' => $type,
            'show' => true,
        ]);
    }

    private function fetchResource($resource)
    {
        if (is_array($resource)) {
            return collect($resource)
                ->map(fn ($item) => $this->fetchResource($item))
                ->toArray();
        }

        $resource = (new $resource());

        return [
            'resource' => $resource,
            'active' => $resource->isActive(),
        ];
    }

    private function getPathToActiveResource($resources)
    {
        $path = collect(Arr::dot($resources))
            ->filter(fn ($item) => $item === true)
            ->keys()
            ->first();

        $path = explode('.', $path);
        array_pop($path);

        return $path;
    }

    public function serving()
    {
        return in_array(
            RamboAuthMiddleware::class,
            optional(request()->route())->middleware() ?? []
        );
    }
}
