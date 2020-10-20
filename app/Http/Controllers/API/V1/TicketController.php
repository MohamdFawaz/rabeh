<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RedeemTicketRequest;
use App\Http\Resources\API\TicketResource;
use App\Models\Ticket;
use App\Models\Transaction;

class TicketController extends Controller
{
    use APIController;

    public function index()
    {
        $tickets = Ticket::query()->withTranslation()->paginate(6);

        return $this->respond(TicketResource::collection($tickets));

    }

    public function redeemTicket(RedeemTicketRequest $request)
    {
        $ticket = Ticket::query()->find($request->ticket_id);

        if (!$ticket){
            return $this->respondNotFound();
        }

        $checkIfRedeemed = Transaction::query()
                           ->where('entity_id',$request->ticket_id)
                           ->where('source_id',$request->user_id)
                           ->where('type','redeem_ticket')
                           ->exists();

        if($checkIfRedeemed){
            return $this->respondBadRequest(__('message.ticket_already_redeemed'));
        }
        $newTransaction = new Transaction();
        $newTransaction->source_id = $request->user_id;
        $newTransaction->type = 'redeem_ticket';
        $newTransaction->currency_id = 2;
        $newTransaction->transaction_amount = $ticket->price;
        $newTransaction->entity_id = $request->ticket_id;
        $newTransaction->save();
        return $this->respondCreated([]);
    }
}
