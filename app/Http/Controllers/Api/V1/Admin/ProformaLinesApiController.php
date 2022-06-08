<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProformaLineRequest;
use App\Http\Requests\UpdateProformaLineRequest;
use App\Http\Resources\Admin\ProformaLineResource;
use App\Models\ProformaLine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProformaLinesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('proforma_line_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProformaLineResource(ProformaLine::with(['proforma', 'product', 'service', 'vehicle', 'status', 'team'])->get());
    }

    public function store(StoreProformaLineRequest $request)
    {
        $proformaLine = ProformaLine::create($request->all());

        return (new ProformaLineResource($proformaLine))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProformaLine $proformaLine)
    {
        abort_if(Gate::denies('proforma_line_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProformaLineResource($proformaLine->load(['proforma', 'product', 'service', 'vehicle', 'status', 'team']));
    }

    public function update(UpdateProformaLineRequest $request, ProformaLine $proformaLine)
    {
        $proformaLine->update($request->all());

        return (new ProformaLineResource($proformaLine))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProformaLine $proformaLine)
    {
        abort_if(Gate::denies('proforma_line_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proformaLine->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
