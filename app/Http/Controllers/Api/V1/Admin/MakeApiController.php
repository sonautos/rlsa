<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMakeRequest;
use App\Http\Requests\UpdateMakeRequest;
use App\Http\Resources\Admin\MakeResource;
use App\Models\Make;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MakeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('make_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MakeResource(Make::all());
    }

    public function store(StoreMakeRequest $request)
    {
        $make = Make::create($request->all());

        return (new MakeResource($make))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Make $make)
    {
        abort_if(Gate::denies('make_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MakeResource($make);
    }

    public function update(UpdateMakeRequest $request, Make $make)
    {
        $make->update($request->all());

        return (new MakeResource($make))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Make $make)
    {
        abort_if(Gate::denies('make_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $make->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
