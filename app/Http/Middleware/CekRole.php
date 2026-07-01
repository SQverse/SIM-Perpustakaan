<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <-- INI DIA PENYELAMATNYA!

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Kunci VIP untuk Admin
        if (Auth::user()->role == 'admin') {
            return $next($request);
        }

        // Cek role sesuai rute
        if (Auth::user()->role == $role) {
            return $next($request);
        }

        return abort(403, 'Maaf, Anda tidak memiliki akses ke halaman ini.');
    }
}