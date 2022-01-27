<?php

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Http\Livewire\Auth\Login;
use AngryMoustache\Rambo\Http\Livewire\Crud\ResourceIndex;
use AngryMoustache\Rambo\Http\Livewire\Dashboard\Dashboard;
use AngryMoustache\Rambo\Http\Middleware\RamboAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix(config('rambo::admin-route', 'admin'))->group(function () {
    Route::middleware('web')->group(function () {
        /** Auth */
        Route::get('login', Login::class)->name('rambo.auth.login');
        Route::get('logout', function () {
            Rambo::logout();
            return redirect(route('rambo.auth.login'));
        })->name('rambo.auth.logout');

        Route::middleware(RamboAuthMiddleware::class)->group(function () {
            Route::get('', Dashboard::class)->name('rambo.dashboard');

            /** CRUD */
            Route::get('{resource}', ResourceIndex::class)->name('rambo.crud.index');
            Route::get('{resource}/create', Dashboard::class)->name('rambo.crud.create');
            Route::get('{resource}/{id}', Dashboard::class)->name('rambo.crud.show');
            Route::get('{resource}/{id}/edit', Dashboard::class)->name('rambo.crud.edit');
        });
    });
});
