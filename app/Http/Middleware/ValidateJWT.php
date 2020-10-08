<?php

namespace App\Http\Middleware;

use App\Models\User;
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
           $user = User::query()->where('remember_token',$token)->firstOrFail();
           $request->merge(['user_id' => $user->id]);
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
