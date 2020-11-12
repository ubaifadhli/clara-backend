<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LecturerMiddleware {
    
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role == 'Lecturer') {
            return $next($request);
        }

        return response('Permission denied. This is only for lecturer');
    }
}

?>