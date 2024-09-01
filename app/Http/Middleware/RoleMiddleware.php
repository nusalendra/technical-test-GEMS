<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles): Response
    {
        if (auth()->check() && in_array(auth()->user()->role->nama, $roles)) {
            return $next($request);
        }

        switch (auth()->user()->role->nama) {
            case 'Manager':
                return redirect()->route('dashboard');
            case 'Karyawan':
                return redirect()->route('pengajuan-lembur');
            default:
                return redirect('/');
        }
    }
}
