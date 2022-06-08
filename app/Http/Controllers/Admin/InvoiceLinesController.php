<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInvoiceLineRequest;
use App\Http\Requests\StoreInvoiceLineRequest;
use App\Http\Requests\UpdateInvoiceLineRequest;
use App\Models\Car;
use App\Models\InvoiceLine;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\ProformaList;
use App\Models\Service;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InvoiceLinesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('invoice_line_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InvoiceLine::with(['proforma', 'product', 'service', 'vehicle', 'status', 'team'])->select(sprintf('%s.*', (new InvoiceLine)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'invoice_line_show';
                $editGate      = 'invoice_line_edit';
                $deleteGate    = 'invoice_line_delete';
                $crudRoutePart = 'invoice-lines';

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
            $table->addColumn('proforma_ref', function ($row) {
                return $row->proforma ? $row->proforma->ref : '';
            });

            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->addColumn('service_name', function ($row) {
                return $row->service ? $row->service->name : '';
            });

            $table->addColumn('vehicle_vin', function ($row) {
                return $row->vehicle ? $row->vehicle->vin : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });
            $table->editColumn('qty', function ($row) {
                return $row->qty ? $row->qty : "";
            });
            $table->editColumn('tva_tx', function ($row) {
                return $row->tva_tx ? $row->tva_tx : "";
            });
            $table->editColumn('remise_percent', function ($row) {
                return $row->remise_percent ? $row->remise_percent : "";
            });
            $table->editColumn('remise', function ($row) {
                return $row->remise ? $row->remise : "";
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

            $table->rawColumns(['actions', 'placeholder', 'proforma', 'product', 'service', 'vehicle', 'status']);

            return $table->make(true);
        }

        $proforma_lists = ProformaList::get();
        $products       = Product::get();
        $services       = Service::get();
        $cars           = Car::get();
        $order_statuses = OrderStatus::get();
        $teams          = Team::get();

        return view('admin.invoiceLines.index', compact('proforma_lists', 'products', 'services', 'cars', 'order_statuses', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('invoice_line_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proformas = ProformaList::all()->pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicles = Car::all()->pluck('vin', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = OrderStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.invoiceLines.create', compact('proformas', 'products', 'services', 'vehicles', 'statuses'));
    }

    public function store(StoreInvoiceLineRequest $request)
    {
        $invoiceLine = InvoiceLine::create($request->all());

        return redirect()->route('admin.invoice-lines.index');
    }

    public function edit(InvoiceLine $invoiceLine)
    {
        abort_if(Gate::denies('invoice_line_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proformas = ProformaList::all()->pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicles = Car::all()->pluck('vin', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = OrderStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $invoiceLine->load('proforma', 'product', 'service', 'vehicle', 'status', 'team');

        return view('admin.invoiceLines.edit', compact('proformas', 'products', 'services', 'vehicles', 'statuses', 'invoiceLine'));
    }

    public function update(UpdateInvoiceLineRequest $request, InvoiceLine $invoiceLine)
    {
        $invoiceLine->update($request->all());

        return redirect()->route('admin.invoice-lines.index');
    }

    public function show(InvoiceLine $invoiceLine)
    {
        abort_if(Gate::denies('invoice_line_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceLine->load('proforma', 'product', 'service', 'vehicle', 'status', 'team');

        return view('admin.invoiceLines.show', compact('invoiceLine'));
    }

    public function destroy(InvoiceLine $invoiceLine)
    {
        abort_if(Gate::denies('invoice_line_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceLine->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvoiceLineRequest $request)
    {
        InvoiceLine::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
