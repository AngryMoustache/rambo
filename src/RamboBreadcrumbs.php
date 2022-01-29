<?php

namespace AngryMoustache\Rambo;

class RamboBreadcrumbs
{
    public $crumbs = [];

    public function __construct()
    {
        $this->crumbs = session('rambo-breadcrumbs', []);
        $current = url()->current();

        if (
            $current === route('rambo.dashboard') ||
            ! isset($this->crumbs[url()->previous()])
        ) {
            // Remove all the crumbs, we got here from an external link
            $this->reset();
            $this->add('Dashboard', route('rambo.dashboard'));
        } else {
            // Remove all the crumbs following the current one
            // array_intersect_key($array, array_flip($keys));
            $this->crumbs = collect($this->crumbs)
                ->takeUntil(fn ($label, $link) => $link === $current)
                ->toArray();
        }
    }

    public function list()
    {
        return $this->crumbs;
    }

    public function reset()
    {
        $this->crumbs = [route('rambo.dashboard') => 'Dashboard'];
        $this->save();
    }

    public function add(string $label, string $link = null)
    {
        $this->crumbs[$link ?? url()->current()] = $label;
        $this->save();
    }

    private function save()
    {
        session(['rambo-breadcrumbs' => $this->crumbs]);
    }
}
