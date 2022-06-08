<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ShippDemandExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyShippmentslistRequest;
use App\Http\Requests\StoreShippmentslistRequest;
use App\Http\Requests\UpdateShippmentslistRequest;
use App\Http\Requests\UpdateTruckRequest;
use App\Models\Address;
use App\Models\Company;
use App\Models\Entity;
use App\Models\OrderLine;
use App\Models\OrdersList;
use App\Models\ShippLine;
use App\Models\Shippmentslist;
use App\Models\ShippStatus;
use App\Models\Task;
use App\Models\Team;
use App\Models\Truck;
use App\Models\User;
use App\Models\Car;
use Gate;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ShippmentslistController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('shippmentslist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Shippmentslist::with(['entity', 'status', 'user', 'team', 'shippmentShippLines', 'shippmentTrucks'])->select(sprintf('%s.*', (new Shippmentslist)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'shippmentslist_show';
                $editGate      = 'shippmentslist_edit';
                $deleteGate    = 'shippmentslist_delete';
                $crudRoutePart = 'shippmentslists';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            // $table->editColumn('id', function ($row) {
            //     return $row->id ? $row->id : "";
            // });
            $table->editColumn('ref', function ($row) {
                return $row->ref ? $row->ref : "";
            });
            $table->addColumn('entity_name', function ($row) {
                return $row->entity ? $row->entity->name : '';
            });

            $table->addColumn('status_name', function ($row) {
                return $row->status ? trans('trans.'.$row->status->name) : '';
            });

            $table->addColumn('paid_status', function ($row) {
                return $row->shippmentTrucks ? ( $row->shippmentTrucks->paid == 1 ? trans('trans.paid') : trans('trans.no-paid') ) : '';
            });

            $table->addColumn('user_firstname', function ($row) {
                return $row->user ? $row->user->firstname.' '.$row->user->name : '';
            });

            $table->addColumn('seller_name', function ($row) {
                if ($row->shippmentShippLines) {
                    foreach ($row->shippmentShippLines as $line) {
                        $sellers[] = $line->seller->name;
                    }
                    $sellers = array_unique($sellers);
                    $sellers = implode(', ', $sellers);
                }
                return $row->shippmentShippLines ? $sellers : '';
            });

            $table->addColumn('client_name', function ($row) {
                if ($row->shippmentShippLines) {
                    foreach ($row->shippmentShippLines as $line) {
                        $clients[] = $line->client->name;
                    }
                    $clients = array_unique($clients);
                    $clients = implode(', ', $clients);
                }
                return $row->shippmentShippLines ? $clients : '';
            });

            $table->addColumn('price_truck', function ($row) {
                return $row->shippmentTrucks ? to_money_table($row->shippmentTrucks->price) : '';
            });
            $table->addColumn('price_sold', function ($row) {
                return $row->shippmentShippLines ? to_money_table(round($row->shippmentShippLines->sum('price'))) : '';
            });
            $table->addColumn('margin', function ($row) {
                return $row->shippmentTrucks && $row->shippmentShippLines ? to_money_table(round($row->shippmentShippLines->sum('price') - $row->shippmentTrucks->price)) : '';
            });

            $table->addColumn('date_load', function ($row) {
                return $row->shippmentTrucks ? to_date($row->shippmentTrucks->date_load) : '';
            });
            $table->addColumn('date_cmr', function ($row) {
                return $row->shippmentTrucks ? $row->shippmentTrucks->date_cmr : '';
            });
            

            // $table->editColumn('user.name', function ($row) {
            //     return $row->user ? (is_string($row->user) ? $row->user : $row->user->name) : '';
            // });
            $table->editColumn('note_private', function ($row) {
                return $row->note_private ? $row->note_private : "";
            });
            $table->editColumn('note_public', function ($row) {
                return $row->note_public ? $row->note_public : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'entity', 'status', 'user']);

            return $table->make(true);
        }

        $entities       = Entity::get();
        $shipp_statuses = ShippStatus::get();
        $users          = User::get();
        $teams          = Team::get();
        $seller_ids     = ShippLine::all()->groupBy('seller_id');
        foreach ($seller_ids as $id => $line) {
            $sellers[] = Company::findOrFail($id);
        }
        $sellers = array_unique($sellers);
        $client_ids     = ShippLine::all()->groupBy('client_id');
        foreach ($client_ids as $id => $line) {
            $clients[] = Company::findOrFail($id);
        }

        return view('admin.shippmentslists.index', compact('entities', 'shipp_statuses', 'users', 'teams', 'sellers', 'clients'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('shippmentslist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lines = OrderLine::with('vehicle', 'order')->findOrFail($request->id);

        $sellers = Company::with('societeAddresses')->where('supplier', 1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $clients = Company::with('societeAddresses')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addresses = Address::all();

        $entities = Entity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = ShippStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.shippmentslists.create', compact('entities', 'statuses', 'users', 'lines', 'sellers', 'clients', 'addresses'));
    }

    public function store(StoreShippmentslistRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'orderLine.*'           => 'bail|nullable',
            'model.*'               => 'bail|required|string',
            'vin.*'                 => 'bail|required|string',
            'color.*'               => 'bail|nullable|string',
            'plates.*'              => 'bail|nullable|string',
            'seller.*'              => 'bail|required|string',
            'warehouse.*'           => 'bail|required|string',
            'client.*'              => 'bail|required|string',
            'delivery_address.*'    => 'bail|required|string',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $ref = IdGenerator::generate(['table' => 'shippmentslists','field'=>'ref', 'length' => 11, 'prefix' =>'SH'.date('ym')]);
        $request->request->add([
            'ref' => $ref,
            'status_id' => 1,
        ]);
        // return $request->all();
        $shippmentslist = Shippmentslist::create($request->all());

        $vins = $request->input('vin', []);
        $models = $request->input('model', []);
        $sellers = $request->input('seller', []);
        $clients = $request->input('client', []);
        $colors = $request->input('color', []);
        $platess = $request->input('plates', []);
        $order_ids = $request->input('orderLine', []);
        $warehouses = $request->input('warehouse', []);
        $delivery_addresses = $request->input('delivery_address', []);

        foreach ($vins as $key => $vin){
            if (isset($order_ids[$key])) {
                $orderLine = OrderLine::findOrFail($order_ids[$key]);
                $orderLine->update([
                    'status_id' => 2,
                ]);
            }
            $line = new ShippLine();
            $line->user_id = $request->user_id;
            $line->vin = $vin;
            $line->modele = isset($models[$key]) ? $models[$key] : '';
            $line->order_id = isset($order_ids[$key]) ? $orderLine->order_id : null;
            $line->seller_id = isset($sellers[$key]) ? $sellers[$key] : '';
            $line->client_id = isset($clients[$key]) ? $clients[$key] : '';
            $line->color = isset($colors[$key]) ? $colors[$key] : '';
            $line->plates = isset($platess[$key]) ? $platess[$key] : '';
            $line->loading_place = isset($warehouses[$key]) ? $warehouses[$key] : '';
            $line->delivery_place = isset($delivery_addresses[$key]) ? $delivery_addresses[$key] : '';
            $line->status_id = 1;
            $line->shippment_id = $shippmentslist->id;
            $line->save();
        };

        $truck = new Truck();
        $truck->user_id = $request->user_id;
        $truck->shippment_id = $shippmentslist->id;
        $truck->save();

        // Creation de la tache
        $task = Task::create([
            'name' => 'Shippment '.$shippmentslist->ref,
            'description' => 'Invoiced by '.$shippmentslist->entity->name,
            'status_id' => 1,
            'due_date' => $request->date_delivery,
            'assigned_to_id' => $request->user_id,
        ]);
        // Fin de creation

        // return redirect()->route('admin.shippmentslists.index');
        return redirect(url('admin/shippmentslists/'.$shippmentslist->id ));
    }

    public function edit(Shippmentslist $shippmentslist)
    {
        abort_if(Gate::denies('shippmentslist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entities = Entity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = ShippStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shippmentslist->load('entity', 'status', 'user', 'team', 'shippmentShippLines', 'shippmentTrucks');

        return view('admin.shippmentslists.edit', compact('entities', 'statuses', 'users', 'shippmentslist'));
    }

    public function update(UpdateShippmentslistRequest $request, Shippmentslist $shippmentslist)
    {
        $shippmentslist->update($request->all());

        return redirect()->back()->with('message', trans('trans.shippment-update'));
    }

    public function show(Shippmentslist $shippmentslist)
    {
        abort_if(Gate::denies('shippmentslist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippmentslist->load('entity', 'status', 'user', 'team', 'shippmentShippLines', 'shippmentTrucks');

        $entities = Entity::all();

        $statuses = ShippStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suppliers = Company::where('supplier', 1)->get();

        $addresses = Address::all();

        return view('admin.shippmentslists.show', compact('shippmentslist', 'entities', 'suppliers', 'statuses', 'users', 'addresses'));
    }

    public function destroy(Shippmentslist $shippmentslist)
    {
        abort_if(Gate::denies('shippmentslist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shipplines = ShippLine::where('shippment_id', $shippmentslist->id)->get();
        foreach ($shipplines as $shippline){
            if (isset($shippline->order_id)) {
                $orderline = OrderLine::where('vin', $shippline->vin)->first();
                    if($orderline){
                        $orderline->update([
                            'status_id' => 1,
                        ]);
                    }
            }
        }
        $shippmentslist->delete();

        return back();
    }

    public function massDestroy(MassDestroyShippmentslistRequest $request)
    {
        Shippmentslist::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }





    public function shippmentUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status'        => 'bail|required|integer',
            'note_private'  => 'bail|nullable|max:500',
            'note_public'   => 'bail|nullable|max:500',

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = $request->user();
        $user_id = $user->id;

        ShippmentsList::whereId($id)->update([
            'status'        => $request->status,
            'note_private'  => $request->note_private,
            'note_public'   => $request->note_public,
            'user_id'       => $user_id
        ]);

        return redirect()->back()->with('message', trans('trans.shippmentUpdate'));
    }

    public function entityUpdate(Request $request)
    {
        $shippment = ShippmentsList::findOrFail($request->id);

        $shippment->update([
            'entity' => $request->entity
        ]);

        return redirect()->back()->with('message', trans('trans.entityUpdate'));
    }

    public function truckUpdate(UpdateTruckRequest $request)
    {
        $truck = Truck::where('shippment_id', $request->shippment_id)->first();
        $lines = ShippLine::with('order', 'vehicle')->where('shippment_id', $request->shippment_id)->get();
        foreach ($lines as $line){
            $vh = Car::where('vin', $line->vin)->first();
            if ($vh){
                $orderlines[] = OrderLine::where('vehicle_id', $vh->id)->first();
            }

        }
        $shippment = ShippmentsList::findOrFail($request->shippment_id);
        $user = $request->user();
        $user_id = $user->id;

        $status = 1;
        if ($request->date_load != null && $request->date_cmr == null) {
            $status = 2;
            foreach ($lines as $line) {
                $line->update([
                    'status_id' => 2,
                ]);
            }
        } elseif ($request->date_load != null && $request->date_cmr != null) {
            $status = 3;
            foreach ($lines as $line) {
                $line->update([
                    'status_id' => 3,
                ]);
            }
        }

        $truck->update([
            'supplier_id'   => $request->supplier_id,
            'plates'        => $request->plates,
            'chauffeur'     => $request->chauffeur,
            'price'         => $request->price,
            'date_load'     => Carbon::createFromFormat(config('panel.date_format'), $request->date_load)->format('Y-m-d'),
            'date_cmr'      => $request->date_cmr,
            'status'        => $status,
            'paid'          => $request->paid,
            'user_id'       => $user_id,
        ]);

        $shippment->update([
            'status_id' => $status
        ]);
        foreach ($orderlines as $ol){
            $ol->update([
                'status_id' => $status
            ]);
        }

        return redirect()->back()->with('message', trans('trans.truckUpdate'));
    }

    public function totalUpdate(Request $request)
    {
        $unit_price = ($request->total_prices)/($request->car_number);

        ShippLine::where('shippment_id', $request->id)->update([
            'price'             => $unit_price,
        ]);

        return redirect()->back()->with('message', trans('trans.totalPricesUpdate'));
    }

    public function destroyLine(Request $request)
    {
        abort_if(Gate::denies('shipp_line_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippLine = Shippline::findOrFail($request->id);
        $shippLine->delete();

        return back();
    }

    public function export(Request $request)
    {
        return Excel::download(new ShippDemandExport($request->id), ''.$request->ref.'-ORDER.xlsx');
    }
}
