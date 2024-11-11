<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsEndUser;
use App\Http\Middleware\IsSuperAdmin;
use App\Http\Middleware\PreventReLogin;
;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'is_admin' => isAdmin::class,
            'is_Enduser' => isEndUser::class,
            'is_superadmin' => isSuperAdmin::class,
            'prevent.relogin' => \App\Http\Middleware\PreventReLogin::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
