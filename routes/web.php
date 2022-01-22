<?php

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Http\Controllers\RamboAuthController;
use AngryMoustache\Rambo\Http\Livewire\Auth\RamboLogin;
use AngryMoustache\Rambo\Http\Middleware\RamboAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix(config('rambo::admin-route', 'admin'))->group(function () {
    Route::middleware('web')->group(function () {
        /** Auth */
        Route::get('login', RamboLogin::class)->name('rambo.auth.login');
        Route::get('logout', function () {
            Rambo::logout();
            return redirect(route('rambo.auth.login'));
        })->name('rambo.auth.logout');

        /** CRUD */
        Route::middleware(RamboAuthMiddleware::class)->group(function () {
            // Route::get('', RamboDashboard::class)->name('rambo.dashboard');
        });
    });
});
