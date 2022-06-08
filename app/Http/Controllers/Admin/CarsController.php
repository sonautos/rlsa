<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCarRequest;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use App\Models\CodeModel;
use App\Models\Company;
use App\Models\Entity;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use App\Models\Team;
use App\Models\User;
use App\Models\Version;
use App\Models\Make;
use App\Models\Modele;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class CarsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('car_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Car::with(['user', 'entity', 'seller', 'categories', 'code_model', 'version', 'tags', 'team'])
                ->select(sprintf('%s.*', (new Car)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'car_show';
                $editGate      = 'car_edit';
                $deleteGate    = 'car_delete';
                $crudRoutePart = 'cars';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.firstname', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->firstname) : '';
            });
            $table->addColumn('entity_name', function ($row) {
                return $row->entity ? $row->entity->name : '';
            });

            $table->addColumn('seller_name', function ($row) {
                return $row->seller ? $row->seller->name : '';
            });

            $table->editColumn('country', function ($row) {
                return $row->country ? $row->country : "";
            });
            $table->editColumn('categorie', function ($row) {
                $labels = [];

                foreach ($row->categories as $categorie) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $categorie->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('vin', function ($row) {
                return $row->vin ? $row->vin : "";
            });
            $table->editColumn('plates', function ($row) {
                return $row->plates ? $row->plates : "";
            });
            $table->editColumn('idv', function ($row) {
                return $row->idv ? $row->idv : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });
            $table->editColumn('private_note', function ($row) {
                return $row->private_note ? $row->private_note : "";
            });
            $table->addColumn('code_model_code', function ($row) {
                return $row->code_model ? $row->code_model->code : '';
            });

            $table->editColumn('make', function ($row) {
                return $row->make ? $row->make : "";
            });
            $table->editColumn('modele', function ($row) {
                return $row->modele ? $row->modele : "";
            });
            $table->addColumn('version_description', function ($row) {
                return $row->version ? $row->version->description : '';
            });

            $table->editColumn('version.motor', function ($row) {
                return $row->version ? (is_string($row->version) ? $row->version : $row->version->motor) : '';
            });
            $table->editColumn('motor', function ($row) {
                return $row->motor ? $row->motor : "";
            });
            $table->editColumn('ch', function ($row) {
                return $row->ch ? $row->ch : "";
            });
            $table->editColumn('co_2', function ($row) {
                return $row->co_2 ? $row->co_2 : "";
            });
            $table->editColumn('energy', function ($row) {
                return $row->energy ? $row->energy : "";
            });
            $table->editColumn('gear', function ($row) {
                return $row->gear ? $row->gear : "";
            });
            $table->editColumn('conso', function ($row) {
                return $row->conso ? $row->conso : "";
            });
            $table->editColumn('image', function ($row) {
                if (!$row->image) {
                    return '';
                }

                $links = [];

                foreach ($row->image as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->editColumn('kms', function ($row) {
                return $row->kms ? $row->kms : "";
            });
            $table->editColumn('color', function ($row) {
                return $row->color ? $row->color : "";
            });
            $table->editColumn('interior', function ($row) {
                return $row->interior ? $row->interior : "";
            });
            $table->editColumn('price_new', function ($row) {
                return $row->price_new ? $row->price_new : "";
            });
            $table->editColumn('frevo', function ($row) {
                return $row->frevo ? $row->frevo : "";
            });
            $table->editColumn('real_frevo', function ($row) {
                return $row->real_frevo ? $row->real_frevo : "";
            });
            $table->editColumn('link_frevo', function ($row) {
                return $row->link_frevo ? $row->link_frevo : "";
            });
            $table->editColumn('discount', function ($row) {
                return $row->discount ? $row->discount : "";
            });
            $table->editColumn('price_ht', function ($row) {
                return $row->price_ht ? $row->price_ht : "";
            });
            $table->editColumn('price_ttc', function ($row) {
                return $row->price_ttc ? $row->price_ttc : "";
            });
            $table->editColumn('tax', function ($row) {
                return $row->tax ? $row->tax : "";
            });

            $table->editColumn('cost_price', function ($row) {
                return $row->cost_price ? $row->cost_price : "";
            });
            $table->editColumn('impuesto', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->impuesto ? 'checked' : null) . '>';
            });
            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });
            $table->editColumn('qty', function ($row) {
                return $row->qty > 0 ? trans('trans.stock') : trans('trans.sold');
            });
            $table->editColumn('draft', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->draft ? 'checked' : null) . '>';
            });

            $table->editColumn('warehouse', function ($row) {
                return $row->warehouse ? $row->warehouse : "";
            });
            $table->editColumn('comseller', function ($row) {
                return $row->comseller ? $row->comseller : "";
            });
            $table->editColumn('import_key', function ($row) {
                return $row->import_key ? $row->import_key : "";
            });
            $table->editColumn('tags', function ($row) {
                $labels = [];

                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'entity', 'seller', 'categorie', 'code_model', 'version', 'image', 'impuesto', 'active', 'draft', 'tags']);

            return $table->make(true);
        }

        $users              = User::get();
        $entities           = Entity::get();
        $companies          = Company::get();
        $product_categories = ProductCategory::get();
        $code_models        = CodeModel::get();
        $versions           = Version::get();
        $product_tags       = ProductTag::get();
        $teams              = Team::get();
        $makes              = Make::get();
        $modeles            = Modele::get();

        return view('admin.cars.index', compact('users', 'entities', 'companies', 'product_categories', 'code_models', 'versions', 'product_tags', 'teams', 'makes', 'modeles'));
    }

    public function create()
    {
        abort_if(Gate::denies('car_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entities = Entity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sellers = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = ProductCategory::all()->pluck('name', 'id');

        $code_models = CodeModel::all()->pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $versions = Version::all()->pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = ProductTag::all()->pluck('name', 'id');

        $makes = Make::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $modeles = Modele::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cars.create', compact('users', 'entities', 'sellers', 'categories', 'code_models', 'versions', 'tags', 'makes', 'modeles'));
    }

    public function store(StoreCarRequest $request)
    {
        $car = Car::create($request->all());
        $car->categories()->sync($request->input('categories', []));
        $car->tags()->sync($request->input('tags', []));

        foreach ($request->input('image', []) as $file) {
            $car->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $car->id]);
        }

        return redirect()->route('admin.cars.index');
    }

    public function edit(Car $car)
    {
        abort_if(Gate::denies('car_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entities = Entity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sellers = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = ProductCategory::all()->pluck('name', 'id');

        $code_models = CodeModel::all()->pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $makes = Make::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modeles = Modele::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $versions = Version::all();

        $tags = ProductTag::all()->pluck('name', 'id');

        $car->load('user', 'entity', 'seller', 'categories', 'code_model', 'version', 'tags', 'team');

        return view('admin.cars.edit', compact('users', 'entities', 'sellers', 'categories', 'code_models', 'versions', 'tags', 'car', 'makes', 'modeles'));
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->update($request->all());
        $car->categories()->sync($request->input('categories', []));
        $car->tags()->sync($request->input('tags', []));

        if (count($car->image) > 0) {
            foreach ($car->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }

        $media = $car->image->pluck('file_name')->toArray();

        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $car->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }
        }

        return redirect()->route('admin.cars.index');
    }

    public function show(Car $car)
    {
        abort_if(Gate::denies('car_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $car->load('user', 'entity', 'seller', 'categories', 'code_model', 'version', 'tags', 'team', 'vehicleShippLines', 'vehicleOrderLines', 'vehicleProformaLines', 'vehicleInvoiceLines');

        return view('admin.cars.show', compact('car'));
    }

    public function destroy(Car $car)
    {
        abort_if(Gate::denies('car_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $car->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarRequest $request)
    {
        Car::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function massCreate()
    {
        return view('admin.carImport.mass-import');
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('car_create') && Gate::denies('car_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Car();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function ficheProduct(Request $request)
    {
        abort_if(Gate::denies('car_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $car = Car::findOrFail($request->id);

        $pdf = PDF::loadView('admin.cars.documents.fiche_produit', compact('car'));

        return $pdf->stream();
    }
}
