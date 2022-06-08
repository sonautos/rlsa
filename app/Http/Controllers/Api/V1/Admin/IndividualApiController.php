<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreIndividualRequest;
use App\Http\Requests\UpdateIndividualRequest;
use App\Http\Resources\Admin\IndividualResource;
use App\Models\Individual;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IndividualApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('individual_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IndividualResource(Individual::with(['societe', 'entity', 'user_create', 'user_modif', 'tags'])->get());
    }

    public function store(StoreIndividualRequest $request)
    {
        $individual = Individual::create($request->all());
        $individual->tags()->sync($request->input('tags', []));

        if ($request->input('photo', false)) {
            $individual->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new IndividualResource($individual))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Individual $individual)
    {
        abort_if(Gate::denies('individual_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IndividualResource($individual->load(['societe', 'entity', 'user_create', 'user_modif', 'tags']));
    }

    public function update(UpdateIndividualRequest $request, Individual $individual)
    {
        $individual->update($request->all());
        $individual->tags()->sync($request->input('tags', []));

        if ($request->input('photo', false)) {
            if (!$individual->photo || $request->input('photo') !== $individual->photo->file_name) {
                if ($individual->photo) {
                    $individual->photo->delete();
                }

                $individual->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($individual->photo) {
            $individual->photo->delete();
        }

        return (new IndividualResource($individual))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Individual $individual)
    {
        abort_if(Gate::denies('individual_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $individual->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
