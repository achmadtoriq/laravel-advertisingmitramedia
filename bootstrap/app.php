<?php

use App\Http\Middleware\RedirectTrailingSlash;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            RedirectTrailingSlash::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            $refererPath = parse_url($request->headers->get('referer', ''), PHP_URL_PATH) ?: '';
            $fromAdmin = str_starts_with($refererPath, '/admin');
            $isAdminRequest = $request->is('admin') || $request->is('admin/*');

            if (! $request->expectsJson() && $fromAdmin) {
                return redirect($refererPath === '/admin' ? '/admin/dashboard' : $refererPath);
            }

            if (! $request->expectsJson() && ! $isAdminRequest && ! $fromAdmin) {
                return redirect('/');
            }

            return null;
        });
    })->create();
