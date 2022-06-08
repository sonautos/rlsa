<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCondReglementRequest;
use App\Http\Requests\StoreCondReglementRequest;
use App\Http\Requests\UpdateCondReglementRequest;
use App\Models\CondReglement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CondReglementController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('cond_reglement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CondReglement::query()->select(sprintf('%s.*', (new CondReglement)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'cond_reglement_show';
                $editGate      = 'cond_reglement_edit';
                $deleteGate    = 'cond_reglement_delete';
                $crudRoutePart = 'cond-reglements';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.condReglements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('cond_reglement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.condReglements.create');
    }

    public function store(StoreCondReglementRequest $request)
    {
        $condReglement = CondReglement::create($request->all());

        return redirect()->route('admin.cond-reglements.index');
    }

    public function edit(CondReglement $condReglement)
    {
        abort_if(Gate::denies('cond_reglement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.condReglements.edit', compact('condReglement'));
    }

    public function update(UpdateCondReglementRequest $request, CondReglement $condReglement)
    {
        $condReglement->update($request->all());

        return redirect()->route('admin.cond-reglements.index');
    }

    public function show(CondReglement $condReglement)
    {
        abort_if(Gate::denies('cond_reglement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.condReglements.show', compact('condReglement'));
    }

    public function destroy(CondReglement $condReglement)
    {
        abort_if(Gate::denies('cond_reglement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $condReglement->delete();

        return back();
    }

    public function massDestroy(MassDestroyCondReglementRequest $request)
    {
        CondReglement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
