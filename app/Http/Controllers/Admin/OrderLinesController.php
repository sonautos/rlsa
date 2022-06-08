<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOrderLineRequest;
use App\Http\Requests\StoreOrderLineRequest;
use App\Http\Requests\UpdateOrderLineRequest;
use App\Models\Car;
use App\Models\Company;
use App\Models\OrderLine;
use App\Models\OrdersList;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Service;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrderLinesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('order_line_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OrderLine::with(['order', 'product', 'service', 'vehicle', 'status', 'team'])
                ->where('vehicle_id', '<>', null)
                ->select(sprintf('%s.*', (new OrderLine)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'order_line_show';
                $editGate      = 'order_line_edit';
                $deleteGate    = 'order_line_delete';
                $crudRoutePart = 'order-lines';

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
            $table->addColumn('order_ref', function ($row) {
                return $row->order ? $row->order->ref : '';
            });

            $table->addColumn('order_seller', function ($row) {
                return $row->order ? $row->order->seller->name : '';
            });

            $table->addColumn('order_client', function ($row) {
                return $row->order ? $row->order->client->name : '';
            });

            $table->addColumn('vehicle_vin', function ($row) {
                return $row->vehicle ? $row->vehicle->vin : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('total_ht', function ($row) {
                return $row->total_ht ? $row->total_ht : "";
            });
            $table->editColumn('total_tva', function ($row) {
                return $row->total_tva ? $row->total_tva : "";
            });
            $table->editColumn('total_ttc', function ($row) {
                return $row->total_ttc ? $row->total_ttc : "";
            });
            $table->editColumn('cost_price', function ($row) {
                return $row->cost_price ? $row->cost_price : "";
            });
            $table->editColumn('comclient', function ($row) {
                return $row->comclient ? $row->comclient : "";
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'order', 'product', 'service', 'vehicle', 'status']);

            return $table->make(true);
        }

        $orders_lists   = OrdersList::get();
        $products       = Product::get();
        $services       = Service::get();
        $cars           = Car::get();
        $clients        = Company::get();
        $sellers        = Company::where('supplier', 1)->get();
        $order_statuses = OrderStatus::get();
        $teams          = Team::get();

        return view('admin.orderLines.index', compact('orders_lists', 'products', 'services', 'cars', 'order_statuses', 'teams', 'clients', 'sellers'));
    }

    public function create()
    {
        abort_if(Gate::denies('order_line_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = OrdersList::all()->pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicles = Car::all()->pluck('vin', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = OrderStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orderLines.create', compact('orders', 'products', 'services', 'vehicles', 'statuses'));
    }

    public function store(StoreOrderLineRequest $request)
    {
        $orderLine = OrderLine::create($request->all());

        return redirect()->route('admin.order-lines.index');
    }

    public function edit(OrderLine $orderLine)
    {
        abort_if(Gate::denies('order_line_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = OrdersList::all()->pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicles = Car::all()->pluck('vin', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = OrderStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orderLine->load('order', 'product', 'service', 'vehicle', 'status', 'team');

        return view('admin.orderLines.edit', compact('orders', 'products', 'services', 'vehicles', 'statuses', 'orderLine'));
    }

    public function update(UpdateOrderLineRequest $request, OrderLine $orderLine)
    {
        $orderLine->update($request->all());

        return redirect()->route('admin.order-lines.index');
    }

    public function show(OrderLine $orderLine)
    {
        abort_if(Gate::denies('order_line_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderLine->load('order', 'product', 'service', 'vehicle', 'status', 'team');

        return view('admin.orderLines.show', compact('orderLine'));
    }

    public function destroy(OrderLine $orderLine)
    {
        abort_if(Gate::denies('order_line_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderLine->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderLineRequest $request)
    {
        OrderLine::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
