<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCodeModelRequest;
use App\Http\Requests\UpdateCodeModelRequest;
use App\Http\Resources\Admin\CodeModelResource;
use App\Models\CodeModel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CodeModelApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('code_model_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CodeModelResource(CodeModel::with(['make', 'modele', 'version'])->get());
    }

    public function store(StoreCodeModelRequest $request)
    {
        $codeModel = CodeModel::create($request->all());

        return (new CodeModelResource($codeModel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CodeModel $codeModel)
    {
        abort_if(Gate::denies('code_model_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CodeModelResource($codeModel->load(['make', 'modele', 'version']));
    }

    public function update(UpdateCodeModelRequest $request, CodeModel $codeModel)
    {
        $codeModel->update($request->all());

        return (new CodeModelResource($codeModel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CodeModel $codeModel)
    {
        abort_if(Gate::denies('code_model_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $codeModel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
