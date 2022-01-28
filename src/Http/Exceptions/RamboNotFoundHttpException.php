<?php

namespace AngryMoustache\Rambo\Http\Exceptions;

use Exception;
use Illuminate\Http\Request;

class RamboNotFoundHttpException extends Exception
{
    public function render(Request $request)
    {
        return view('rambo::errors.404', [
            'titleForLayout' => '404',
            'message' => '404 - Page not found!',
            'longMessage' => 'Sorry, the page you are looking for doesn\'t exist.',
        ]);
    }
}
