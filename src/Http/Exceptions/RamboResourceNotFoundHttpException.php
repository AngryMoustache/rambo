<?php

namespace AngryMoustache\Rambo\Http\Exceptions;

use Exception;

class RamboResourceNotFoundHttpException extends Exception
{
    public function __construct(
        public $resource
    ) {}

    public function render()
    {
        return view('rambo::errors.resource-not-found', [
            'titleForLayout' => '404',
            'resource' => $this->resource,
        ]);
    }
}
