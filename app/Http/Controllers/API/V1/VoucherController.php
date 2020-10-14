<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\TicketResource;
use App\Http\Resources\API\VoucherResource;
use App\Models\Voucher;

class VoucherController extends Controller
{
    use APIController;

    public function index()
    {
        $vouchers = Voucher::query()->withTranslation()->get();

        return $this->respond(VoucherResource::collection($vouchers));

    }
}
