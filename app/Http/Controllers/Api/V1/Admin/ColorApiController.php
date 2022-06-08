<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Http\Resources\Admin\ColorResource;
use App\Models\Color;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ColorApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('color_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ColorResource(Color::with(['make', 'modele'])->get());
    }

    public function store(StoreColorRequest $request)
    {
        $color = Color::create($request->all());

        if ($request->input('image', false)) {
            $color->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new ColorResource($color))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Color $color)
    {
        abort_if(Gate::denies('color_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ColorResource($color->load(['make', 'modele']));
    }

    public function update(UpdateColorRequest $request, Color $color)
    {
        $color->update($request->all());

        if ($request->input('image', false)) {
            if (!$color->image || $request->input('image') !== $color->image->file_name) {
                if ($color->image) {
                    $color->image->delete();
                }

                $color->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($color->image) {
            $color->image->delete();
        }

        return (new ColorResource($color))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Color $color)
    {
        abort_if(Gate::denies('color_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $color->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
