<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\EntityResource;
use App\Http\Resources\API\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    use APIController;

    public function index()
    {
        $tickets = Ticket::query()->withTranslation()->paginate(6);

        return $this->respond(TicketResource::collection($tickets),['last_page' => $tickets->lastPage()]);

    }
}
