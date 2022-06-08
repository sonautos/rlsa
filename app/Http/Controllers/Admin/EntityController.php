<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEntityRequest;
use App\Http\Requests\StoreEntityRequest;
use App\Http\Requests\UpdateEntityRequest;
use App\Models\Entity;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EntityController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('entity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Entity::with(['team'])->select(sprintf('%s.*', (new Entity)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'entity_show';
                $editGate      = 'entity_edit';
                $deleteGate    = 'entity_delete';
                $crudRoutePart = 'entities';

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
            $table->editColumn('alias', function ($row) {
                return $row->alias ? $row->alias : "";
            });
            $table->editColumn('supplier', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->supplier ? 'checked' : null) . '>';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : "";
            });
            $table->editColumn('parent', function ($row) {
                return $row->parent ? $row->parent : "";
            });
            $table->editColumn('code_client', function ($row) {
                return $row->code_client ? $row->code_client : "";
            });
            $table->editColumn('code_supplier', function ($row) {
                return $row->code_supplier ? $row->code_supplier : "";
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });
            $table->editColumn('address_2', function ($row) {
                return $row->address_2 ? $row->address_2 : "";
            });
            $table->editColumn('zip', function ($row) {
                return $row->zip ? $row->zip : "";
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : "";
            });
            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : "";
            });
            $table->editColumn('country', function ($row) {
                return $row->country ? $row->country : "";
            });
            $table->editColumn('latitude', function ($row) {
                return $row->latitude ? $row->latitude : "";
            });
            $table->editColumn('longitude', function ($row) {
                return $row->longitude ? $row->longitude : "";
            });
            $table->editColumn('url_place', function ($row) {
                return $row->url_place ? $row->url_place : "";
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('siren', function ($row) {
                return $row->siren ? $row->siren : "";
            });
            $table->editColumn('siret', function ($row) {
                return $row->siret ? $row->siret : "";
            });
            $table->editColumn('ape', function ($row) {
                return $row->ape ? $row->ape : "";
            });
            $table->editColumn('vatnumber', function ($row) {
                return $row->vatnumber ? $row->vatnumber : "";
            });
            $table->editColumn('capital', function ($row) {
                return $row->capital ? $row->capital : "";
            });
            $table->editColumn('note_private', function ($row) {
                return $row->note_private ? $row->note_private : "";
            });
            $table->editColumn('note_public', function ($row) {
                return $row->note_public ? $row->note_public : "";
            });
            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'supplier', 'active']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.entities.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('entity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.entities.create');
    }

    public function store(StoreEntityRequest $request)
    {
        $entity = Entity::create($request->all());

        return redirect()->route('admin.entities.index');
    }

    public function edit(Entity $entity)
    {
        abort_if(Gate::denies('entity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entity->load('team');

        return view('admin.entities.edit', compact('entity'));
    }

    public function update(UpdateEntityRequest $request, Entity $entity)
    {
        $entity->update($request->all());

        return redirect()->route('admin.entities.index');
    }

    public function show(Entity $entity)
    {
        abort_if(Gate::denies('entity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entity->load('team', 'entityCompanies', 'entityIndividuals', 'entityAddresses', 'entityShippmentslists', 'entityOrdersLists', 'entityProformaLists', 'entityInvoicesLists', 'entityCars');

        return view('admin.entities.show', compact('entity'));
    }

    public function destroy(Entity $entity)
    {
        abort_if(Gate::denies('entity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entity->delete();

        return back();
    }

    public function massDestroy(MassDestroyEntityRequest $request)
    {
        Entity::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
