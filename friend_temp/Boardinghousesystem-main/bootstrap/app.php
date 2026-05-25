<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        
        // 🌟 LINK YOUR CLIENT.PHP FILE TO THE SYSTEM HERE:
        then: function () {
            Route::middleware('web')
                ->group(__DIR__.'/../routes/client.php');
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // Dynamically redirect unauthenticated users based on their target URL path
        $middleware->redirectTo(function (Request $request) {
            
            // If trying to access client dashboard, send them to the client login route
            if ($request->is('client/*') || $request->is('client')) {
                return route('client.login'); 
            }
            
            // Otherwise, let it fall back to your normal admin/default login
            return route('login'); 
        });

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();