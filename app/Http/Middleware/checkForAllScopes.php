<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;


class CheckForAllScopes
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$scopes
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\AuthenticationException|\Laravel\Passport\Exceptions\MissingScopeException
     */
    public function handle($request, $next, ...$scopes)
    {
        if (! $request->user() || ! $request->user()->token()) {
            throw new AuthenticationException;
        }

        
            if ($request->user()->token()) {
                return $next($request);
            }
        

        return response( array( "message" => "Not Authorized." ), 403 );

    }
}