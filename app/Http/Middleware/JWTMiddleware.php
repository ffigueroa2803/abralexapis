<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class JWTMiddleware
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
        $token = $request->auth_token;

        if ($token) {
            try {
                $user = User::where("auth_token", $token)->firsOrFail();
                return $next($request);
            } catch (\Throwable $th) {
                return [
                    "status" => 404,
                    "message" => "EL token a expírado :("
                ];
            }
        }

        return [
            "status" => 401,
            "message" => "No puedes pasar lol :v"
        ];
    }
}
