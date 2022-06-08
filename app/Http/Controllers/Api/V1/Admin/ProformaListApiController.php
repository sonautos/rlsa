<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProformaListRequest;
use App\Http\Requests\UpdateProformaListRequest;
use App\Http\Resources\Admin\ProformaListResource;
use App\Models\ProformaList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProformaListApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('proforma_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProformaListResource(ProformaList::with(['entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team'])->get());
    }

    public function store(StoreProformaListRequest $request)
    {
        $proformaList = ProformaList::create($request->all());

        return (new ProformaListResource($proformaList))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProformaList $proformaList)
    {
        abort_if(Gate::denies('proforma_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProformaListResource($proformaList->load(['entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team']));
    }

    public function update(UpdateProformaListRequest $request, ProformaList $proformaList)
    {
        $proformaList->update($request->all());

        return (new ProformaListResource($proformaList))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProformaList $proformaList)
    {
        abort_if(Gate::denies('proforma_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proformaList->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
