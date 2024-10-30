<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SanitizeInput
{
    //Middleware para limpiar los campos de los inputs de un formulario
    public function handle(Request $request, Closure $next): Response
    {
        $input = $request->all();
        array_walk_recursive($input, function (&$item) {
            $item = preg_replace('/[^A-Za-z0-9@_ ]/', '', $item);
        });
        $request->merge($input);

        return $next($request);
    }
}
