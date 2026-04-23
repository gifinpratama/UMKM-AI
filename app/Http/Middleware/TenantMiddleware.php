<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->tenant_id) {
            abort(403, 'Tenant tidak ditemukan.');
        }

        // Share tenant_id with all views
        view()->share('tenant_id', auth()->user()->tenant_id);

        return $next($request);
    }
}
