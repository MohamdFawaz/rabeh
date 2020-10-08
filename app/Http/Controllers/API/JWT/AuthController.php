<?php

namespace App\Http\Controllers\API\JWT;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Resources\API\ProfileResource;
use App\Http\Resources\API\UserResource;
use App\Mail\NewUserVerificationMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends Controller
{
    use APIController;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Register a User.
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::query()->create(array_merge(
            $request->all(),
            ['password' => bcrypt($request->password)]
        ));


        $token = auth('api')->login($user);

        $this->setTokenAttributes($user, $token);

        try {
           $mail =  Mail::to($request->email)->send(new NewUserVerificationMail());
        }catch (\Exception $e){
            dd($e->getMessage());
        }

        return $this->respond(UserResource::make($user));
    }

    /**
     * Get a JWT via given credentials.
     * @param  LoginRequest  $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (! $token = auth('api')->attempt($request->only('email','password'))) {
            return $this->respondUnauthorized(__('message.unauthorized'));
        }
        $user = auth('api')->user();

        $this->setTokenAttributes($user, $token);

        return $this->respond(UserResource::make($user));
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function profile()
    {
        $user = UserResource::make(User::query()->find(request()->user_id));
        return $this->respond($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        $user = User::query()->find(request()->user_id);
        $user->setRememberToken('');
        $user->save();

        return $this->respond([],'Successfully logged out');
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respond($this->createNewToken(auth('api')->refresh()));
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return array
     */
    protected function createNewToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
    }

    protected function setTokenAttributes(&$user,$token)
    {
        $user->remember_token = $token;
        $user->save();

        $user->setAttribute('token', $token);
        $user->setAttribute('expires_in', auth('api')->factory()->getTTL() * 60);
    }
}
