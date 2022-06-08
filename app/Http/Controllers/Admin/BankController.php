<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Entity;
use App\Models\Company;
use App\Models\Individual;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($request->ajax()) {
            $query = Bank::with(['entity', 'company', 'individual'])->select(sprintf('%s.*', (new Bank)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'modele_show';
                $editGate      = 'modele_edit';
                $deleteGate    = 'modele_delete';
                $crudRoutePart = 'modeles';

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
            $table->editColumn('iban', function ($row) {
                return $row->iban ? $row->iban : "";
            });
            $table->editColumn('swift', function ($row) {
                return $row->swift ? $row->swift : "";
            });
            $table->addColumn('entity_name', function ($row) {
                return $row->entity ? $row->entity->name : '';
            });
            $table->addColumn('company_name', function ($row) {
                return $row->company ? $row->company->name : '';
            });
            $table->addColumn('individual_name', function ($row) {
                return $row->individual ? $row->individual->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'make']);

            return $table->make(true);
        }

        $banks = Bank::get();

        return view('admin.modeles.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $entity_id = 0;
        $company_id = 0;
        $individual_id = 0;
        if (isset($request->entity_id)) {
            $entity_id = $request->entity_id;
        }
        if (isset($request->company_id)) {
            $company_id = $request->company_id;
        }
        if (isset($request->individual_id)) {
            $individual_id = $request->individual_id;
        }

        $entities = Entity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $companies = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $individuals = Individual::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.banks.create', compact('entities', 'companies', 'individuals', 'entity_id', 'company_id', 'individual_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'iban'          => 'required',
            'swift'         => 'required',

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $bank = Bank::create([
            'entity_id' => $request->entity_id,
            'company_id' => $request->company_id,
            'individual_id' => $request->individual_id,
            'name' => $request->name,
            'iban' => $request->iban,
            'swift' => $request->swift,
        ]);

        // if (!empty($request->entity_id)){
        //     return view('admin.entities.show', ['id' => $request->entity_id])->with('message', trans('trans.bank-create'));
        // }
        // if (!empty($request->company_id)){
        //     return view('admin.companies.show', ['id' => $request->company_id])->with('message', trans('trans.bank-create'));
        // }
        // if (!empty($request->individual_id)){
        //     return view('admin.individuals.show', ['id' => $request->individual_id])->with('message', trans('trans.bank-create'));
        // }
        return view('admin.banks.index')->with('message', trans('trans.bank-create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();

        return back();
    }
}
