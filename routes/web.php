<?php

use AngryMoustache\Rambo\Http\Controllers\RamboAuthController;
use AngryMoustache\Rambo\Http\Middleware\RamboAuthMiddleware;
use Illuminate\Support\Facades\Route;

$adminRoute = config('rambo::admin-route', 'admin');

Route::middleware('web')->group(function () use ($adminRoute) {
    /**
     * Auth
     */
    Route::get("/${adminRoute}/login", [RamboAuthController::class, 'login'])->name('rambo.auth.login');
    Route::get("/${adminRoute}/logout", [RamboAuthController::class, 'logout'])->name('rambo.auth.logout');

    Route::middleware(RamboAuthMiddleware::class)->group(function () use ($adminRoute) {

    });
});
