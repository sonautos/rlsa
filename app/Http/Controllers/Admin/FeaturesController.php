<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFeatureRequest;
use App\Http\Requests\StoreFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Models\Feature;
use App\Models\Make;
use App\Models\Modele;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FeaturesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('feature_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Feature::with(['make', 'modele'])->select(sprintf('%s.*', (new Feature)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'feature_show';
                $editGate      = 'feature_edit';
                $deleteGate    = 'feature_delete';
                $crudRoutePart = 'features';

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
            $table->addColumn('make_name', function ($row) {
                return $row->make ? $row->make->name : '';
            });

            $table->addColumn('modele_name', function ($row) {
                return $row->modele ? $row->modele->name : '';
            });

            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'make', 'modele']);

            return $table->make(true);
        }

        $makes   = Make::get();
        $modeles = Modele::get();

        return view('admin.features.index', compact('makes', 'modeles'));
    }

    public function create()
    {
        abort_if(Gate::denies('feature_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $makes = Make::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modeles = Modele::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.features.create', compact('makes', 'modeles'));
    }

    public function store(StoreFeatureRequest $request)
    {
        $feature = Feature::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $feature->id]);
        }

        return redirect()->route('admin.features.index');
    }

    public function edit(Feature $feature)
    {
        abort_if(Gate::denies('feature_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $makes = Make::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modeles = Modele::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feature->load('make', 'modele');

        return view('admin.features.edit', compact('makes', 'modeles', 'feature'));
    }

    public function update(UpdateFeatureRequest $request, Feature $feature)
    {
        $feature->update($request->all());

        return redirect()->route('admin.features.index');
    }

    public function show(Feature $feature)
    {
        abort_if(Gate::denies('feature_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feature->load('make', 'modele');

        return view('admin.features.show', compact('feature'));
    }

    public function destroy(Feature $feature)
    {
        abort_if(Gate::denies('feature_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feature->delete();

        return back();
    }

    public function massDestroy(MassDestroyFeatureRequest $request)
    {
        Feature::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('feature_create') && Gate::denies('feature_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Feature();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
