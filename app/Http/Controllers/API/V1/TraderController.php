<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Enums\ACurrencies;
use App\Http\Requests\API\ExchangeCashRequest;
use App\Models\Transaction;
use App\Models\User;

class TraderController extends Controller
{
    use APIController;

    public function exchangeCash(ExchangeCashRequest $request)
    {
        try {
            $source_id = $request->user_id;
            $target = User::query()->where('user_code', $request->member_code)->first();
            if (!$target) {
                return $this->respondNotFound(__('message.invalid_user_code'));
            }
            $target_id = $target->id;

            $amount = $request->paid_amount - $request->price;

            Transaction::query()->create([
                'source_id' => $source_id,
                'target_id' => $target_id,
                'type' => 'cash_exchange',
                'currency_id' => ACurrencies::COINS,
                'transaction_amount' => $amount * .25
            ]);

            $target->point_balance = round($amount * .25);
            $target->save();
            return $this->respondCreated([], __('message.coins_added_successfully'));
        }catch (\Exception $e){
            return $this->respondServerError($e);
        }
    }
}
