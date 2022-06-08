<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShippLineRequest;
use App\Http\Requests\UpdateShippLineRequest;
use App\Http\Resources\Admin\ShippLineResource;
use App\Models\ShippLine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShippLinesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('shipp_line_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShippLineResource(ShippLine::with(['seller', 'client', 'vehicle', 'status', 'shippment', 'user', 'order', 'team'])->get());
    }

    public function store(StoreShippLineRequest $request)
    {
        $shippLine = ShippLine::create($request->all());

        return (new ShippLineResource($shippLine))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ShippLine $shippLine)
    {
        abort_if(Gate::denies('shipp_line_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShippLineResource($shippLine->load(['seller', 'client', 'vehicle', 'status', 'shippment', 'user', 'order', 'team']));
    }

    public function update(UpdateShippLineRequest $request, ShippLine $shippLine)
    {
        $shippLine->update($request->all());

        return (new ShippLineResource($shippLine))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ShippLine $shippLine)
    {
        abort_if(Gate::denies('shipp_line_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippLine->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
