<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOrderStatusRequest;
use App\Http\Requests\StoreOrderStatusRequest;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Models\OrderStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrderStatusController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('order_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OrderStatus::query()->select(sprintf('%s.*', (new OrderStatus)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'order_status_show';
                $editGate      = 'order_status_edit';
                $deleteGate    = 'order_status_delete';
                $crudRoutePart = 'order-statuses';

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

        return view('admin.orderStatuses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('order_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.orderStatuses.create');
    }

    public function store(StoreOrderStatusRequest $request)
    {
        $orderStatus = OrderStatus::create($request->all());

        return redirect()->route('admin.order-statuses.index');
    }

    public function edit(OrderStatus $orderStatus)
    {
        abort_if(Gate::denies('order_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.orderStatuses.edit', compact('orderStatus'));
    }

    public function update(UpdateOrderStatusRequest $request, OrderStatus $orderStatus)
    {
        $orderStatus->update($request->all());

        return redirect()->route('admin.order-statuses.index');
    }

    public function show(OrderStatus $orderStatus)
    {
        abort_if(Gate::denies('order_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.orderStatuses.show', compact('orderStatus'));
    }

    public function destroy(OrderStatus $orderStatus)
    {
        abort_if(Gate::denies('order_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderStatusRequest $request)
    {
        OrderStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
