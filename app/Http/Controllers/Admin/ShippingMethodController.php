<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyShippingMethodRequest;
use App\Http\Requests\StoreShippingMethodRequest;
use App\Http\Requests\UpdateShippingMethodRequest;
use App\Models\ShippingMethod;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ShippingMethodController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('shipping_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ShippingMethod::query()->select(sprintf('%s.*', (new ShippingMethod)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'shipping_method_show';
                $editGate      = 'shipping_method_edit';
                $deleteGate    = 'shipping_method_delete';
                $crudRoutePart = 'shipping-methods';

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

        return view('admin.shippingMethods.index');
    }

    public function create()
    {
        abort_if(Gate::denies('shipping_method_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippingMethods.create');
    }

    public function store(StoreShippingMethodRequest $request)
    {
        $shippingMethod = ShippingMethod::create($request->all());

        return redirect()->route('admin.shipping-methods.index');
    }

    public function edit(ShippingMethod $shippingMethod)
    {
        abort_if(Gate::denies('shipping_method_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippingMethods.edit', compact('shippingMethod'));
    }

    public function update(UpdateShippingMethodRequest $request, ShippingMethod $shippingMethod)
    {
        $shippingMethod->update($request->all());

        return redirect()->route('admin.shipping-methods.index');
    }

    public function show(ShippingMethod $shippingMethod)
    {
        abort_if(Gate::denies('shipping_method_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shippingMethods.show', compact('shippingMethod'));
    }

    public function destroy(ShippingMethod $shippingMethod)
    {
        abort_if(Gate::denies('shipping_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippingMethod->delete();

        return back();
    }

    public function massDestroy(MassDestroyShippingMethodRequest $request)
    {
        ShippingMethod::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
