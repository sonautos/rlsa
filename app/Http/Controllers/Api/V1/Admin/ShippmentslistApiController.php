<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShippmentslistRequest;
use App\Http\Requests\UpdateShippmentslistRequest;
use App\Http\Resources\Admin\ShippmentslistResource;
use App\Models\Shippmentslist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShippmentslistApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('shippmentslist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShippmentslistResource(Shippmentslist::with(['entity', 'status', 'user', 'team'])->get());
    }

    public function store(StoreShippmentslistRequest $request)
    {
        $shippmentslist = Shippmentslist::create($request->all());

        return (new ShippmentslistResource($shippmentslist))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Shippmentslist $shippmentslist)
    {
        abort_if(Gate::denies('shippmentslist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShippmentslistResource($shippmentslist->load(['entity', 'status', 'user', 'team']));
    }

    public function update(UpdateShippmentslistRequest $request, Shippmentslist $shippmentslist)
    {
        $shippmentslist->update($request->all());

        return (new ShippmentslistResource($shippmentslist))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Shippmentslist $shippmentslist)
    {
        abort_if(Gate::denies('shippmentslist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippmentslist->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
