<?php

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
        // Comente el middleware CSRF
        $middleware->statefulApi();
        $middleware->validateCsrfTokens(
            // Especifique las rutas a excluir de la protección CSRF
            except: ['/*', 'login', 'register']
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
