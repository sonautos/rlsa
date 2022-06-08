<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyColorRequest;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Models\Color;
use App\Models\Make;
use App\Models\Modele;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ColorController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('color_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Color::with(['make', 'modele'])->select(sprintf('%s.*', (new Color)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'color_show';
                $editGate      = 'color_edit';
                $deleteGate    = 'color_delete';
                $crudRoutePart = 'colors';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : "";
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('url_image', function ($row) {
                return $row->url_image ? $row->url_image : "";
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

        return view('admin.colors.index', compact('makes', 'modeles'));
    }

    public function create()
    {
        abort_if(Gate::denies('color_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $makes = Make::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modeles = Modele::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.colors.create', compact('makes', 'modeles'));
    }

    public function store(StoreColorRequest $request)
    {
        $color = Color::create($request->all());

        if ($request->input('image', false)) {
            $color->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $color->id]);
        }

        return redirect()->route('admin.colors.index');
    }

    public function edit(Color $color)
    {
        abort_if(Gate::denies('color_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $makes = Make::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modeles = Modele::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $color->load('make', 'modele');

        return view('admin.colors.edit', compact('makes', 'modeles', 'color'));
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

        return redirect()->route('admin.colors.index');
    }

    public function show(Color $color)
    {
        abort_if(Gate::denies('color_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $color->load('make', 'modele');

        return view('admin.colors.show', compact('color'));
    }

    public function destroy(Color $color)
    {
        abort_if(Gate::denies('color_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $color->delete();

        return back();
    }

    public function massDestroy(MassDestroyColorRequest $request)
    {
        Color::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('color_create') && Gate::denies('color_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Color();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
