<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RedeemVoucherRequest;
use App\Http\Resources\API\VoucherResource;
use App\Models\Transaction;
use App\Models\Voucher;

class VoucherController extends Controller
{
    use APIController;

    public function index()
    {
        $vouchers = Voucher::query()->withTranslation()->get();

        return $this->respond(VoucherResource::collection($vouchers));

    }

    public function redeemVoucher(RedeemVoucherRequest $request)
    {
        $voucher = Voucher::query()->find($request->voucher_id);

        if (!$voucher){
            return $this->respondNotFound();
        }

        $checkIfRedeemed = Transaction::query()
            ->where('entity_id',$request->voucher_id)
            ->where('source_id',$request->user_id)
            ->where('type','redeem_voucher')
            ->exists();

        if($checkIfRedeemed){
            return $this->respondBadRequest(__('message.voucher_already_redeemed'));
        }
        $newTransaction = new Transaction();
        $newTransaction->source_id = $request->user_id;
        $newTransaction->type = 'redeem_voucher';
        $newTransaction->currency_id = 2;
        $newTransaction->transaction_amount = $voucher->price;
        $newTransaction->entity_id = $request->voucher_id;
        $newTransaction->save();
        return $this->respondCreated([]);
    }
}
