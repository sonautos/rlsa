<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrdersListRequest;
use App\Http\Requests\UpdateOrdersListRequest;
use App\Http\Resources\Admin\OrdersListResource;
use App\Models\OrdersList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdersListApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('orders_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrdersListResource(OrdersList::with(['entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team'])->get());
    }

    public function store(StoreOrdersListRequest $request)
    {
        $ordersList = OrdersList::create($request->all());

        return (new OrdersListResource($ordersList))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OrdersList $ordersList)
    {
        abort_if(Gate::denies('orders_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrdersListResource($ordersList->load(['entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team']));
    }

    public function update(UpdateOrdersListRequest $request, OrdersList $ordersList)
    {
        $ordersList->update($request->all());

        return (new OrdersListResource($ordersList))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OrdersList $ordersList)
    {
        abort_if(Gate::denies('orders_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ordersList->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
