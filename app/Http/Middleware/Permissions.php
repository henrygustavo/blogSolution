<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class Permissions extends \Tymon\JWTAuth\Http\Middleware\BaseMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role) {
        if (!$token = $this->auth->setRequest($request)->getToken()) {
            return response()->json(['error' => 'token_not_provided'], 400);
        }

        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'token_expired'], 500);
        } catch (JWTException $e) {
            return response()->json(['error' =>  'token_invalid'], 500);
        }

        if (!$user) {
            return response()->json(['error' => 'user_not_found'], 404);
        }

        $currentrole = $this->auth->getPayload($token)->get('role');

        if (strcmp($currentrole, $role) !== 0) {
            return response()->json(['error' => 'access denied'], 401);
        }

        return $next($request);
    }

}