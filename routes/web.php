<?php

use AngryMoustache\Rambo\Http\Controllers\CrudController;
use AngryMoustache\Rambo\Http\Controllers\DashboardController;
use AngryMoustache\Rambo\Http\Controllers\RamboAuthController;
use AngryMoustache\Rambo\Http\Middleware\RamboAuthMiddleware;
use Illuminate\Support\Facades\Route;

$adminRoute = config('rambo.admin-route', 'admin');

Route::middleware('web')->group(function () use ($adminRoute) {
    /**
     * Auth
     */
    Route::get("/${adminRoute}/login", [RamboAuthController::class, 'login'])
        ->name('rambo.auth.login');

    Route::get("/${adminRoute}/logout", [RamboAuthController::class, 'logout'])
        ->name('rambo.auth.logout');

    Route::middleware(RamboAuthMiddleware::class)->group(function () use ($adminRoute) {
        /**
         * Dashboard
         */
        Route::get("/${adminRoute}", DashboardController::class)
            ->name('rambo.dashboard');

        /**
         * Resources
         */
        Route::get("/${adminRoute}/{resource}", [CrudController::class, 'index'])
            ->name('rambo.crud.index');

        Route::get("/${adminRoute}/{resource}/create", [CrudController::class, 'create'])
            ->name('rambo.crud.create');

        Route::get("/${adminRoute}/{resource}/{id}", [CrudController::class, 'show'])
            ->name('rambo.crud.show');

        Route::get("/${adminRoute}/{resource}/{id}/edit", [CrudController::class, 'edit'])
            ->name('rambo.crud.edit');

        Route::get("/${adminRoute}/{resource}/{id}/delete", [CrudController::class, 'delete'])
            ->name('rambo.crud.delete');

        Route::get("/${adminRoute}/{resource}/{id}/delete-confirm", [CrudController::class, 'deleteConfirm'])
            ->name('rambo.crud.delete-confirm');
    });
});
