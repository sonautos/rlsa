<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTruckRequest;
use App\Http\Requests\UpdateTruckRequest;
use App\Http\Resources\Admin\TruckResource;
use App\Models\Truck;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TruckApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('truck_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TruckResource(Truck::with(['supplier', 'user', 'shippment', 'team'])->get());
    }

    public function store(StoreTruckRequest $request)
    {
        $truck = Truck::create($request->all());

        if ($request->input('cmr', false)) {
            $truck->addMedia(storage_path('tmp/uploads/' . $request->input('cmr')))->toMediaCollection('cmr');
        }

        return (new TruckResource($truck))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Truck $truck)
    {
        abort_if(Gate::denies('truck_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TruckResource($truck->load(['supplier', 'user', 'shippment', 'team']));
    }

    public function update(UpdateTruckRequest $request, Truck $truck)
    {
        $truck->update($request->all());

        if ($request->input('cmr', false)) {
            if (!$truck->cmr || $request->input('cmr') !== $truck->cmr->file_name) {
                if ($truck->cmr) {
                    $truck->cmr->delete();
                }

                $truck->addMedia(storage_path('tmp/uploads/' . $request->input('cmr')))->toMediaCollection('cmr');
            }
        } elseif ($truck->cmr) {
            $truck->cmr->delete();
        }

        return (new TruckResource($truck))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Truck $truck)
    {
        abort_if(Gate::denies('truck_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $truck->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
