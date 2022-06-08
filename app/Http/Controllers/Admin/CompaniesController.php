<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCompanyRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Entity;
use App\Models\TagContact;
use App\Models\Team;
use App\Models\Bank;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CompaniesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Company::with(['entity', 'tags', 'team'])->select(sprintf('%s.*', (new Company)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'company_show';
                $editGate      = 'company_edit';
                $deleteGate    = 'company_delete';
                $crudRoutePart = 'companies';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('entity_name', function ($row) {
                return $row->entity ? $row->entity->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('alias', function ($row) {
                return $row->alias ? $row->alias : "";
            });
            $table->editColumn('supplier', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->supplier ? 'checked' : null) . '>';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : "";
            });
            $table->editColumn('parent', function ($row) {
                return $row->parent ? $row->parent : "";
            });
            $table->editColumn('code_client', function ($row) {
                return $row->code_client ? $row->code_client : "";
            });
            $table->editColumn('code_supplier', function ($row) {
                return $row->code_supplier ? $row->code_supplier : "";
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });
            $table->editColumn('address_2', function ($row) {
                return $row->address_2 ? $row->address_2 : "";
            });
            $table->editColumn('zip', function ($row) {
                return $row->zip ? $row->zip : "";
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : "";
            });
            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : "";
            });
            $table->editColumn('country', function ($row) {
                return $row->country ? $row->country : "";
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('siren', function ($row) {
                return $row->siren ? $row->siren : "";
            });
            $table->editColumn('siret', function ($row) {
                return $row->siret ? $row->siret : "";
            });
            $table->editColumn('ape', function ($row) {
                return $row->ape ? $row->ape : "";
            });
            $table->editColumn('vatnumber', function ($row) {
                return $row->vatnumber ? $row->vatnumber : "";
            });
            $table->editColumn('capital', function ($row) {
                return $row->capital ? $row->capital : "";
            });
            $table->editColumn('note_private', function ($row) {
                return $row->note_private ? $row->note_private : "";
            });
            $table->editColumn('note_public', function ($row) {
                return $row->note_public ? $row->note_public : "";
            });
            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('tags', function ($row) {
                $labels = [];

                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->tag);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('latitude', function ($row) {
                return $row->latitude ? $row->latitude : "";
            });
            $table->editColumn('longitude', function ($row) {
                return $row->longitude ? $row->longitude : "";
            });
            $table->editColumn('url_place', function ($row) {
                return $row->url_place ? $row->url_place : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'entity', 'supplier', 'active', 'photo', 'tags']);

            return $table->make(true);
        }

        $entities     = Entity::get();
        $tag_contacts = TagContact::get();
        $teams        = Team::get();
        $banks        = Bank::get();

        return view('admin.companies.index', compact('entities', 'tag_contacts', 'teams', 'banks'));
    }

    public function create()
    {
        abort_if(Gate::denies('company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TagContact::all()->pluck('tag', 'id');

        return view('admin.companies.create', compact('entities', 'tags'));
    }

    public function store(StoreCompanyRequest $request)
    {
        $request->request->add([
            'address' => $request->street_number.' '.$request->street,
            'active' => $request->active == 'on' ? 1 : 0 ,
        ]);

        $company = Company::create($request->all());
        $company->tags()->sync($request->input('tags', []));

        if ($request->input('photo', false)) {
            $company->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $company->id]);
        }

        return redirect()->route('admin.companies.index');
    }

    public function edit(Company $company)
    {
        abort_if(Gate::denies('company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TagContact::all()->pluck('tag', 'id');

        $company->load('entity', 'tags', 'team');

        return view('admin.companies.edit', compact('entities', 'tags', 'company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $request->request->add(['address' => $request->street_number.' '.$request->street]);

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

        return redirect()->route('admin.companies.index');
    }

    public function show(Company $company)
    {
        abort_if(Gate::denies('company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company->load('entity', 'tags', 'team', 'societeIndividuals', 'societeAddresses', 'sellerShippLines', 'clientShippLines', 'supplierTrucks', 'sellerCars', 'clientOrdersLists', 'clientProformaLists', 'sellerOrdersLists', 'sellerProformaLists', 'sellerInvoicesLists');

        return view('admin.companies.show', compact('company'));
    }

    public function destroy(Company $company)
    {
        abort_if(Gate::denies('company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompanyRequest $request)
    {
        Company::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('company_create') && Gate::denies('company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Company();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function massActive(Request $request)
    {
        // abort_if(Gate::denies('company_create') && Gate::denies('company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::find($request->id);

        foreach ($companies as $company) {
            $company->update([
                'active' => 1,
            ]);
        }

        return back()->with('message', trans('trans.Companies-Actived'));
    }
}
