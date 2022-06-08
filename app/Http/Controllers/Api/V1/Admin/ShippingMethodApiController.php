<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShippingMethodRequest;
use App\Http\Requests\UpdateShippingMethodRequest;
use App\Http\Resources\Admin\ShippingMethodResource;
use App\Models\ShippingMethod;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShippingMethodApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('shipping_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShippingMethodResource(ShippingMethod::all());
    }

    public function store(StoreShippingMethodRequest $request)
    {
        $shippingMethod = ShippingMethod::create($request->all());

        return (new ShippingMethodResource($shippingMethod))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ShippingMethod $shippingMethod)
    {
        abort_if(Gate::denies('shipping_method_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShippingMethodResource($shippingMethod);
    }

    public function update(UpdateShippingMethodRequest $request, ShippingMethod $shippingMethod)
    {
        $shippingMethod->update($request->all());

        return (new ShippingMethodResource($shippingMethod))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ShippingMethod $shippingMethod)
    {
        abort_if(Gate::denies('shipping_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippingMethod->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
