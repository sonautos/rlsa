<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyModeleRequest;
use App\Http\Requests\StoreModeleRequest;
use App\Http\Requests\UpdateModeleRequest;
use App\Models\Make;
use App\Models\Modele;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ModeleController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('modele_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Modele::with(['make'])->select(sprintf('%s.*', (new Modele)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'modele_show';
                $editGate      = 'modele_edit';
                $deleteGate    = 'modele_delete';
                $crudRoutePart = 'modeles';

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
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : "";
            });
            $table->addColumn('make_name', function ($row) {
                return $row->make ? $row->make->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'make']);

            return $table->make(true);
        }

        $makes = Make::get();

        return view('admin.modeles.index', compact('makes'));
    }

    public function create()
    {
        abort_if(Gate::denies('modele_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $makes = Make::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.modeles.create', compact('makes'));
    }

    public function store(StoreModeleRequest $request)
    {
        $modele = Modele::create($request->all());

        return redirect()->route('admin.modeles.index');
    }

    public function edit(Modele $modele)
    {
        abort_if(Gate::denies('modele_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $makes = Make::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modele->load('make');

        return view('admin.modeles.edit', compact('makes', 'modele'));
    }

    public function update(UpdateModeleRequest $request, Modele $modele)
    {
        $modele->update($request->all());

        return redirect()->route('admin.modeles.index');
    }

    public function show(Modele $modele)
    {
        abort_if(Gate::denies('modele_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modele->load('make');

        return view('admin.modeles.show', compact('modele'));
    }

    public function destroy(Modele $modele)
    {
        abort_if(Gate::denies('modele_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modele->delete();

        return back();
    }

    public function massDestroy(MassDestroyModeleRequest $request)
    {
        Modele::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
