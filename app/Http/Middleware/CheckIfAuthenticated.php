<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Logika untuk memeriksa apakah pengguna telah masuk
        if (!Auth::check()) {
            return redirect('login'); // Redirect ke halaman login jika pengguna belum masuk
        }

        return $next($request); // Lanjutkan permintaan jika pengguna telah masuk
    }
}
