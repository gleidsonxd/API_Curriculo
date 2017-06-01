<?php

namespace App\Http\Middleware;

use Closure;

class HttpBasicAuth
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
 
        if($request->getUser() != 'admin' || $request->getPassword() != 'admin') {
            $headers = array('WWW-Authenticate' => 'Basic');
            return response('Unauthorized', 401, $headers);
        }
    

        return $next($request);
    }

}