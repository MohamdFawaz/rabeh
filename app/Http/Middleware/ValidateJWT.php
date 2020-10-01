<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ValidateJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * Handle an incoming request.
         *
         * @param  Request  $request
         * @param  Closure  $next
         * @return mixed
         */
        $token = str_replace('Bearer ', "", $request->header('Authorization'));

        try {
            JWTAuth::setToken($token);
            if (!$claim = JWTAuth::getPayload()) {
                return response()->json([
                    'message' => __('message.user_not_found')
                ], JsonResponse::HTTP_NOT_FOUND);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([
                'message' => __('message.token_expired')
            ], JsonResponse::HTTP_UNAUTHORIZED);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                'message' => __('message.token_invalid')
            ], JsonResponse::HTTP_UNAUTHORIZED);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json([
                'message' => __('message.token_absent')
            ], JsonResponse::HTTP_UNAUTHORIZED);
        } catch(\Exception $e){
            return response()->json([
                'message' => __('message.token_error')
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }

        // the token is valid and we have exposed the contents
        return $next($request);
    }
}
