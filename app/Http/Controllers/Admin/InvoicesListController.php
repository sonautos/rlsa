<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInvoicesListRequest;
use App\Http\Requests\StoreInvoicesListRequest;
use App\Http\Requests\UpdateInvoicesListRequest;
use App\Models\Address;
use App\Models\Company;
use App\Models\CondReglement;
use App\Models\Entity;
use App\Models\InvoicesList;
use App\Models\ModeReglement;
use App\Models\OrderStatus;
use App\Models\ShippingMethod;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InvoicesListController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('invoices_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InvoicesList::with(['entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team'])->select(sprintf('%s.*', (new InvoicesList)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'invoices_list_show';
                $editGate      = 'invoices_list_edit';
                $deleteGate    = 'invoices_list_delete';
                $crudRoutePart = 'invoices-lists';

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
            $table->editColumn('ref', function ($row) {
                return $row->ref ? $row->ref : "";
            });
            $table->addColumn('entity_name', function ($row) {
                return $row->entity ? $row->entity->name : '';
            });

            $table->addColumn('seller_name', function ($row) {
                return $row->seller ? $row->seller->name : '';
            });

            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->addColumn('task_name', function ($row) {
                return $row->task ? $row->task->name : '';
            });

            $table->addColumn('author_firstname', function ($row) {
                return $row->author ? $row->author->firstname : '';
            });

            $table->editColumn('author.name', function ($row) {
                return $row->author ? (is_string($row->author) ? $row->author : $row->author->name) : '';
            });
            $table->addColumn('valid_firstname', function ($row) {
                return $row->valid ? $row->valid->firstname : '';
            });

            $table->editColumn('valid.name', function ($row) {
                return $row->valid ? (is_string($row->valid) ? $row->valid : $row->valid->name) : '';
            });
            $table->addColumn('user_updated_firstname', function ($row) {
                return $row->user_updated ? $row->user_updated->firstname : '';
            });

            $table->editColumn('user_updated.name', function ($row) {
                return $row->user_updated ? (is_string($row->user_updated) ? $row->user_updated : $row->user_updated->name) : '';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->editColumn('total_ht', function ($row) {
                return $row->total_ht ? $row->total_ht : "";
            });
            $table->editColumn('tva', function ($row) {
                return $row->tva ? $row->tva : "";
            });
            $table->editColumn('total_ttc', function ($row) {
                return $row->total_ttc ? $row->total_ttc : "";
            });
            $table->editColumn('remise', function ($row) {
                return $row->remise ? $row->remise : "";
            });
            $table->editColumn('remise_percent', function ($row) {
                return $row->remise_percent ? $row->remise_percent : "";
            });
            $table->addColumn('cond_reglement_name', function ($row) {
                return $row->cond_reglement ? $row->cond_reglement->name : '';
            });

            $table->addColumn('mode_reglement_name', function ($row) {
                return $row->mode_reglement ? $row->mode_reglement->name : '';
            });

            $table->editColumn('note_private', function ($row) {
                return $row->note_private ? $row->note_private : "";
            });
            $table->editColumn('note_public', function ($row) {
                return $row->note_public ? $row->note_public : "";
            });

            $table->addColumn('shipping_method_name', function ($row) {
                return $row->shipping_method ? $row->shipping_method->name : '';
            });

            $table->addColumn('delivery_address_name', function ($row) {
                return $row->delivery_address ? $row->delivery_address->name : '';
            });

            $table->editColumn('delivery_address.name', function ($row) {
                return $row->delivery_address ? (is_string($row->delivery_address) ? $row->delivery_address : $row->delivery_address->name) : '';
            });
            $table->editColumn('paid', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->paid ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'paid']);

            return $table->make(true);
        }

        $entities         = Entity::get();
        $companies        = Company::get();
        $tasks            = Task::get();
        $users            = User::get();
        $order_statuses   = OrderStatus::get();
        $cond_reglements  = CondReglement::get();
        $mode_reglements  = ModeReglement::get();
        $shipping_methods = ShippingMethod::get();
        $addresses        = Address::get();
        $teams            = Team::get();

        return view('admin.invoicesLists.index', compact('entities', 'companies', 'tasks', 'users', 'order_statuses', 'cond_reglements', 'mode_reglements', 'shipping_methods', 'addresses', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('invoices_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sellers = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tasks = Task::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $valids = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_updateds = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = OrderStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cond_reglements = CondReglement::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mode_reglements = ModeReglement::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_methods = ShippingMethod::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $delivery_addresses = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.invoicesLists.create', compact('entities', 'sellers', 'clients', 'tasks', 'authors', 'valids', 'user_updateds', 'statuses', 'cond_reglements', 'mode_reglements', 'shipping_methods', 'delivery_addresses'));
    }

    public function store(StoreInvoicesListRequest $request)
    {
        $invoicesList = InvoicesList::create($request->all());

        return redirect()->route('admin.invoices-lists.index');
    }

    public function edit(InvoicesList $invoicesList)
    {
        abort_if(Gate::denies('invoices_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sellers = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tasks = Task::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $valids = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_updateds = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = OrderStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cond_reglements = CondReglement::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mode_reglements = ModeReglement::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_methods = ShippingMethod::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $delivery_addresses = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $invoicesList->load('entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team');

        return view('admin.invoicesLists.edit', compact('entities', 'sellers', 'clients', 'tasks', 'authors', 'valids', 'user_updateds', 'statuses', 'cond_reglements', 'mode_reglements', 'shipping_methods', 'delivery_addresses', 'invoicesList'));
    }

    public function update(UpdateInvoicesListRequest $request, InvoicesList $invoicesList)
    {
        $invoicesList->update($request->all());

        return redirect()->route('admin.invoices-lists.index');
    }

    public function show(InvoicesList $invoicesList)
    {
        abort_if(Gate::denies('invoices_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoicesList->load('entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team');

        return view('admin.invoicesLists.show', compact('invoicesList'));
    }

    public function destroy(InvoicesList $invoicesList)
    {
        abort_if(Gate::denies('invoices_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoicesList->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvoicesListRequest $request)
    {
        InvoicesList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
