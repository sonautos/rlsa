<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreVersionRequest;
use App\Http\Requests\UpdateVersionRequest;
use App\Http\Resources\Admin\VersionResource;
use App\Models\Version;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VersionsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('version_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VersionResource(Version::with(['make', 'modele'])->get());
    }

    public function store(StoreVersionRequest $request)
    {
        $version = Version::create($request->all());

        if ($request->input('image', false)) {
            $version->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new VersionResource($version))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Version $version)
    {
        abort_if(Gate::denies('version_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VersionResource($version->load(['make', 'modele']));
    }

    public function update(UpdateVersionRequest $request, Version $version)
    {
        $version->update($request->all());

        if ($request->input('image', false)) {
            if (!$version->image || $request->input('image') !== $version->image->file_name) {
                if ($version->image) {
                    $version->image->delete();
                }

                $version->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($version->image) {
            $version->image->delete();
        }

        return (new VersionResource($version))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Version $version)
    {
        abort_if(Gate::denies('version_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $version->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
