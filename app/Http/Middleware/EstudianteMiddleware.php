<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EstudianteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->user_type !== "estudiante") {
            return redirect()->route('home');
        }

        if ($request->user()->habilitado === 0) {
            return redirect()->route('cuenta_pendiente.index');
        }

        return $next($request);
    }
}
