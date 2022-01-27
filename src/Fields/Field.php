<?php

namespace AngryMoustache\Rambo\Fields;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @method static object label(string $label)
 * @method static object hideFrom(string|array $locations)
 */
class Field
{
    public $livewireComponent = 'rambo-field-render';
    public $livewireShowComponent = 'rambo-field-show-render';

    public static function make($name = null)
    {
        return new static($name);
    }

    public function __construct(public $name = null, $label = null)
    {
        $this->label ??= Str::of($this->name)
            ->replace('_', ' ')
            ->ucfirst();
    }

    public function __get($name)
    {
        return $this->{$name} ?? null;
    }

    public function __call($name, $value)
    {
        // Check for any getX functions
        if (preg_match('/get[A-Z]{1}/', $name)) {
            if (! method_exists($this, $name)) {
                $name = lcfirst(Str::of($name)->after('get'));
            }

            return $this->{$name};
        }

        // User is setting something
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

    public function getValue()
    {
        return optional($this->item)->{$this->getName()};
    }

    /**
     * Hide the field from certain views
     * Can be: index, show, edit or create
     */
    public function hideFrom($locations)
    {
        return Arr::wrap($locations);
    }
}
