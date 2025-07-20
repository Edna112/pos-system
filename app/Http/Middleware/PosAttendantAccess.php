<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PosAttendantAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->hasRole('POS Attendant')) {
            // POS Attendants can only access dashboard and POS routes
            $allowedRoutes = [
                'dashboard',
                'dashboard.search',
                'pos.index',
                'pos.products'
            ];
            
            if (!in_array($request->route()->getName(), $allowedRoutes)) {
                abort(403, 'Access denied. POS Attendants can only access Dashboard and Point of Sale.');
            }
        }

        return $next($request);
    }
} 