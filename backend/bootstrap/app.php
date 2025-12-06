<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // 🔹 Sanctum para SPA (cookies + sesión)
        $middleware->statefulApi();

        // 🔹 CSRF: excluir login y logout (para poder probar cómodo con Postman)
        $middleware->validateCsrfTokens(
            except: [
                '/login',
                '/logout',
            ],
        );

        // Si quieres añadir globales, web o api:
        // $middleware->append(...);
        // $middleware->web(append: [...]);
        // $middleware->api(append: [...]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
