<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCondReglementRequest;
use App\Http\Requests\UpdateCondReglementRequest;
use App\Http\Resources\Admin\CondReglementResource;
use App\Models\CondReglement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CondReglementApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cond_reglement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CondReglementResource(CondReglement::all());
    }

    public function store(StoreCondReglementRequest $request)
    {
        $condReglement = CondReglement::create($request->all());

        return (new CondReglementResource($condReglement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CondReglement $condReglement)
    {
        abort_if(Gate::denies('cond_reglement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CondReglementResource($condReglement);
    }

    public function update(UpdateCondReglementRequest $request, CondReglement $condReglement)
    {
        $condReglement->update($request->all());

        return (new CondReglementResource($condReglement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CondReglement $condReglement)
    {
        abort_if(Gate::denies('cond_reglement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $condReglement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
