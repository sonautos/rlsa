<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceLineRequest;
use App\Http\Requests\UpdateInvoiceLineRequest;
use App\Http\Resources\Admin\InvoiceLineResource;
use App\Models\InvoiceLine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceLinesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('invoice_line_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InvoiceLineResource(InvoiceLine::with(['proforma', 'product', 'service', 'vehicle', 'status', 'team'])->get());
    }

    public function store(StoreInvoiceLineRequest $request)
    {
        $invoiceLine = InvoiceLine::create($request->all());

        return (new InvoiceLineResource($invoiceLine))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InvoiceLine $invoiceLine)
    {
        abort_if(Gate::denies('invoice_line_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InvoiceLineResource($invoiceLine->load(['proforma', 'product', 'service', 'vehicle', 'status', 'team']));
    }

    public function update(UpdateInvoiceLineRequest $request, InvoiceLine $invoiceLine)
    {
        $invoiceLine->update($request->all());

        return (new InvoiceLineResource($invoiceLine))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InvoiceLine $invoiceLine)
    {
        abort_if(Gate::denies('invoice_line_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceLine->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
