<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\TicketResource;
use App\Models\Ticket;

class TicketController extends Controller
{
    use APIController;

    public function index()
    {
        $tickets = Ticket::query()->withTranslation()->paginate(6);

        return $this->respond(TicketResource::collection($tickets));

    }
}
