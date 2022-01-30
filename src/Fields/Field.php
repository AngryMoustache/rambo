<?php

namespace AngryMoustache\Rambo\Fields;

use AngryMoustache\Rambo\Http\Livewire\Wireables\WireableField;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Below are some magic methods
 * @method $this label(string $label) Set the label of the field
 * @method $this searchable(boolean $searchable = true) Make the field searchable in the CMS
 * @method $this sortable(boolean $searchable = true) Make the field sortable on the overview page
 * @method $this default(mixed $defaultValue) The default value to fill in
 * @method $this readonly(boolean $readonly = true) Disables the field on forms
 * @method $this disabled(boolean $disabled = true) Disables the field on forms
 */
class Field extends WireableField
{
    public $showComponent = 'rambo::livewire.fields.show.text';
    public $livewireShowComponent = 'rambo-field-show-field';

    public $formComponent = 'rambo::livewire.fields.form.text';
    public $livewireFormComponent = 'rambo-field-form-field';

    public static function make($name = null)
    {
        return new static($name);
    }

    public function __construct($name = null, $label = null)
    {
        $this->name ??= $name;
        $this->label ??= Str::of($this->name)
            ->replace('_', ' ')
            ->ucfirst()
            ->__toString();
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

    public function getFormValue()
    {
        return $this->getValue();
    }

    /**
     * Do something before saving (returns the final value)
     */
    public function beforeSave($value, $fields, $id)
    {
        return $value;
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

    /**
     * Validation rules
     */
    public function rules($rules)
    {
        $this->rules = $rules;
        return $this->createRules($rules)->editRules($rules);
    }

    public function createRules($rules)
    {
        $this->createRules = Arr::wrap($rules);
        return $this;
    }

    public function editRules($rules)
    {
        $this->editRules = Arr::wrap($rules);
        return $this;
    }

    /**
     * Get validation rules, with separated create/edit rules if specified
     */
    public function getRules($stack = null)
    {
        $rules = collect($stack ? $this->{"${stack}Rules"} : $this->rules);

        // Livewire has a hard time understanding |, so we'll explode it
        $rules = $rules->map(fn ($rule) => explode('|', $rule))->flatten();

        return $rules->toArray();
    }
}
