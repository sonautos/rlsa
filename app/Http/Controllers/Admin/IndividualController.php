<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyIndividualRequest;
use App\Http\Requests\StoreIndividualRequest;
use App\Http\Requests\UpdateIndividualRequest;
use App\Models\Company;
use App\Models\Entity;
use App\Models\Individual;
use App\Models\TagContact;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IndividualController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('individual_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Individual::with(['societe', 'entity', 'user_create', 'user_modif', 'tags'])->select(sprintf('%s.*', (new Individual)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'individual_show';
                $editGate      = 'individual_edit';
                $deleteGate    = 'individual_delete';
                $crudRoutePart = 'individuals';

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
            $table->addColumn('societe_name', function ($row) {
                return $row->societe ? $row->societe->name : '';
            });

            $table->addColumn('entity_name', function ($row) {
                return $row->entity ? $row->entity->name : '';
            });

            $table->editColumn('civility', function ($row) {
                return $row->civility ? Individual::CIVILITY_RADIO[$row->civility] : '';
            });
            $table->editColumn('firstname', function ($row) {
                return $row->firstname ? $row->firstname : "";
            });
            $table->editColumn('lastname', function ($row) {
                return $row->lastname ? $row->lastname : "";
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
            $table->editColumn('poste', function ($row) {
                return $row->poste ? $row->poste : "";
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });
            $table->editColumn('mobile', function ($row) {
                return $row->mobile ? $row->mobile : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->addColumn('user_create_firstname', function ($row) {
                return $row->user_create ? $row->user_create->firstname : '';
            });

            $table->editColumn('user_create.name', function ($row) {
                return $row->user_create ? (is_string($row->user_create) ? $row->user_create : $row->user_create->name) : '';
            });
            $table->addColumn('user_modif_firstname', function ($row) {
                return $row->user_modif ? $row->user_modif->firstname : '';
            });

            $table->editColumn('user_modif.name', function ($row) {
                return $row->user_modif ? (is_string($row->user_modif) ? $row->user_modif : $row->user_modif->name) : '';
            });
            $table->editColumn('note_private', function ($row) {
                return $row->note_private ? $row->note_private : "";
            });
            $table->editColumn('note_public', function ($row) {
                return $row->note_public ? $row->note_public : "";
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

            $table->rawColumns(['actions', 'placeholder', 'societe', 'entity', 'user_create', 'user_modif', 'photo', 'tags']);

            return $table->make(true);
        }

        return view('admin.individuals.index');
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('individual_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyId = $request->companyId;

        $societes = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entities = Entity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_creates = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_modifs = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TagContact::all()->pluck('tag', 'id');

        return view('admin.individuals.create', compact('societes', 'entities', 'user_creates', 'user_modifs', 'tags', 'companyId'));
    }

    public function store(StoreIndividualRequest $request)
    {
        $user = auth()->user();
        $request->request->add([
            'user_create_id' => $user->id,
            'user_modif_id' => $user->id,
            'address'       => $request->street_number.' '.$request->street
        ]);

        $individual = Individual::create($request->all());
        $individual->tags()->sync($request->input('tags', []));

        if ($request->input('photo', false)) {
            $individual->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $individual->id]);
        }

        return redirect()->route('admin.individuals.index');
    }

    public function edit(Individual $individual)
    {
        abort_if(Gate::denies('individual_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $societes = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entities = Entity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_creates = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_modifs = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TagContact::all()->pluck('tag', 'id');

        $individual->load('societe', 'entity', 'user_create', 'user_modif', 'tags');

        return view('admin.individuals.edit', compact('societes', 'entities', 'user_creates', 'user_modifs', 'tags', 'individual'));
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

        return redirect()->route('admin.individuals.index');
    }

    public function show(Individual $individual)
    {
        abort_if(Gate::denies('individual_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $individual->load('societe', 'entity', 'user_create', 'user_modif', 'tags', 'individualAddresses');

        return view('admin.individuals.show', compact('individual'));
    }

    public function destroy(Individual $individual)
    {
        abort_if(Gate::denies('individual_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $individual->delete();

        return back();
    }

    public function massDestroy(MassDestroyIndividualRequest $request)
    {
        Individual::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('individual_create') && Gate::denies('individual_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Individual();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
