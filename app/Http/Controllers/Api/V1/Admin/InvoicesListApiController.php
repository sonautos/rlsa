<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoicesListRequest;
use App\Http\Requests\UpdateInvoicesListRequest;
use App\Http\Resources\Admin\InvoicesListResource;
use App\Models\InvoicesList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoicesListApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('invoices_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InvoicesListResource(InvoicesList::with(['entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team'])->get());
    }

    public function store(StoreInvoicesListRequest $request)
    {
        $invoicesList = InvoicesList::create($request->all());

        return (new InvoicesListResource($invoicesList))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InvoicesList $invoicesList)
    {
        abort_if(Gate::denies('invoices_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InvoicesListResource($invoicesList->load(['entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team']));
    }

    public function update(UpdateInvoicesListRequest $request, InvoicesList $invoicesList)
    {
        $invoicesList->update($request->all());

        return (new InvoicesListResource($invoicesList))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InvoicesList $invoicesList)
    {
        abort_if(Gate::denies('invoices_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoicesList->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
