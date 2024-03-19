<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class SetEventSchedulerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Activar el event_scheduler
        DB::statement('SET GLOBAL event_scheduler="ON"');

        return $next($request);
    }
}
