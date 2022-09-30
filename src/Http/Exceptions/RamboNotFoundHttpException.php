<?php

namespace AngryMoustache\Rambo\Http\Exceptions;

use Exception;
use Illuminate\Http\Request;

class RamboNotFoundHttpException extends Exception
{
    public function render(Request $request)
    {
        return view('rambo::errors.not-found', [
            'titleForLayout' => '404',
        ]);
    }
}
