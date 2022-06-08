<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyShippStatusRequest;
use App\Http\Requests\StoreShippStatusRequest;
use App\Http\Requests\UpdateShippStatusRequest;
use App\Models\ShippStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ShippStatusesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('shipp_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ShippStatus::query()->select(sprintf('%s.*', (new ShippStatus)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'shipp_status_show';
                $editGate      = 'shipp_status_edit';
                $deleteGate    = 'shipp_status_delete';
                $crudRoutePart = 'shipp-statuses';

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

        return view('admin.shippStatuses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('shipp_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippStatuses.create');
    }

    public function store(StoreShippStatusRequest $request)
    {
        $shippStatus = ShippStatus::create($request->all());

        return redirect()->route('admin.shipp-statuses.index');
    }

    public function edit(ShippStatus $shippStatus)
    {
        abort_if(Gate::denies('shipp_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippStatuses.edit', compact('shippStatus'));
    }

    public function update(UpdateShippStatusRequest $request, ShippStatus $shippStatus)
    {
        $shippStatus->update($request->all());

        return redirect()->route('admin.shipp-statuses.index');
    }

    public function show(ShippStatus $shippStatus)
    {
        abort_if(Gate::denies('shipp_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippStatus->load('statusShippmentslists');

        return view('admin.shippStatuses.show', compact('shippStatus'));
    }

    public function destroy(ShippStatus $shippStatus)
    {
        abort_if(Gate::denies('shipp_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyShippStatusRequest $request)
    {
        ShippStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
