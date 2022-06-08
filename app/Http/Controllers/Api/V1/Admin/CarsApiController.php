<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\Admin\CarResource;
use App\Models\Car;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('car_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new CarResource(Car::with(['user', 'entity', 'seller', 'categories', 'code_model', 'version', 'tags', 'team'])->get());
        return CarResource::collection(Car::with(['user', 'entity', 'seller', 'categories', 'code_model', 'version', 'tags', 'team'])->get());
    }

    public function store(StoreCarRequest $request)
    {
        $car = Car::create($request->all());
        $car->categories()->sync($request->input('categories', []));
        $car->tags()->sync($request->input('tags', []));

        if ($request->input('image', false)) {
            $car->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new CarResource($car))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Car $car)
    {
        abort_if(Gate::denies('car_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarResource($car->load(['user', 'entity', 'seller', 'categories', 'code_model', 'version', 'tags', 'team']));
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->update($request->all());
        $car->categories()->sync($request->input('categories', []));
        $car->tags()->sync($request->input('tags', []));

        if ($request->input('image', false)) {
            if (!$car->image || $request->input('image') !== $car->image->file_name) {
                if ($car->image) {
                    $car->image->delete();
                }

                $car->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($car->image) {
            $car->image->delete();
        }

        return (new CarResource($car))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Car $car)
    {
        abort_if(Gate::denies('car_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $car->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
