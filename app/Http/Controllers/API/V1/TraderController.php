<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ExchangeCashRequest;
use App\Models\Transaction;
use App\Models\User;

class TraderController extends Controller
{
    use APIController;

    public function exchangeCash(ExchangeCashRequest $request)
    {
        $source_id = $request->user_id;
        $target = User::query()->where('user_code',$request->member_code)->first();
        if (!$target){
            return $this->respondNotFound(__('message.invalid_user_code'));
        }
        $target_id = $target->id;

        $amount = $request->paid_amount - $request->price;

        Transaction::query()->create([
            'source_id' => $source_id,
            'target_id' => $target_id,
            'type' => 'cash_exchange',
            'currency_id' => 1,
            'transaction_amount' => $amount * .25
        ]);

        return $this->respondCreated([],__('message.coins_added_successfully'));
    }
}