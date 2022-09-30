<?php

namespace AngryMoustache\Rambo\Traits;

use Closure;
use Illuminate\Support\Str;

trait RamboMagic
{
    public function __get($name)
    {
        $value = $this->{$name} ?? null;
        if ($value instanceof Closure) {
            return call_user_func($value, $this);
        }

        return $value;
    }

    public function __call($name, $value)
    {
        // Check for any getX functions
        if (preg_match('/get[A-Z]{1}/', $name)) {
            if (! method_exists($this, $name)) {
                $name = lcfirst(Str::of($name)->after('get'));
            }

            return $this->__get($name);
        }

        // Check for any isX functions (returns bool)
        if (preg_match('/is[A-Z]{1}/', $name)) {
            if (! method_exists($this, $name)) {
                $name = lcfirst(Str::of($name)->after('is'));
            }

            return (bool) $this->__get($name);
        }

        // User is setting something
        if ($value === []) {
            $this->{$name} = true;
        } else {
            $this->{$name} = $value[0] ?? null;
        }

        return $this;
    }
}
