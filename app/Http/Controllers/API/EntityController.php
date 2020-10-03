<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\EntityResource;
use App\Models\Entity;

class EntityController extends Controller
{
    use APIController;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index()
    {
        $entities = Entity::query()->withTranslation()->paginate(6);

        return $this->respond(EntityResource::collection($entities),['last_page' => $entities->lastPage()]);
    }

    public function offerBanner()
    {
        $offer_entities = Entity::query()->withTranslation()->paginate(3);

        return $this->respond(EntityResource::collection($offer_entities),['last_page' => $offer_entities->lastPage()]);
    }
}
