<?php

namespace AngryMoustache\Rambo\Http\Exceptions;

use Exception;
use Illuminate\Http\Request;

class RamboUnauthorizedHttpException extends Exception
{
    public function render(Request $request)
    {
        return view('rambo::errors.unauthorized', [
            'titleForLayout' => '401',
        ]);
    }
}
