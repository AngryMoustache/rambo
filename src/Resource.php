<?php

namespace AngryMoustache\Rambo;

use Illuminate\Support\Str;

abstract class Resource
{
    use \AngryMoustache\Rambo\Traits\Actions;
    use \AngryMoustache\Rambo\Traits\Fields;
    use \AngryMoustache\Rambo\Traits\Labels;
    use \AngryMoustache\Rambo\Traits\Routing;
    use \AngryMoustache\Rambo\Traits\Queries;
    use \AngryMoustache\Rambo\Traits\Rendering;

    public $model;

    public function __construct()
    {
        $name = Str::afterLast(get_class($this), '\\');
        $label = Str::ucfirst(implode(' ', preg_split('/(?=[A-Z])/', $name)));
        $this->singularLabel ??= trim(Str::afterLast($label, '\\'));
        $this->label ??= trim(Str::plural($this->singularLabel));
        $this->routebase ??= Str::kebab($this->label);
        $this->model ??= 'App\\Models\\' . $name;
    }

    public function model()
    {
        return $this->model;
    }
}