<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShippStatusRequest;
use App\Http\Requests\UpdateShippStatusRequest;
use App\Http\Resources\Admin\ShippStatusResource;
use App\Models\ShippStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShippStatusesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('shipp_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShippStatusResource(ShippStatus::all());
    }

    public function store(StoreShippStatusRequest $request)
    {
        $shippStatus = ShippStatus::create($request->all());

        return (new ShippStatusResource($shippStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ShippStatus $shippStatus)
    {
        abort_if(Gate::denies('shipp_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShippStatusResource($shippStatus);
    }

    public function update(UpdateShippStatusRequest $request, ShippStatus $shippStatus)
    {
        $shippStatus->update($request->all());

        return (new ShippStatusResource($shippStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ShippStatus $shippStatus)
    {
        abort_if(Gate::denies('shipp_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
