<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectTrailingSlash
{
    public function handle(Request $request, Closure $next)
    {
        $path = parse_url($request->server('REQUEST_URI', ''), PHP_URL_PATH) ?: $request->getPathInfo();

        if (
            in_array($request->method(), ['GET', 'HEAD'], true)
            && $path !== '/'
            && str_ends_with($path, '/')
            && ! str_starts_with($path, '/admin/')
        ) {
            $target = $request->getSchemeAndHttpHost() . rtrim($path, '/');
            $query = $request->getQueryString();

            return redirect($query ? $target . '?' . $query : $target, 301);
        }

        return $next($request);
    }
}
