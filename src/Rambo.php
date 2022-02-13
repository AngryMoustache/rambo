<?php

namespace AngryMoustache\Rambo;

use AngryMoustache\Rambo\Http\Exceptions\RamboNotFoundHttpException;
use AngryMoustache\Rambo\Http\Exceptions\RamboUnauthorizedHttpException;
use AngryMoustache\Rambo\Http\Middleware\RamboAuthMiddleware;
use AngryMoustache\Rambo\Models\Administrator;
use Exception;

class Rambo
{
    public $session = 'rambo.auth';

    public $resources;

    public $navigation;

    public $user;

    public $guard;

    public function __construct()
    {
        $this->guard = config('rambo.admin-guard', 'rambo');
        $this->user = Administrator::find(optional(session($this->session))->id);
        $this->resources = $this->resources();
        $this->navigation = $this->navigation();

        if ($this->serving()) {
            session(['rambo-current-url' => request()->url()]);
        }
    }

    public function resources()
    {
        if ($this->resources) {
            return $this->resources;
        }

        $resources = config('rambo.resources')
            ?? throw new Exception('No \'rambo.resources\' config defined!');

        return collect($resources)->map(fn ($class) => (new $class));
    }

    public function resource($value, $id = null, $key = null)
    {
        return clone optional($this->resources->where($key ?? 'routebase', $value)->first())->fetch($id);
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

    public function notFound()
    {
        throw new RamboNotFoundHttpException();
    }

    public function unauthorized()
    {
        throw new RamboUnauthorizedHttpException();
    }

    public function currentUrl()
    {
        return session('rambo-current-url');
    }

    public function navigation()
    {
        return $this->navigation ?? collect(config('rambo.navigation', $this->resources))
            ->map(fn ($resource) => $this->fetchNavResource($resource));
    }

    private function fetchNavResource($resource)
    {
        if (is_array($resource)) {
            $resource = collect($resource)
                ->map(fn ($item) => $this->fetchNavResource($item))
                ->toArray();

            $active = collect($resource)->flatten()
                ->filter(fn ($item) => $item === true)
                ->isNotEmpty();
        } else {
            $resource = (new $resource());
            $active = request()->route('resource') === $resource->routebase();
        }

        return [
            'active' => $active,
            'resource' => $resource,
        ];
    }

    public function cropperEnabled()
    {
        return ! empty(config('media.cropper.formats', []));
    }
}
