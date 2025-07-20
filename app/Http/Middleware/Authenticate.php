<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        
        if (!$request->expectsJson()) {
            // Si está accediendo a una ruta protegida como usuario
            if ($request->is('portal*')) {
                return route('cliente.login');
            }

            // Por defecto, redirige al login de usuario interno
            return route('user.login');
        }
    }
}
