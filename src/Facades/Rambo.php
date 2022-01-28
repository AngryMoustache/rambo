<?php

namespace AngryMoustache\Rambo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static object user()
 * @method static object passwordHash($password)
 * @method static object login($email, $password)
 * @method static object logout()
 * @method static object serving()
 * @method static object resources()
 * @method static object resource(string $value, $id = null, string $key = 'routebase')
 * @method static object navigation()
 * @method static object notFound()
 */
class Rambo extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'rambo';
    }
}
