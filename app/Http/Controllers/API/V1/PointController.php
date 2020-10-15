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
        //todo add implementation for redeem points
        return $this->respondCreated([],__('message.points_redeemed_successfully'));
    }
}
