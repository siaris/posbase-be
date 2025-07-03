<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use App\Models\User;

class CheckBearerToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if (!$token || $this->checkToken($token) === false) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $next($request);
    }

    private function checkToken($token)
    {
        $key = config('app.key');
        try{
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            if (empty(User::where('email',$decoded->id)->first())) {
                return false;
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
