<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function resetPassword()
    {
        $token = \request()->query->get('token');
        $password_reset = DB::table('password_resets')
            ->where('token',$token)
            ->first();

        if($token && $password_reset){
            return view('web.reset_password',compact('password_reset'));
        }else{
            throw abort(404);
        }
    }

    public function updatePassword(Request $request)
    {
        $user = User::query()->where('email',$request->email)->first();

        $user->password = bcrypt($request->password);
        $user->save();

        DB::table('password_resets')->where('token',$request->token)->delete();

        return view('web.password_updated_page');
    }
}
