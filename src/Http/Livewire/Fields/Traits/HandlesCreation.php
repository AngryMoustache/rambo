<?php

namespace AngryMoustache\Rambo\Http\Livewire\Fields\Traits;

use Closure;

trait HandlesCreation
{
    public $name;

    public function __construct($name = null, $label = null)
    {
        $this->name = $name;
        $this->label = $label ?? ucfirst(str_replace('_', ' ', $name));
    }

    public function __get($name)
    {
        return $this->{$name} ?? null;
    }

    public function __call($name, $value)
    {
        if ($value === []) {
            $this->{$name} = true;
        } else {
            $value = optional($value)[0];
            if ($value instanceof Closure) {
                $this->{$name} = call_user_func($value);
            } else {
                $this->{$name} = $value;
            }
        }

        return $this;
    }

    public static function make($name = null)
    {
        return new static($name);
    }
}
