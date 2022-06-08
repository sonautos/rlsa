<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProformaListRequest;
use App\Http\Requests\StoreProformaListRequest;
use App\Http\Requests\UpdateProformaListRequest;
use App\Models\Address;
use App\Models\Car;
use App\Models\Company;
use App\Models\CondReglement;
use App\Models\Entity;
use App\Models\ModeReglement;
use App\Models\OrderLine;
use App\Models\OrdersList;
use App\Models\OrderStatus;
use App\Models\ProformaLine;
use App\Models\ProformaList;
use App\Models\ShippingMethod;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Ddeboer\Vatin\Validator;
use Gate;
use PDF;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProformaListController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('proforma_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProformaList::with(['entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team'])->select(sprintf('%s.*', (new ProformaList)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'proforma_list_show';
                $editGate      = 'proforma_list_edit';
                $deleteGate    = 'proforma_list_delete';
                $crudRoutePart = 'proforma-lists';

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

        return view('admin.proformaLists.index', compact('entities', 'companies', 'tasks', 'users', 'order_statuses', 'cond_reglements', 'mode_reglements', 'shipping_methods', 'addresses', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('proforma_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prof_ref = IdGenerator::generate(['table' => 'proforma_lists','field'=>'ref', 'length' => 11, 'prefix' =>'PF'.date('ym')]);
        $date = Carbon::now()->format('Y-m-d');
        $user = auth()->user();

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

        return view('admin.proformaLists.create', compact('entities', 'sellers', 'clients', 'tasks', 'authors', 'valids', 'user_updateds', 'statuses', 'cond_reglements', 'mode_reglements', 'shipping_methods', 'delivery_addresses', 'prof_ref', 'date', 'user'));
    }

    public function createFromOrder(Request $request)
    {
        abort_if(Gate::denies('proforma_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderlines = OrderLine::with('vehicle', 'order')->findOrFail($request->id);
        $orders = $orderlines->groupBy('order_id');
        foreach ($orders as $key => $value ) {
            $commandes[] = OrdersList::findOrFail($key);
            foreach ($commandes as $c) {
                $sellers[] = Company::findOrFail($c->seller_id);
                $seller = array_unique($sellers);
                $clients[] = Company::findOrFail($c->client_id);
                $client = array_unique($clients);
                $entities[] = Entity::findOrFail($c->entity_id);
                $entity = array_unique($entities);
            }
        }

        if (count($entity) > 1){
            return back()->with('error', trans('trans.multiple-entities'));
        } else {
            foreach( $entity as $e) {
                $ent = Entity::findOrFail($e->id)->first();
            }
        }
        if (count($seller) > 1){
            return back()->with('error', trans('trans.multiple-sellers'));
        } else {
            foreach( $seller as $s) {
                $sel = Company::where('id', $s->id)->first();
            }
        }
        if (count($client) > 1){
            return back()->with('error', trans('trans.multiple-clients'));
        } else {
            foreach( $client as $c) {
                $cli = Company::findOrFail($c->id)->first();
            }
        }

        $prof_ref = IdGenerator::generate(['table' => 'proforma_lists','field'=>'ref', 'length' => 11, 'prefix' =>'PF'.date('ym')]);
        $date = Carbon::now()->format('Y-m-d');
        $user = auth()->user();

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

        return view('admin.proformaLists.create', compact('entities', 'sellers', 'clients', 'tasks', 'authors', 'valids', 'user_updateds', 'statuses', 'cond_reglements', 'mode_reglements', 'shipping_methods', 'delivery_addresses', 'orderlines', 'prof_ref', 'date', 'user', 'ent', 'sel', 'cli'));
    }

    public function store(StoreProformaListRequest $request)
    {
        $vhs = Car::findOrFail($request->vhid);
        $vhp = str_replace(' ', '', $request->vh_price);
        $total_ht = array_sum($vhp);
        $date_created = Carbon::parse($request->date_created)->format('d/m/Y');
        $date_livraison = Carbon::parse($request->date_livraison)->format('d/m/Y');
        $request->request->add([
            'total_ht' => $total_ht,
            'date_created' => $date_created,
            'date_livraison' => $date_livraison,
            'status_id' => 1,
        ]);

        foreach ($vhs as $vh){
            $line = ProformaLine::where('vehicle_id', $vh->id)->first();
            if ($line) {
                return back()->with('error', trans('vehicule_deja_vendu'));
            }
        }

        $seller = Company::where('id', $request->seller_id)->first();
        if ($seller->country == null){
            return back()->with('error', trans('trans.complete-country-company').' '.$seller->name);
        }
        $client = Company::where('id', $request->client_id)->first();
        if ($client->country == null){
            return back()->with('error', trans('trans.complete-country-company').' '.$client->name);
        }

        $validator = new Validator();
        $entity_vat_ok = $validator->isValid($seller->vatnumber, true);
        if( $entity_vat_ok == false){
            return back()->with('error', trans('trans.entity-error-vat').' '.$seller->name);
        }
        $client_vat_ok = $validator->isValid($client->vatnumber, true);
        if( $client_vat_ok == false){
            return back()->with('error', trans('trans.client-error-vat').' '.$client->name);
        }

        $proformalist = ProformaList::create($request->all());

        // Creation de la tache
        $task = Task::create([
            'name' => 'Order '.$proformalist->seller->name.' '.$proformalist->ref,
            'description' => 'Total '.$proformalist->total_ht,
            'status_id' => 1,
            'due_date' => $date_created,
            'assigned_to_id' => $request->author_id,
        ]);
        // Fin de creation

        $proformalist->update([
            'task_id' => $task->id
        ]);

        $ids = $request->input('vhid', []); // Line => rowid
        $vh_prices = $request->input('vh_price', []); //line => tva_tx

        foreach($ids as $key => $id){
            $vh = Car::where('id', $id)->first();
            $line = ProformaLine::create([
                'proforma_id' => $proformalist->id,
                'vehicle_id' => $vh->id,
                'name' => $vh->name,
                'description' => $vh->description,
                'qty' => 1,
                'tva_tx' => $seller->country == $client->country ? $vh->tax : '0',
                'total_ht' => isset($vh_prices[$key]) ? $vh_prices[$key] : '',
                'total_tva' => isset($vh_prices[$key]) && isset($vh->tax) && ($seller->country == $client->country) ? (($vh_prices[$key]*$vh->tax)/100) : '0',
                'total_ttc' => isset($vh_prices[$key]) && isset($vh->tax) && ($seller->country == $client->country) ? ((($vh_prices[$key]*$vh->tax)/100)+$vh_prices[$key]) : '0',
                'cost_price' => $vh->cost_price,
                'comclient' => $request->comclient,
                'status_id' => 1,
            ]);

        }

        return redirect()->route('admin.proforma-lists.index');
    }

    public function edit(ProformaList $proformaList)
    {
        abort_if(Gate::denies('proforma_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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

        $proformaList->load('entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team');

        return view('admin.proformaLists.edit', compact('entities', 'sellers', 'clients', 'tasks', 'authors', 'valids', 'user_updateds', 'statuses', 'cond_reglements', 'mode_reglements', 'shipping_methods', 'delivery_addresses', 'proformaList'));
    }

    public function update(UpdateProformaListRequest $request, ProformaList $proformaList)
    {
        $proformaList->update($request->all());

        return redirect()->route('admin.proforma-lists.index');
    }

    public function show(ProformaList $proformaList)
    {
        abort_if(Gate::denies('proforma_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proformaList->load('entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team', 'proformaProformaLines', 'proformaInvoiceLines');

        $lines = ProformaLine::with('vehicle')
            ->where('proforma_id', $proformaList->id)
            ->where('vehicle_id', '<>', 'null')
            ->get();

        foreach ($lines as $line){
            $comsellers = $line->vehicle->sum('comseller');
        }
        $comclients = $lines->sum('comclient');

        return view('admin.proformaLists.show', compact('proformaList', 'lines', 'comsellers', 'comclients'));
    }

    public function destroy(ProformaList $proformaList)
    {
        abort_if(Gate::denies('proforma_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proformaList->delete();

        return back();
    }

    public function massDestroy(MassDestroyProformaListRequest $request)
    {
        ProformaList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function proformaPDF(Request $request)
    {
        // abort_if(Gate::denies('proforma_lists_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = $request->user();
        $proforma = ProformaList::with('proformaProformaLines', 'task')->findOrFail($request->id);

        $seller = Company::findOrFail($proforma->seller_id);
        if ($seller->country == null){
            return back()->with('error', trans('trans.complete-country-company').' '.$seller->name);
        }
        $client = Company::findOrFail($proforma->client_id);
        if ($client->country == null){
            return back()->with('error', trans('trans.complete-country-company').' '.$client->name);
        }
        $validator = new Validator();
        $entity_vat_ok = $validator->isValid($seller->vatnumber, true);
        if( $entity_vat_ok == false){
            return back()->with('error', trans('trans.entity-error-vat').' '.$seller->name);
        }
        $client_vat_ok = $validator->isValid($client->vatnumber, true);
        if( $client_vat_ok == false){
            return back()->with('error', trans('trans.client-error-vat').' '.$client->name);
        }

        $filename = $client->name.'-'.$proforma->ref.'.pdf';

        foreach ($proforma->proformaProformaLines as $line){
            $frevos = Car::findOrFail($line->vehicle_id)->sum('frevo');
        }

        $pdf = PDF::loadView('admin.proformaLists.documents.proforma', compact('user', 'proforma', 'client','seller', 'frevos' ));

        return $pdf->download($filename);
    }
}
