<?php

namespace AngryMoustache\Rambo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array list() Get the breadcrumb list
 * @method static void add(string $label, string $link = null) Add a line to the breadcrumbs
 * @method static void reset() Resets the breadcrumbs to nothing
 */
class RamboBreadcrumbs extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'rambo-breadcrumbs';
    }
}
