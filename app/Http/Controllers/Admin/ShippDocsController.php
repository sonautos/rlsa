<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Entity;
use App\Models\ShippLine;
use App\Models\Shippmentslist;
use PDF;
use Illuminate\Http\Request;
use Storage;

class ShippDocsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $shippment = Shippmentslist::with('shippmentShippLines', 'shippmentTrucks')->findOrFail($id);

        $total_prices = $shippment->shippmentShippLines->sum('price');
        $clients = $shippment->shippmentShippLines->groupBy('client_id');
        $sellers = $shippment->shippmentShippLines->groupBy('seller_id');
        $cmr = 0;
        if (isset($shippment->shippmentTrucks->cmr)){
            $cmr = $shippment->shippmentTrucks->cmr->getUrl();
        }

        
        // $documents = Upload::where('ref', $shippment->ref)->get();
        // $cmrs = Upload::where('ref', $shippment->ref)->where('type', 'cmr')->get();
        // $attests = Upload::where('ref', $shippment->ref)->where('type', 'attestation')->get();

        $entities = Entity::get();
        $suppliers = Company::where('supplier', 1)->get();
        $societes = Company::get();
        $companies = Company::get();
        $user = $request->user();

        return view('admin.shippmentslists.documents.index', compact('shippment', 'entities', 'suppliers','societes', 'user', 'total_prices', 'cmr', 'companies', 'clients', 'sellers'));
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
    public function destroy($id)
    {
        //
    }

    public function receptionPDF(Request $request)
    {
        $lines = ShippLine::findOrFail($request->id);

        $lines = $lines->where('seller_id', $request->seller)->where('client_id', $request->client);

        $user = $request->user();
        $shippment = Shippmentslist::with('shippmentShippLines', 'shippmentTrucks')
            ->where('ref', $request->key)
            ->first();

        $client = Company::where('id', $request->client)->first();
        $seller = Company::where('id', $request->seller)->first();

        $filename = $seller->name.'-'.$client->name.'-'.$request->key.'.pdf';

        $pdf = PDF::loadView('admin.shippmentslists.documents.attestation-reception', compact('user', 'shippment', 'lines', 'client','seller' ));

        return $pdf->stream($filename);
    }

    public function upload(Request $request, $ref)
    {
        $uploadedFile = $request->file('file');
        $shippment = Shippment::where('ref', $ref)->first();
        $filename = 'cmr-'.$uploadedFile->getClientOriginalName();
        $type = 'cmr';
        $resource = 'shippment';
        $resource_id = $shippment->id;
        $entity = Entity::whereLabel($shippment->entity)->first();
        $path = $entity->rowid.'/'.'shippments/crm/'.$ref.'/';


        Storage::disk('documents')->putFileAs(
            $path,
            $uploadedFile,
            $filename
        );

        $upload = new Upload();
        $upload->filename = $filename;
        $upload->type = $type;
        $upload->ref = $ref;
        $upload->resource = $resource;
        $upload->resource_id = $resource_id;
        $upload->path = $path;
        $upload->user()->associate(auth()->user());
        $upload->save();

        return response()->json([
            'id' => $upload->id
      ]);
    }

    public function cerfa(Request $request, $key, $seller,  $ref)
    {
        $ids = $request->id;

        foreach ($ids as $id){
            $lines[] = ShippmentDet::where('id', $id)
                ->where('seller', $seller)
                ->first();
        }

        $user = $request->user();
        $shippment = Shippment::where('ref', $ref)->first();
        $client = Societe::where('nom', $key)->first();
        $seller = Entity::where('label', $seller)->first();
        $path = $seller->rowid.'/shippments/cerfa/'.$seller->rowid.'/'.$client->rowid.'/'.$ref.'/';
        $type = 'cerfa';
        $filename = $seller->label.'-'.$client->nom.'-'.$ref.'.pdf';

        $pdf = PDF::loadView('shippments.documents.cerfa', compact('user', 'shippment', 'lines', 'client','seller' ));

        // $file = Upload::where('filename', $filename)->first();
        // if ($file){
        //     $file->delete();
        // }

        // $upload = new Upload();
        // $upload->filename = $filename;
        // $upload->type = $type;
        // $upload->ref = $ref;
        // $upload->resource = 'shippment';
        // $upload->resource_id = $shippment->id;
        // $upload->path = $path;
        // $upload->user()->associate(auth()->user());
        // $upload->save();

        // Storage::put('dolibarr/documents/'.$path.$filename, $pdf->output());
        return $pdf->stream($filename);
    }
}
