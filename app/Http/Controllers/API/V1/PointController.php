<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ExchangeCashRequest;
use App\Http\Requests\API\RedeemPointsRequest;
use App\Models\Transaction;
use App\Models\User;

class PointController extends Controller
{
    use APIController;

    public function redeemPoints(RedeemPointsRequest $request)
    {
        try {
            $user = User::query()->select('id', 'point_balance')->where('id', $request->user_id)->first();
            if ($request->amount > $user->point_balance) {
                return $this->respondBadRequest(__('message.insufficient_points_amount'));
            }
            $user->point_balance -= $request->amount;
            $user->save();
            $response = ['point_balance' => $user->point_balance];
            return $this->respondCreated($response, __('message.points_redeemed_successfully'));
        }catch (\Exception $e){
            return $this->respondServerError($e);
        }
    }
}
