<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCodeModelRequest;
use App\Http\Requests\StoreCodeModelRequest;
use App\Http\Requests\UpdateCodeModelRequest;
use App\Models\CodeModel;
use App\Models\Make;
use App\Models\Modele;
use App\Models\Version;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CodeModelController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('code_model_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CodeModel::with(['make', 'modele', 'version'])->select(sprintf('%s.*', (new CodeModel)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'code_model_show';
                $editGate      = 'code_model_edit';
                $deleteGate    = 'code_model_delete';
                $crudRoutePart = 'code-models';

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
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : "";
            });
            $table->addColumn('make_name', function ($row) {
                return $row->make ? $row->make->name : '';
            });

            $table->addColumn('modele_name', function ($row) {
                return $row->modele ? $row->modele->name : '';
            });

            $table->addColumn('version_description', function ($row) {
                return $row->version ? $row->version->description : '';
            });

            $table->editColumn('version.motor', function ($row) {
                return $row->version ? (is_string($row->version) ? $row->version : $row->version->motor) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'make', 'modele', 'version']);

            return $table->make(true);
        }

        $makes    = Make::get();
        $modeles  = Modele::get();
        $versions = Version::get();

        return view('admin.codeModels.index', compact('makes', 'modeles', 'versions'));
    }

    public function create()
    {
        abort_if(Gate::denies('code_model_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $makes = Make::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modeles = Modele::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $versions = Version::all()->pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.codeModels.create', compact('makes', 'modeles', 'versions'));
    }

    public function store(StoreCodeModelRequest $request)
    {
        $codeModel = CodeModel::create($request->all());

        return redirect()->route('admin.code-models.index');
    }

    public function edit(CodeModel $codeModel)
    {
        abort_if(Gate::denies('code_model_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $makes = Make::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modeles = Modele::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $versions = Version::all()->pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $codeModel->load('make', 'modele', 'version');

        return view('admin.codeModels.edit', compact('makes', 'modeles', 'versions', 'codeModel'));
    }

    public function update(UpdateCodeModelRequest $request, CodeModel $codeModel)
    {
        $codeModel->update($request->all());

        return redirect()->route('admin.code-models.index');
    }

    public function show(CodeModel $codeModel)
    {
        abort_if(Gate::denies('code_model_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $codeModel->load('make', 'modele', 'version', 'codeModelCars');

        return view('admin.codeModels.show', compact('codeModel'));
    }

    public function destroy(CodeModel $codeModel)
    {
        abort_if(Gate::denies('code_model_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $codeModel->delete();

        return back();
    }

    public function massDestroy(MassDestroyCodeModelRequest $request)
    {
        CodeModel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
