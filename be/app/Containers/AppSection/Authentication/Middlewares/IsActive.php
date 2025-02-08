<?php

namespace App\Containers\AppSection\Authentication\Middlewares;

use App\Ship\Parents\Middlewares\Middleware as ParentMiddleware;
use Closure;
use Illuminate\Http\Request;

class IsActive extends ParentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $user = $request->user();
        if ($user AND $user->status == 'disable')  {
            return abort(401);
        }
        
        return $next($request);
    }
}
