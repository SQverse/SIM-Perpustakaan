<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // 1. Mendaftarkan alias middleware kamu
        $middleware->alias([
            'cekrole' => \App\Http\Middleware\CekRole::class
        ]);

        // 2. Memaksa Laravel memercayai HTTPS dari Railway (Trust Proxies)
        $middleware->trustProxies(at: '*');
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();