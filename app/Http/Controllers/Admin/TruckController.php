<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTruckRequest;
use App\Http\Requests\StoreTruckRequest;
use App\Http\Requests\UpdateTruckRequest;
use App\Models\Company;
use App\Models\Shippmentslist;
use App\Models\Team;
use App\Models\Truck;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TruckController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('truck_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Truck::with(['supplier', 'user', 'shippment', 'team'])->select(sprintf('%s.*', (new Truck)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'truck_show';
                $editGate      = 'truck_edit';
                $deleteGate    = 'truck_delete';
                $crudRoutePart = 'trucks';

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
            $table->addColumn('supplier_name', function ($row) {
                return $row->supplier ? $row->supplier->name : '';
            });

            $table->editColumn('plates', function ($row) {
                return $row->plates ? $row->plates : "";
            });
            $table->editColumn('chauffeur', function ($row) {
                return $row->chauffeur ? $row->chauffeur : "";
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : "";
            });
            $table->editColumn('date_load', function ($row) {
                return $row->date_load ? $row->date_load : "";
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : "";
            });
            $table->editColumn('paid', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->paid ? 'checked' : null) . '>';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('shippment_ref', function ($row) {
                return $row->shippment ? $row->shippment->ref : '';
            });

            $table->editColumn('cmr', function ($row) {
                return $row->cmr ? '<a href="' . $row->cmr->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'supplier', 'paid', 'user', 'shippment', 'cmr']);

            return $table->make(true);
        }

        $companies       = Company::get();
        $users           = User::get();
        $shippmentslists = Shippmentslist::get();
        $teams           = Team::get();

        return view('admin.trucks.index', compact('companies', 'users', 'shippmentslists', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('truck_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suppliers = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shippments = Shippmentslist::all()->pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.trucks.create', compact('suppliers', 'users', 'shippments'));
    }

    public function store(StoreTruckRequest $request)
    {
        $truck = Truck::create($request->all());

        if ($request->input('cmr', false)) {
            $truck->addMedia(storage_path('tmp/uploads/' . $request->input('cmr')))->toMediaCollection('cmr');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $truck->id]);
        }

        return redirect()->route('admin.trucks.index');
    }

    public function edit(Truck $truck)
    {
        abort_if(Gate::denies('truck_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suppliers = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shippments = Shippmentslist::all()->pluck('ref', 'id')->prepend(trans('global.pleaseSelect'), '');

        $truck->load('supplier', 'user', 'shippment', 'team');

        return view('admin.trucks.edit', compact('suppliers', 'users', 'shippments', 'truck'));
    }

    public function update(UpdateTruckRequest $request, Truck $truck)
    {
        $truck->update($request->all());

        if ($request->input('cmr', false)) {
            if (!$truck->cmr || $request->input('cmr') !== $truck->cmr->file_name) {
                if ($truck->cmr) {
                    $truck->cmr->delete();
                }

                $truck->addMedia(storage_path('tmp/uploads/' . $request->input('cmr')))->toMediaCollection('cmr');
            }
        } elseif ($truck->cmr) {
            $truck->cmr->delete();
        }

        return redirect()->back()->with('message', trans('trans.truck-update'));
    }

    public function show(Truck $truck)
    {
        abort_if(Gate::denies('truck_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $truck->load('supplier', 'user', 'shippment', 'team');

        return view('admin.trucks.show', compact('truck'));
    }

    public function destroy(Truck $truck)
    {
        abort_if(Gate::denies('truck_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $truck->delete();

        return back();
    }

    public function massDestroy(MassDestroyTruckRequest $request)
    {
        Truck::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('truck_create') && Gate::denies('truck_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Truck();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
