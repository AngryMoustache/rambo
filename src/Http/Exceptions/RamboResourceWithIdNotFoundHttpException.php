<?php

namespace AngryMoustache\Rambo\Http\Exceptions;

use Exception;
use Illuminate\Http\Request;

class RamboResourceWithIdNotFoundHttpException extends Exception
{
    public function render(Request $request)
    {
        return view('rambo::errors.resource-with-id-not-found', [
            'titleForLayout' => '404',
            'resource' => request()->resource,
            'itemId' => request()->itemId,
        ]);
    }
}
