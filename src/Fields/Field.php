<?php

namespace AngryMoustache\Rambo\Fields;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @method object label(string $label)
 * @method object hideFrom(string|array $locations)
 * @method object searchable(boolean $searchable = true)
 */
class Field
{
    public $livewireComponent = 'rambo-field-render';
    public $livewireShowComponent = 'rambo-field-show-render';

    public static function make($name = null)
    {
        return new static($name);
    }

    public function __construct($name = null, $label = null)
    {
        $this->name ??= $name;
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

        // Check for any isX functions (returns bool)
        if (preg_match('/is[A-Z]{1}/', $name)) {
            if (! method_exists($this, $name)) {
                $name = lcfirst(Str::of($name)->after('is'));
            }

            return (bool) $this->{$name};
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

    public function getShowValue()
    {
        return $this->getValue();
    }

    /**
     * Search the item in the field for a value
     */
    public function search($value, $item = null)
    {
        return Str::contains(
            strtolower(($item ?? $this->item)->{$this->getName()}),
            strtolower($value)
        );
    }

    /**
     * Hide the field from certain views
     * Can be: index, show, edit or create
     */
    public function hideFrom($locations)
    {
        $this->hideFrom = Arr::wrap($locations);
        return $this;
    }
}
