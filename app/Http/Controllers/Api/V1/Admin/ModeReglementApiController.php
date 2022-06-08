<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreModeReglementRequest;
use App\Http\Requests\UpdateModeReglementRequest;
use App\Http\Resources\Admin\ModeReglementResource;
use App\Models\ModeReglement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModeReglementApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mode_reglement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ModeReglementResource(ModeReglement::all());
    }

    public function store(StoreModeReglementRequest $request)
    {
        $modeReglement = ModeReglement::create($request->all());

        return (new ModeReglementResource($modeReglement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ModeReglement $modeReglement)
    {
        abort_if(Gate::denies('mode_reglement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ModeReglementResource($modeReglement);
    }

    public function update(UpdateModeReglementRequest $request, ModeReglement $modeReglement)
    {
        $modeReglement->update($request->all());

        return (new ModeReglementResource($modeReglement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ModeReglement $modeReglement)
    {
        abort_if(Gate::denies('mode_reglement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modeReglement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
