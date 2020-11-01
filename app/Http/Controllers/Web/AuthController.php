<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
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

    public function verifyEmail()
    {
        $email = request()->get('email');
        $token = request()->get('token');
        if ($email && $token){
            $verify_mail = DB::table('mail_verification')
                ->select('email','token')
                ->where('email',$email)
                ->where('token',$token)->orderBy('id','desc')->first();
            if ($verify_mail){
                $user = User::query()->where('email',$email)->first();
                $user->email_verified_at = Carbon::now();
                $code = User::query()->max('user_code');
                $latest_code = (int)$code;
                $user->user_code = str_pad(($latest_code + 1),4,"0",STR_PAD_LEFT);
                $user->referral_code = str_pad(($latest_code + 1),4,"0",STR_PAD_LEFT);
                $user->save();
                DB::table('mail_verification')->where('email',$email)->delete();
                return view('web.email_verified_page');
            }else{
                return view('web.email_expired_or_incorrect_page');
            }
        }
        return view('web.email_expired_or_incorrect_page');
    }
}
