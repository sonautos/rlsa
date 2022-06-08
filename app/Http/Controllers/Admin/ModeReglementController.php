<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyModeReglementRequest;
use App\Http\Requests\StoreModeReglementRequest;
use App\Http\Requests\UpdateModeReglementRequest;
use App\Models\ModeReglement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ModeReglementController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('mode_reglement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ModeReglement::query()->select(sprintf('%s.*', (new ModeReglement)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'mode_reglement_show';
                $editGate      = 'mode_reglement_edit';
                $deleteGate    = 'mode_reglement_delete';
                $crudRoutePart = 'mode-reglements';

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

        return view('admin.modeReglements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('mode_reglement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.modeReglements.create');
    }

    public function store(StoreModeReglementRequest $request)
    {
        $modeReglement = ModeReglement::create($request->all());

        return redirect()->route('admin.mode-reglements.index');
    }

    public function edit(ModeReglement $modeReglement)
    {
        abort_if(Gate::denies('mode_reglement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.modeReglements.edit', compact('modeReglement'));
    }

    public function update(UpdateModeReglementRequest $request, ModeReglement $modeReglement)
    {
        $modeReglement->update($request->all());

        return redirect()->route('admin.mode-reglements.index');
    }

    public function show(ModeReglement $modeReglement)
    {
        abort_if(Gate::denies('mode_reglement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.modeReglements.show', compact('modeReglement'));
    }

    public function destroy(ModeReglement $modeReglement)
    {
        abort_if(Gate::denies('mode_reglement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modeReglement->delete();

        return back();
    }

    public function massDestroy(MassDestroyModeReglementRequest $request)
    {
        ModeReglement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
