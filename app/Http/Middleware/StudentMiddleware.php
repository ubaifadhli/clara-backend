<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware {
    
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role == 'Student') {
            return $next($request);
        }

        return response('Permission denied. This is only for student');
    }
}

?>