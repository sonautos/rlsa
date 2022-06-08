<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMakeRequest;
use App\Http\Requests\StoreMakeRequest;
use App\Http\Requests\UpdateMakeRequest;
use App\Models\Make;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MakeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('make_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Make::query()->select(sprintf('%s.*', (new Make)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'make_show';
                $editGate      = 'make_edit';
                $deleteGate    = 'make_delete';
                $crudRoutePart = 'makes';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.makes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('make_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.makes.create');
    }

    public function store(StoreMakeRequest $request)
    {
        $make = Make::create($request->all());

        return redirect()->route('admin.makes.index');
    }

    public function edit(Make $make)
    {
        abort_if(Gate::denies('make_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.makes.edit', compact('make'));
    }

    public function update(UpdateMakeRequest $request, Make $make)
    {
        $make->update($request->all());

        return redirect()->route('admin.makes.index');
    }

    public function show(Make $make)
    {
        abort_if(Gate::denies('make_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $make->load('makeModeles');

        return view('admin.makes.show', compact('make'));
    }

    public function destroy(Make $make)
    {
        abort_if(Gate::denies('make_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $make->delete();

        return back();
    }

    public function massDestroy(MassDestroyMakeRequest $request)
    {
        Make::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
