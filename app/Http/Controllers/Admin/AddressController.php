<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAddressRequest;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use App\Models\Company;
use App\Models\Entity;
use App\Models\Individual;
use App\Models\TagContact;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AddressController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('address_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Address::with(['societe', 'entity', 'individual', 'user_create', 'user_modif', 'tags'])->select(sprintf('%s.*', (new Address)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'address_show';
                $editGate      = 'address_edit';
                $deleteGate    = 'address_delete';
                $crudRoutePart = 'addresses';

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
            $table->addColumn('societe_name', function ($row) {
                return $row->societe ? $row->societe->name : '';
            });

            $table->addColumn('entity_name', function ($row) {
                return $row->entity ? $row->entity->name : '';
            });

            $table->addColumn('individual_lastname', function ($row) {
                return $row->individual ? $row->individual->lastname : '';
            });

            $table->editColumn('individual.firstname', function ($row) {
                return $row->individual ? (is_string($row->individual) ? $row->individual : $row->individual->firstname) : '';
            });
            $table->editColumn('fonction', function ($row) {
                return $row->fonction ? $row->fonction : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
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
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });
            $table->editColumn('mobile', function ($row) {
                return $row->mobile ? $row->mobile : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->addColumn('user_create_firstname', function ($row) {
                return $row->user_create ? $row->user_create->firstname : '';
            });

            $table->editColumn('user_create.name', function ($row) {
                return $row->user_create ? (is_string($row->user_create) ? $row->user_create : $row->user_create->name) : '';
            });
            $table->addColumn('user_modif_firstname', function ($row) {
                return $row->user_modif ? $row->user_modif->firstname : '';
            });

            $table->editColumn('user_modif.name', function ($row) {
                return $row->user_modif ? (is_string($row->user_modif) ? $row->user_modif : $row->user_modif->name) : '';
            });
            $table->editColumn('note_private', function ($row) {
                return $row->note_private ? $row->note_private : "";
            });
            $table->editColumn('note_public', function ($row) {
                return $row->note_public ? $row->note_public : "";
            });
            $table->editColumn('tags', function ($row) {
                $labels = [];

                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->tag);
                }

                return implode(' ', $labels);
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

            $table->rawColumns(['actions', 'placeholder', 'societe', 'entity', 'individual', 'user_create', 'user_modif', 'tags']);

            return $table->make(true);
        }

        return view('admin.addresses.index');
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('address_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $societes = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entities = Entity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $individuals = Individual::all()->pluck('lastname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_creates = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_modifs = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TagContact::all()->pluck('tag', 'id');

        $companyId = Company::findOrFail($request->company_id);

        return view('admin.addresses.create', compact('societes', 'entities', 'individuals', 'user_creates', 'user_modifs', 'tags', 'companyId'));
    }

    public function store(StoreAddressRequest $request)
    {
        $request->request->add([
            'address'       => $request->street_number.' '.$request->street
        ]);
        
        $address = Address::create($request->all());
        $address->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.addresses.index');
    }

    public function edit(Address $address)
    {
        abort_if(Gate::denies('address_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $societes = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entities = Entity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $individuals = Individual::all()->pluck('lastname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_creates = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_modifs = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TagContact::all()->pluck('tag', 'id');

        $address->load('societe', 'entity', 'individual', 'user_create', 'user_modif', 'tags');

        return view('admin.addresses.edit', compact('societes', 'entities', 'individuals', 'user_creates', 'user_modifs', 'tags', 'address'));
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $address->update($request->all());
        $address->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.addresses.index');
    }

    public function show(Address $address)
    {
        abort_if(Gate::denies('address_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $address->load('societe', 'entity', 'individual', 'user_create', 'user_modif', 'tags');

        return view('admin.addresses.show', compact('address'));
    }

    public function destroy(Address $address)
    {
        abort_if(Gate::denies('address_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $address->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddressRequest $request)
    {
        Address::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
