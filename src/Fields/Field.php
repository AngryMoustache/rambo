<?php

namespace AngryMoustache\Rambo\Fields;

use AngryMoustache\Rambo\Http\Livewire\Wireables\WireableRamboItem;
use AngryMoustache\Rambo\Traits\RamboMagic;
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
class Field extends WireableRamboItem
{
    use RamboMagic;

    public $bladeShowComponent = 'rambo::livewire.fields.show.text';
    public $livewireShowComponent = null;

    public $bladeFormComponent = 'rambo::livewire.fields.form.text';
    public $livewireFormComponent = null;

    public $indexWrapperComponent = 'rambo::components.crud.fields.wrapper-index';
    public $showWrapperComponent = 'rambo::components.crud.fields.wrapper-show';

    // Don't update the field when it's null (useful for password fields)
    public $unsetWhenNull = false;

    // Set this to true if the field is supposed to save HABTM relations
    public $hasManyRelation = false;

    // Validation rules
    public $createRules = [];
    public $editRules = [];

    public $hideLabelOnShow = false;

    public static function make($name = null, $label = null)
    {
        return new static($name, $label);
    }

    public function __construct($name = null, $label = null)
    {
        $this->name ??= $name;
        $this->label ??= $label ?? (string) Str::of($this->name)->replace('_', ' ')->ucfirst();
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
        return $this->getValue() ?? $this->getDefault();
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
    public function search($query, $item = null)
    {
        return Str::contains(
            strtolower(($item ?? $this->item)->{$this->getName()}),
            strtolower($query)
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
        $stack = ucfirst($stack);
        $rules = collect($stack ? $this->{"get${stack}Rules"}() : $this->rules);

        // Livewire has a hard time understanding |, so we'll explode it
        $rules = $rules->map(fn ($rule) => explode('|', $rule))->flatten();

        return $rules->toArray();
    }

    /**
     * Blade wrapper files for showing values
     */
     public function getWrapperComponent()
     {
        $page = ucfirst($this->getStack() ?? '');
        return $this->{"get${page}Wrapper"}();
     }
}
