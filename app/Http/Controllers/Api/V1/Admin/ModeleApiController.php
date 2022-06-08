<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreModeleRequest;
use App\Http\Requests\UpdateModeleRequest;
use App\Http\Resources\Admin\ModeleResource;
use App\Models\Modele;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModeleApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('modele_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ModeleResource(Modele::with(['make'])->get());
    }

    public function store(StoreModeleRequest $request)
    {
        $modele = Modele::create($request->all());

        return (new ModeleResource($modele))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Modele $modele)
    {
        abort_if(Gate::denies('modele_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ModeleResource($modele->load(['make']));
    }

    public function update(UpdateModeleRequest $request, Modele $modele)
    {
        $modele->update($request->all());

        return (new ModeleResource($modele))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Modele $modele)
    {
        abort_if(Gate::denies('modele_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modele->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
