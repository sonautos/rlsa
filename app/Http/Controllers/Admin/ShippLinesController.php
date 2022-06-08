<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyShippLineRequest;
use App\Http\Requests\StoreShippLineRequest;
use App\Http\Requests\UpdateShippLineRequest;
use App\Models\Car;
use App\Models\Company;
use App\Models\OrdersList;
use App\Models\ShippLine;
use App\Models\Shippmentslist;
use App\Models\ShippStatus;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ShippLinesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('shipp_line_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ShippLine::with(['seller', 'client', 'vehicle', 'status', 'shippment', 'user', 'order', 'team'])->select(sprintf('%s.*', (new ShippLine)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'shipp_line_show';
                $editGate      = 'shipp_line_edit';
                $deleteGate    = 'shipp_line_delete';
                $crudRoutePart = 'shipp-lines';

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
            $table->addColumn('seller_name', function ($row) {
                return $row->seller ? $row->seller->name : '';
            });

            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('modele', function ($row) {
                return $row->modele ? $row->modele : "";
            });
            $table->addColumn('vehicle_vin', function ($row) {
                return $row->vehicle ? $row->vehicle->vin : '';
            });

            $table->editColumn('vin', function ($row) {
                return $row->vin ? $row->vin : "";
            });
            $table->editColumn('color', function ($row) {
                return $row->color ? $row->color : "";
            });
            $table->editColumn('plates', function ($row) {
                return $row->plates ? $row->plates : "";
            });
            $table->editColumn('loading_place', function ($row) {
                return $row->loading_place ? $row->loading_place : "";
            });
            $table->editColumn('delivery_place', function ($row) {
                return $row->delivery_place ? $row->delivery_place : "";
            });

            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : "";
            });
            $table->editColumn('paid', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->paid ? 'checked' : null) . '>';
            });
            $table->addColumn('shippment_ref', function ($row) {
                return $row->shippment ? $row->shippment->ref : '';
            });

            $table->addColumn('user_firstname', function ($row) {
                return $row->user ? $row->user->firstname : '';
            });

            $table->editColumn('user.name', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->name) : '';
            });
            $table->addColumn('order_ref', function ($row) {
                return $row->order ? $row->order->ref : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'seller', 'client', 'vehicle', 'status', 'paid', 'shippment', 'user', 'order']);

            return $table->make(true);
        }

        $companies       = Company::get();
        $cars            = Car::get();
        $shipp_statuses  = ShippStatus::get();
        $shippmentslists = Shippmentslist::get();
        $users           = User::get();
        $orders_lists    = OrdersList::get();
        $teams           = Team::get();

        return view('admin.shippLines.index', compact('companies', 'cars', 'shipp_statuses', 'shippmentslists', 'users', 'orders_lists', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('shipp_line_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sellers = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicles = Car::all()->pluck('vin', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = ShippStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shippments = Shippmentslist::all()->pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = OrdersList::all()->pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.shippLines.create', compact('sellers', 'clients', 'vehicles', 'statuses', 'shippments', 'users', 'orders'));
    }

    public function store(StoreShippLineRequest $request)
    {
        $shippLine = ShippLine::create($request->all());

        return redirect()->route('admin.shipp-lines.index');
    }

    public function edit(ShippLine $shippLine)
    {
        abort_if(Gate::denies('shipp_line_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sellers = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicles = Car::all()->pluck('vin', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = ShippStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shippments = Shippmentslist::all()->pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = OrdersList::all()->pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shippLine->load('seller', 'client', 'vehicle', 'status', 'shippment', 'user', 'order', 'team');

        return view('admin.shippLines.edit', compact('sellers', 'clients', 'vehicles', 'statuses', 'shippments', 'users', 'orders', 'shippLine'));
    }

    public function update(UpdateShippLineRequest $request, ShippLine $shippLine)
    {
        $user = auth()->user();

        $request->request->add([
            'user_id' => $user->id,
        ]);

        $shippLine->update($request->all());

        return redirect()->back()->with('message', trans('trans.line-update'));
    }

    public function show(ShippLine $shippLine)
    {
        abort_if(Gate::denies('shipp_line_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippLine->load('seller', 'client', 'vehicle', 'status', 'shippment', 'user', 'order', 'team');

        return view('admin.shippLines.show', compact('shippLine'));
    }

    public function destroy(ShippLine $shippLine)
    {
        abort_if(Gate::denies('shipp_line_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippLine->delete();

        return back();
    }

    public function massDestroy(MassDestroyShippLineRequest $request)
    {
        ShippLine::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
