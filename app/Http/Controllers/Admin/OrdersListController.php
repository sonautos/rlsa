<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOrdersListRequest;
use App\Http\Requests\StoreOrdersListRequest;
use App\Http\Requests\UpdateOrdersListRequest;
use App\Models\Address;
use App\Models\Car;
use App\Models\Company;
use App\Models\CondReglement;
use App\Models\Entity;
use App\Models\ModeReglement;
use App\Models\OrderLine;
use App\Models\OrdersList;
use App\Models\OrderStatus;
use App\Models\ShippingMethod;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Services\CheckVinDolibarr;
use App\Services\Commandes;
use App\Services\GetComOrderDoc;
use Carbon\Carbon;
use Ddeboer\Vatin\Validator;
use Gate;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Cache;
use Storage;

class OrdersListController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('orders_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OrdersList::with(['entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team'])->select(sprintf('%s.*', (new OrdersList)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'orders_list_show';
                $editGate      = 'orders_list_edit';
                $deleteGate    = 'orders_list_delete';
                $crudRoutePart = 'orders-lists';

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
            $table->editColumn('signed', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->signed ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'signed']);

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

        return view('admin.ordersLists.index', compact('entities', 'companies', 'tasks', 'users', 'order_statuses', 'cond_reglements', 'mode_reglements', 'shipping_methods', 'addresses', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('orders_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order_ref = IdGenerator::generate(['table' => 'orders_lists','field'=>'ref', 'length' => 11, 'prefix' =>'CO'.date('ym')]);
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

        return view('admin.ordersLists.create', compact('entities', 'sellers', 'clients', 'tasks', 'authors', 'valids', 'user_updateds', 'statuses', 'cond_reglements', 'mode_reglements', 'shipping_methods', 'delivery_addresses'));
    }

    public function createOrder(Request $request)
    {
        abort_if(Gate::denies('orders_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vhs = Car::findOrFail($request->id);
        $order_ref = IdGenerator::generate(['table' => 'orders_lists','field'=>'ref', 'length' => 11, 'prefix' =>'CO'.date('ym')]);
        $date = Carbon::now()->format('Y-m-d');
        $user = auth()->user();

        $entities = Entity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sellers = Company::where('supplier', 1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

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

        return view('admin.ordersLists.create', compact('entities', 'sellers', 'clients', 'tasks', 'authors', 'valids', 'user_updateds', 'statuses', 'cond_reglements', 'mode_reglements', 'shipping_methods', 'delivery_addresses', 'vhs', 'order_ref', 'date', 'user'));
    }

    public function store(StoreOrdersListRequest $request, Commandes $commande, CheckVinDolibarr $car)
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
            $line = OrderLine::where('vehicle_id', $vh->id)->first();
            if ($line) {
                return back()->with('error', trans('vehicule_deja_vendu'));
            }
        }
        foreach($vhs as $vh) {
            $result = $car->checkBefore($vh, true);
            if ($result) {
                return back()->with('error', "Le chassis ".$vh->vin." existe déjà dans Dolibarr!");
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

        $ordersList = OrdersList::create($request->all());

        // Creation de la tache
        $task = Task::create([
            'name' => 'Order '.$ordersList->seller->name.' '.$ordersList->ref,
            'description' => 'Total '.$ordersList->total_ht,
            'status_id' => 1,
            'due_date' => $date_created,
            'assigned_to_id' => $request->author_id,
        ]);
        // Fin de creation

        $ids = $request->input('vhid', []); // Line => rowid
        $vh_prices = $request->input('vh_price', []); //line => tva_tx

        foreach($ids as $key => $id){
            $vh = Car::where('id', $id)->first();
            $line = OrderLine::create([
                'order_id' => $ordersList->id,
                'vehicle_id' => $vh->id,
                'name' => $vh->name,
                'description' => $vh->description,
                'qty' => 1,
                'tva_tx' => $seller->country == $client->country ? $vh->tax : '0',
                'total_ht' => isset($vh_prices[$key]) ? $vh_prices[$key] : '',
                'total_tva' => isset($vh_prices[$key]) && isset($vh->tax) && ($seller->country == $client->country) ? (($vh_prices[$key]*$vh->tax)/100) : '0',
                'total_ttc' => isset($vh_prices[$key]) && isset($vh->tax) && ($seller->country == $client->country) ? ((($vh_prices[$key]*$vh->tax)/100)+$vh_prices[$key]) : '0',
                'cost_price' => $vh->cost_price,
                'comclient' => $request->comseller,
                'status_id' => 1,
            ]);

            $vh->update([
                'qty' => 0,
                'active' => 0,
                'draft' => 0,
            ]);
        }

        return redirect()->route('admin.orders-lists.show', $ordersList->id);
    }

    public function edit(OrdersList $ordersList)
    {
        abort_if(Gate::denies('orders_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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

        $ordersList->load('entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team');

        return view('admin.ordersLists.edit', compact('ordersList','entities', 'sellers', 'clients', 'tasks', 'authors', 'valids', 'user_updateds', 'statuses', 'cond_reglements', 'mode_reglements', 'shipping_methods', 'delivery_addresses'));
    }

    public function update(UpdateOrdersListRequest $request, OrdersList $ordersList)
    {
        $ordersList->update($request->all());

        return redirect()->route('admin.orders-lists.index');
    }

    public function show(OrdersList $ordersList)
    {
        abort_if(Gate::denies('orders_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ordersList->load('entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team', 'orderShippLines', 'orderOrderLines');
        $ls = $ordersList->orderOrderLines->load('vehicle');

        $lines = OrderLine::with('vehicle')
            ->where('order_id', $ordersList->id)
            ->where('vehicle_id', '<>', 'null')
            ->get();
        
        foreach ($ls as $l){
            $comsellers[] = $l->vehicle->comseller;
        }
        $comsellers = array_sum($comsellers);
        $comclients = $ordersList->orderOrderLines->sum('comclient');

        return view('admin.ordersLists.show', compact('ordersList', 'lines', 'comsellers', 'comclients'));
    }

    public function destroy(OrdersList $ordersList)
    {
        abort_if(Gate::denies('orders_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order = OrdersList::with('orderOrderLines', 'task')->findOrFail($ordersList->id);

        foreach($order->orderOrderLines as $line){
            $car = Car::findOrFail($line->vehicle_id);
            $car->update([
                'qty' => 1,
                'active' => 1,
                'draft' => 0,
            ]);
        }

        if ($order->task) {
            $order->task->delete();
        }

        if ($ordersList) {
            $ordersList->delete();
        }
        $ordersList->delete();

        return back()->with('message', trans('global.order').' '.$order->ref.' '.trans('global.deleted'));
    }

    public function massDestroy(MassDestroyOrdersListRequest $request)
    {
        OrdersList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function orderPDF(Request $request)
    {
        abort_if(Gate::denies('orders_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = $request->user();
        $order = OrdersList::with('orderOrderLines', 'task')->findOrFail($request->id);

        $seller = Company::findOrFail($order->seller_id);
        if ($seller->country == null){
            return back()->with('error', trans('trans.complete-country-company').' '.$seller->name);
        }
        $client = Company::findOrFail($order->client_id);
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

        $filename = $client->name.'-'.$order->ref.'.pdf';

        foreach ($order->orderOrderLines as $line){
            $frevos = Car::findOrFail($line->vehicle_id)->sum('frevo');
        }

        $pdf = PDF::loadView('admin.ordersLists.documents.orders', compact('user', 'order', 'client','seller', 'frevos' ));

        return $pdf->stream();
    }

    public function updateLine(Request $request, $id)
    {
        $validator = FacadesValidator::make($request->all(), [
            'description.*' => 'bail|required|string',
            'vin.*'   => 'bail|required|string',
            'plates.*'  => 'bail|required|string',
            'color.*'  => 'bail|required|string',
            'total_ht.*'  => 'bail|required|numeric',
            'comseller.*'  => 'bail|required|numeric',
            'comclient.*'  => 'bail|required|numeric',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ids = $request->input('id', []); // Line => rowid
        $total_hts = $request->input('total_ht', []); //line => Total
        $labels = $request->input('description', []); //line => label

        $vins = $request->input('vin', []); //product

        $platess = $request->input('plates', []); //extra
        $colors = $request->input('color', []); //extra
        $comsellers = $request->input('comseller', []); //extra

        $comclients = $request->input('comclient', []); //extraline

        foreach ($ids as $key => $id){
            $line = OrderLine::where('rowid', $id)->first();
            $total_tva = $tvas[$key]*$total_hts[$key];
            $line->update([
                'name' => isset($labels[$key]) ? $labels[$key] : '',
                'tva_tx' => isset($tvas[$key]) ? $tvas[$key] : '',
                'vin' => isset($vins[$key]) ? $vins[$key] : '' ,
                'total_tva' => $total_tva,
                'total_ht' => isset($total_hts[$key]) ? $total_hts[$key] : '',
                'total_ttc' => $total_hts[$key]+$total_tva,
                'remise' => $subprices[$key]-$total_hts[$key],
                'remise_percent' => ($subprices[$key]-$total_hts[$key])/$subprices[$key]*100,
            ]);
        }

        return back()->with('message', trans('trans.Order-Update'));
    }

    public function comOrder(OrdersList $order, Commandes $commande, CheckVinDolibarr $car)
    {
        $order->load('orderOrderLines');
        // foreach($order->orderOrderLines as $vh) {
        //     $result = $car->checkBefore($vh->vehicle, true);
        //     if ($result) {
        //         return back()->with('error', "Le chassis ".$vh->vehicle->vin." existe déjà dans Dolibarr!");
        //     }
        // }
        $response = $commande->create($order, true);

        $order->update([
            'signed' => 1,
            'status_id' => 2,
            'ref_order_client' => $response['CommandeClientRef'],
            'ref_order_seller' => $response['CommandeSellerRef'],
        ]);

        return back()->with('message', trans('dolibarr.commande-com-create'));
    }

    public function getComOrderDoc($order, GetComOrderDoc $doc) 
    {
        $response = $doc->getDoc($order, true);
        $filename = $response['filename'];
        $content = $response['content'];
        $path       = public_path('tmp/'.$filename);
        $contents   = base64_decode($content);
        
        //store file temporarily
        file_put_contents($path, $contents);
        
        //download file and delete it
        return response()->download($path)->deleteFileAfterSend(true);
    }
}
