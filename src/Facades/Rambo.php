<?php

namespace AngryMoustache\Rambo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static object user()
 * @method static string passwordHash($password)
 * @method static object login($email, $password)
 * @method static void logout()
 * @method static boolean serving()
 * @method static string currentUrl()
 * @method static object resources()
 * @method static Resource resource(string $value, $id = null, string $key = 'routebase')
 * @method static object navigation()
 * @method static void notFound()
 */
class Rambo extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'rambo';
    }
}
