<?php

namespace AngryMoustache\Rambo\Http\Exceptions;

use Exception;
use Illuminate\Http\Request;

class RamboResourceNotFoundHttpException extends Exception
{
    public function render(Request $request)
    {
        return view('rambo::errors.resource-not-found', [
            'titleForLayout' => '404',
            'resource' => request()->resource,
        ]);
    }
}
