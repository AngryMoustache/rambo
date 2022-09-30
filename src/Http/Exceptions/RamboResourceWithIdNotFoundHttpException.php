<?php

namespace AngryMoustache\Rambo\Http\Exceptions;

use Exception;

class RamboResourceWithIdNotFoundHttpException extends Exception
{
    public function __construct(
        public $resource,
        public $itemId
    ) {}

    public function render()
    {
        return view('rambo::errors.resource-with-id-not-found', [
            'titleForLayout' => '404',
            'resource' => $this->resource,
            'itemId' => $this->itemId,
        ]);
    }
}
