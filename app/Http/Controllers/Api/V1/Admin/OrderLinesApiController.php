<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderLineRequest;
use App\Http\Requests\UpdateOrderLineRequest;
use App\Http\Resources\Admin\OrderLineResource;
use App\Models\OrderLine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderLinesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_line_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrderLineResource(OrderLine::with(['order', 'product', 'service', 'vehicle', 'status', 'team'])->get());
    }

    public function store(StoreOrderLineRequest $request)
    {
        $orderLine = OrderLine::create($request->all());

        return (new OrderLineResource($orderLine))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OrderLine $orderLine)
    {
        abort_if(Gate::denies('order_line_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrderLineResource($orderLine->load(['order', 'product', 'service', 'vehicle', 'status', 'team']));
    }

    public function update(UpdateOrderLineRequest $request, OrderLine $orderLine)
    {
        $orderLine->update($request->all());

        return (new OrderLineResource($orderLine))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OrderLine $orderLine)
    {
        abort_if(Gate::denies('order_line_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderLine->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
