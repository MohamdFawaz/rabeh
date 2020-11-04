<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Enums\ACurrencies;
use App\Http\Requests\API\ExchangeCashRequest;
use App\Http\Services\PushNotificationService;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TraderController extends Controller
{
    use APIController;

    public function exchangeCash(ExchangeCashRequest $request)
    {
        try {
            DB::beginTransaction();
            $source_id = $request->user_id;
            $user = User::query()->where('user_code', $request->member_code)->first();
            if (!$user) {
                return $this->respondNotFound(__('message.invalid_user_code'));
            }

            $amount = $request->paid_amount - $request->price;
            if ($amount == 0){
                $amount = $request->paid_amount;
            }

            $trader = User::query()->where('id',$source_id)->first();

            if (!$this->deductCashFromTraderAndAddPointsToUser($user, $trader, $amount, 1))
            {
                DB::rollBack();
                return $this->respondBadRequest(__('message.insufficient_cash_amount'));
            }

            if (!$this->addCoinsToUserAndDeductCashFromTrader($user,$trader,$request->price,1)){
                DB::rollBack();
                return $this->respondBadRequest(__('message.insufficient_cash_amount'));
            }

            $addedAmount = $this->addUserCoins($user,$amount);
            PushNotificationService::sendTransactionNotification('',
                '+'
                ,$addedAmount,
                'Coins',$user->firebase_token);
            DB::commit();
            return $this->respondCreated([], __('message.exchanged_successfully'));
        } catch (\Exception $e) {
            return $this->respondServerError($e);
        }
    }

    private function deductCashFromTraderAndAddPointsToUser($user, $trader, $amount, $ratio)
    {
        //add to user balance
        $user->point_balance += ($amount * $ratio);
        $user->save();

        //subtract from trader balance
        $trader->cash_balance -= ($amount * $ratio);
        if ($trader->cash_balance < 0){
            return false;
        }
        $trader->save();
        return true;
    }

    private function addCoinsToUserAndDeductCashFromTrader($user,$trader,$price,$ratio)
    {
        $user->coin_balance += $price;
        $user->save();

        $trader->point_balance -= ($price * $ratio);
        if ($trader->point_balance < 0){
            return false;
        }
        $trader->save();
        return true;
    }

    private function addUserCoins($user, $amount)
    {
        $user->coin_balance += ($amount * 100);
        $user->save();

        return ($amount * 100);
    }

}
