<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\Admin\CompanyResource;
use App\Models\Company;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompaniesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompanyResource(Company::with(['entity', 'tags', 'team'])->get());
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->all());
        $company->tags()->sync($request->input('tags', []));

        if ($request->input('photo', false)) {
            $company->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new CompanyResource($company))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Company $company)
    {
        abort_if(Gate::denies('company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompanyResource($company->load(['entity', 'tags', 'team']));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->all());
        $company->tags()->sync($request->input('tags', []));

        if ($request->input('photo', false)) {
            if (!$company->photo || $request->input('photo') !== $company->photo->file_name) {
                if ($company->photo) {
                    $company->photo->delete();
                }

                $company->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($company->photo) {
            $company->photo->delete();
        }

        return (new CompanyResource($company))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Company $company)
    {
        abort_if(Gate::denies('company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
