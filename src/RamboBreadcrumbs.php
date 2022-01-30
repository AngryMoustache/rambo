<?php

namespace AngryMoustache\Rambo;

class RamboBreadcrumbs
{
    public $crumbs = [];

    public function __construct()
    {
        $this->crumbs = collect(session('rambo-breadcrumbs', []))
            ->takeUntil(fn ($crumb) => $crumb->link === url()->current())
            ->toArray();

        $this->save();
    }

    public function list()
    {
        return $this->crumbs;
    }

    public function reset()
    {
        $this->crumbs = [];
        $this->add('Dashboard', route('rambo.dashboard'));
        $this->save();
    }

    public function add(string $label, string $link = null)
    {
        $this->crumbs[] = (object) [
            'label' => $label,
            'link' => $link ?? url()->current(),
            'queryLink' => $link ?? request()->fullUrl(),
        ];

        $this->save();
    }

    private function save()
    {
        session(['rambo-breadcrumbs' => $this->crumbs]);
    }
}
