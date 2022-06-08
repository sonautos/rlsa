<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntityRequest;
use App\Http\Requests\UpdateEntityRequest;
use App\Http\Resources\Admin\EntityResource;
use App\Models\Entity;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntityApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('entity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntityResource(Entity::with(['team'])->get());
    }

    public function store(StoreEntityRequest $request)
    {
        $entity = Entity::create($request->all());

        return (new EntityResource($entity))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Entity $entity)
    {
        abort_if(Gate::denies('entity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EntityResource($entity->load(['team']));
    }

    public function update(UpdateEntityRequest $request, Entity $entity)
    {
        $entity->update($request->all());

        return (new EntityResource($entity))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Entity $entity)
    {
        abort_if(Gate::denies('entity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entity->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
