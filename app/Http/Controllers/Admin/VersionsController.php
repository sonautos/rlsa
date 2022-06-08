<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVersionRequest;
use App\Http\Requests\StoreVersionRequest;
use App\Http\Requests\UpdateVersionRequest;
use App\Models\Make;
use App\Models\Modele;
use App\Models\Version;
use Gate;
use Str;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VersionsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('version_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Version::with(['make', 'modele'])->select(sprintf('%s.*', (new Version)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'version_show';
                $editGate      = 'version_edit';
                $deleteGate    = 'version_delete';
                $crudRoutePart = 'versions';

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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : "";
            });
            $table->editColumn('motor', function ($row) {
                return $row->motor ? $row->motor : "";
            });
            $table->editColumn('kw', function ($row) {
                return $row->kw ? $row->kw : "";
            });
            $table->editColumn('ch', function ($row) {
                return $row->ch ? $row->ch : "";
            });
            $table->editColumn('co_2', function ($row) {
                return $row->co_2 ? $row->co_2 : "";
            });
            $table->editColumn('energy', function ($row) {
                return $row->energy ? Version::ENERGY_SELECT[$row->energy] : '';
            });
            $table->editColumn('gear', function ($row) {
                return $row->gear ? Version::GEAR_RADIO[$row->gear] : '';
            });
            $table->editColumn('conso', function ($row) {
                return $row->conso ? $row->conso : "";
            });
            $table->editColumn('prix', function ($row) {
                return $row->prix ? $row->prix : "";
            });
            $table->editColumn('image', function ($row) {
                if (!$row->image) {
                    return '';
                }

                $links = [];

                foreach ($row->image as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->addColumn('make_name', function ($row) {
                return $row->make ? $row->make->name : '';
            });

            $table->addColumn('modele_name', function ($row) {
                return $row->modele ? $row->modele->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image', 'make', 'modele']);

            return $table->make(true);
        }

        $makes   = Make::get();
        $modeles = Modele::get();

        return view('admin.versions.index', compact('makes', 'modeles'));
    }

    public function create()
    {
        abort_if(Gate::denies('version_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $makes = Make::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modeles = Modele::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.versions.create', compact('makes', 'modeles'));
    }

    public function store(StoreVersionRequest $request)
    {
        $make = Make::findOrFail($request->make_id);
        $modele = Modele::findOrFail($request->modele_id);
        $slug = Str::slug($make->name.' '.$modele->name.' '.$request->motor.' '.$request->description);
        $request->request->add([
            'slug' => $slug,
        ]);

        $version = Version::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $version->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $version->id]);
        }

        return redirect()->route('admin.versions.index');
    }

    public function edit(Version $version)
    {
        abort_if(Gate::denies('version_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $makes = Make::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modeles = Modele::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $version->load('make', 'modele');

        return view('admin.versions.edit', compact('makes', 'modeles', 'version'));
    }

    public function update(UpdateVersionRequest $request, Version $version)
    {
        $version->update($request->all());

        if (count($version->image) > 0) {
            foreach ($version->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }

        $media = $version->image->pluck('file_name')->toArray();

        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $version->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }
        }

        return redirect()->route('admin.versions.index');
    }

    public function show(Version $version)
    {
        abort_if(Gate::denies('version_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $version->load('make', 'modele', 'versionCars');

        return view('admin.versions.show', compact('version'));
    }

    public function destroy(Version $version)
    {
        abort_if(Gate::denies('version_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $version->delete();

        return back();
    }

    public function massDestroy(MassDestroyVersionRequest $request)
    {
        Version::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('version_create') && Gate::denies('version_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Version();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
