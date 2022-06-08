<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\StockImport;
use App\Models\Car;
use App\Models\User;
use App\Models\Color;
use App\Models\Company;
use App\Models\CsvData;
use App\Models\Feature;
use App\Models\Make;
use App\Models\Modele;
use App\Models\Version;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Str;
use Validator;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Redirect;
use Gate;

class CarsMassImport extends Controller
{
    public function index ()
    {
        return view('carImport.index');
    }
    public function parseImport(Request $request)
    {
        $path       = $request->file('csv_file')->getRealPath();
        $request->validate([
            // 'csv_file' => 'mimes:csv,txt',
            'dispo' => 'required',
            'entity_id' => 'required',
            'seller_id' => 'nullable',
        ]);

        $data       = Excel::toArray(new StockImport,request()->file('csv_file'))[0];

        if (count($data) > 0) {

            $csv_header_fields = [];
            foreach ($data[0] as $key => $value) {
                $csv_header_fields[] = $key;
            }

            $csv_data = array_slice($data, 0, 10);

            $csv_data_file = CsvData::create([
                'csv_filename'      => $request->file('csv_file')->getClientOriginalName(),
                'entity'            => $request->entity_id,
                'seller_id'         => $request->seller_id,
                'dispo'             => $request->dispo,
                'make_id'           => $request->make,
                'modele_id'         => $request->modele,
                'version_id'        => $request->version_id,
                'comseller'         => $request->comseller,
                'qty'               => $request->has('qty'),
                'increasePrice'     => $request->has('increasePrice'),
                'csv_data'          => json_encode($data)
            ]);

            $make = [];
            $modele = [];
            $version = [];
            $stock = 0;
            if (isset($request->make)) {
                $make = Make::findOrFail($request->make);
            }
            if (isset($request->modele)) {
                $modele = Modele::findOrFail($request->modele);
            }
            if (isset($request->version_id)) {
                $version = Version::findOrFail($request->version_id);
            }
            if (isset($request->qty)) {
                $stock = $request->qty == 'on' ? 1 : 0 ;
            }

            // return $stock;
        } else {
            return redirect()->back()->with('error', 'Error');
        }

        return view('carImport.parseInput', compact( 'csv_data', 'csv_header_fields', 'csv_data_file', 'make', 'modele', 'version','stock'));

    }

    public function processImport(Request $request)
    {
        // $modele = Modele::all();
        $data = CsvData::find($request->csv_data_file_id);
        $user = $request->user();

        $csv_data = json_decode($data->csv_data, true);
        $request->fields = array_flip($request->fields);

        if (isset($data->make_id)) {
            $make = Make::findOrFail($data->make_id);
        } elseif (isset($request->fields['make'])) {
            foreach ($csv_data as $row) {
                $make = Make::where('name', $row[$request->fields['make']])->first();
            }
        };
        if (isset($data->modele_id)) {
            $modele = Modele::findOrFail($data->modele_id);
        };
        if (isset($data->version_id)) {
            $version = Version::findOrFail($data->version_id);
        };
        if( isset($make) && isset($modele) && isset($version) ){
            $title = $make->name.' '.$modele->name.' '.$version->motor.' '.$version->description;
        };


        $count = count($csv_data);

        if (isset($request->fields['ref'])) {
            foreach ($csv_data as $row){
                $check_vin = $row[$request->fields['ref']];
                $check_vin = Car::where('vin', $check_vin)->first();
                if ($check_vin){
                    return redirect()->route('admin.cars.index')->with('message', trans('trans.vin-exist').' : '.$check_vin->vin);
                }
            }
        }

        if (isset($request->fields['code_color']) && isset($make)){
            foreach ($csv_data as $row){
                $code_colors[] = $row[$request->fields['code_color']];
            }
            foreach ($code_colors as $code){
                $colors[$code] = Color::where('code', $code)->where('make_id', $make->id)->first();
            }
            foreach ($colors as $key => $value){
                if ($value == null ){
                    if (!isset($modele)){
                        $modele = null;
                    }
                    $brands = Make::all();
                    $models = Modele::all();

                    return view('carImport.colors', compact('code_colors', 'colors', 'make','brands', 'modele','models', 'data'));
                }
            }
        }

        if (isset($request->fields['code_option']) && isset($make)){
        // if (isset($request->fields['code_option']) && isset($make) && isset($modele)){
            foreach ($csv_data as $row){
                $code_options['code_option'][] = $row[$request->fields['code_option']];
            }
            foreach ($code_options as $key => $value){
                $codes = $value;
                $codes = array_unique($codes);
            }
            $codes = implode(';', $codes);
            $codes = explode(';', $codes);
            $codes = array_unique($codes);

            foreach ($codes as $key => $code){
                // $options[$code] = Feature::where('code', $code)->where('make_id', $data->make_id)->where('modele_id', $data->modele_id)->first();
                $options[$code] = Feature::where('code', $code)->where('make_id', $data->make_id)->first();
            }

            foreach ($options as $key => $value) {
                if ($value == null) {
                    $brands = Make::all();
                    $models = Modele::all();

                    return view('carImport.options', compact('codes', 'options', 'make','brands', 'modele','models', 'data'));
                }
            }
        }

        foreach ($csv_data as $row) {
            if ($request->has('create-title')){
                if (isset($make) && !isset($modele)){
                    $title = $make->name.' '.$row[$request->fields['modele']].' '.$row[$request->fields['version']];
                } elseif (isset($make) && isset($modele)){
                    $title = $make->name.' '.$modele->name.' '.$row[$request->fields['version']];
                } else {
                    $title = $row[$request->fields['make']].' '.$row[$request->fields['modele']].' '.$row[$request->fields['version']];
                }
            }

            if (isset($title) || isset($request->fields['label']))
            {
                $stock = new Car();
                $stock->user_id = $user->id;
                $stock->entity_id            = $data->entity;
                $stock->seller_id         = $data->seller_id;
                $stock->draft             = $request->draft;
                $stock->qty               = $data->qty;
                if(isset($request->fields['ref'])){
                    $stock->vin           = $row[$request->fields['ref']];
                } else {
                    $faker = Faker::create();
                    $stock->vin = $faker->unique()->numberBetween(00000000000000000, 99999999999999999);
                };
                if(!isset($title)) {
                    $stock->name = $row[$request->fields['label']];
                } else {
                    $stock->name = $title;
                };
                if (isset($request->fields['note'])){
                    $stock->private_note      = $row[$request->fields['note']];
                };
                if (isset($request->fields['price'])){
                    if (isset($data->comseller) && $data->increasePrice == 1) {
                        $price = floatval($row[$request->fields['price']]);
                        $price = $price + $data->comseller;
                        $stock->price_ht       = $price;
                    } else {
                        $stock->price_ht       = $row[$request->fields['price']];
                    }
                };
                if (isset($request->fields['price_ttc'])){
                    $stock->price_ttc       = $row[$request->fields['price_ttc']];
                };
                if (isset($request->fields['cost_price'])){
                    $stock->cost_price       = $row[$request->fields['cost_price']];
                };
                $stock->import_key = 'IMPK-'.sprintf('%06d',$data->id);
                if (isset($request->fields['idv'])){
                    $stock->idv       = $row[$request->fields['idv']];
                };
                if (isset($request->fields['plates'])){
                    $stock->plates       = $row[$request->fields['plates']];
                };

                if(isset($make)) {
                    $stock->make = $make->name;
                } elseif (isset($request->fields['make'])) {
                    $stock->make       = $row[$request->fields['make']];
                };
                if(isset($modele)) {
                    $stock->modele = $modele->name;
                } elseif (isset($request->fields['modele'])) {
                    $stock->modele       = $row[$request->fields['modele']];
                };
                if(isset($version)) {
                    $stock->version_id = $version->id;
                };
                // if Version
                if(isset($version)) {
                    $stock->motor = $version->motor;
                } elseif (isset($request->fields['motor'])) {
                    $stock->motor       = $row[$request->fields['motor']];
                };
                if(isset($version)) {
                    $stock->energy = $version->energy;
                } elseif (isset($request->fields['energy'])) {
                    $stock->energy       = $row[$request->fields['energy']];
                };
                if(isset($version)) {
                    $stock->gear = $version->gear;
                } elseif (isset($request->fields['gear'])) {
                    $stock->gear       = $row[$request->fields['gear']];
                };
                if(isset($version)) {
                    $stock->co_2 = $version->co_2;
                } elseif (isset($request->fields['co2'])) {
                    $stock->co_2       = $row[$request->fields['co2']];
                };
                if(isset($version)) {
                    $stock->serie = $version->equipment;
                }
                if(isset($version)) {
                    $stock->ch = $version->ch;
                };
                if(isset($version)) {
                    $stock->conso = $version->conso;
                };
                if(isset($version)) {
                    $stock->price_new = $version->prix;
                };
                // End if version

                if (isset($request->fields['mec'])){
                    $mec = date_excel($row[$request->fields['mec']]);
                    $stock->mec       = Carbon::parse($mec)->format('d/m/Y');
                    // $stock->mec       = date_excel($row[$request->fields['mec']]);
                };
                if (isset($request->fields['kms'])){
                    $stock->kms       = $row[$request->fields['kms']];
                };
                if (isset($request->fields['code_color']) ){
                    if ( isset($make) || isset($row[$request->fields['make']])){
                        $code_colors       = $row[$request->fields['code_color']];
                        $color = Color::where('code', $code_colors)
                            ->where('make_id', $make->id)
                            ->first();
                        if($color){
                            $stock->color = $color->name;
                        }
                    } else {
                        return back()->with('error', 'la couleur '.$code_colors.' n\'existe pas');
                    }
                };
                if (isset($request->fields['color'])){
                    $stock->color       = $row[$request->fields['color']];
                };
                if (isset($request->fields['interior'])){
                    $stock->interior       = $row[$request->fields['interior']];
                };
                if (isset($request->fields['features'])){
                    $stock->feature       = $row[$request->fields['features']];
                };

                if (isset($request->fields['code_option']) && (isset($make) || isset($row[$request->fields['make']])) && (isset($modele) || isset($row[$request->fields['modele']]))){
                    // Remove all data to array
                    $options = [];
                    $features = [];
                    // Convert to array from string
                    $codes = $row[$request->fields['code_option']];
                    $codes = explode(';', $codes);
                    $codes = array_unique($codes);

                    // Search code
                    foreach ($codes as $code){
                        $options[] = Feature::where('code', $code)->where('make_id', $make->id)->first();
                        // $options[] = Feature::where('code', $code)->where('make_id', $make->id)->where('modele_id', $modele->id)->first();
                        // $options = array_unique($options);
                    }
                    return $options;
                    // Convert to string
                    if($options){
                        foreach ($options as $key => $option) {
                            $features[] = $option->name;
                        }
                        $features = array_filter($features, function($a) { return ($a !== 'null'); });
                        $features = implode(' + ', $features);

                        $stock->feature = $features;

                    }
                };
                $stock->dispo = to_date($data->dispo);
                if (isset($request->fields['dispoPlace'])){
                    $stock->warehouse       = $row[$request->fields['dispoPlace']];
                };
                if (isset($request->fields['frevo'])){
                    $stock->frevo       = $row[$request->fields['frevo']];
                };
                if (isset($request->fields['real_frevo'])){
                    $stock->real_frevo       = $row[$request->fields['real_frevo']];
                };
                if (isset($request->fields['link_frevo'])){
                    $stock->link_frevo      = $row[$request->fields['link_frevo']];
                };
                if (isset($request->fields['comseller'])){
                    $stock->comseller       = $row[$request->fields['comseller']];
                } else {
                    $stock->comseller       = $data->comseller;
                };
                // return $stock;
                $stock->save();


                $message = '{{ Registered_successfully }}';
            };
        }
        if (empty($message)){
            return back()->with('error', 'putain de merde');
        }

        $message = 'Download '.$count.' cars done !';
        return redirect()->route('admin.cars.index')->with('message', $message);
    }

    public function codeColor(Request $request)
    {
        $csv_data_file = CsvData::find($request->csv_data_id);
        $csv_header_fields = [];
        $csv_data = $csv_data_file->csv_data;
        $csv_data = json_decode($csv_data, true);
        $csv_data = array_slice($csv_data,0, 5);
        $make = Make::findOrFail($csv_data_file->make_id);
        $modele = Modele::findOrFail($csv_data_file->modele_id);
        $version = $csv_data_file->version_id;

        $names = $request->input('name', []);
        $codes = $request->input('code', []);
        $makes = $request->input('make', []);
        $modeles = $request->input('modele', []);

        foreach ($names as $key => $name){
            $color = new Color();
            $color->name = Str::upper($name);
            $color->code = isset($codes[$key]) ? Str::upper($codes[$key]) : '';
            $color->make_id = isset($makes[$key]) ? $makes[$key] : '';
            $color->modele_id = isset($modeles[$key]) ? $modeles[$key] : '';
            $color->save();
        };

        return view('carImport.parseInput', compact( 'csv_data', 'csv_data_file', 'csv_header_fields','make', 'modele', 'version'));
    }

    public function codeOptions(Request $request)
    {
        $csv_data_file = CsvData::find($request->csv_data_id);
        $csv_header_fields = [];
        $csv_data = $csv_data_file->csv_data;
        $csv_data = json_decode($csv_data, true);
        $csv_data = array_slice($csv_data,0, 5);
        $make = Make::findOrFail($csv_data_file->make_id);
        $modele = Modele::findOrFail($csv_data_file->modele_id);
        $version = $csv_data_file->version_id;

        // $validator = Validator::make($request->all(), [
        //     'name'      => 'required|string',
        //     'code'      => 'required|string',
        //     'image'     => 'nullable|string',
        //     'make'      => 'required|integer',
        //     'modele'    => 'nullable|integer',
        // ]);
        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput();
        // }

        $names = $request->input('name', []);
        $codes = $request->input('code', []);
        $descriptions = $request->input('description', []);
        $makes = $request->input('make', []);
        $modeles = $request->input('modele', []);

        foreach ($names as $key => $name){
            $color = new Feature();
            $color->name = Str::upper($name);
            $color->code = isset($codes[$key]) ? Str::upper($codes[$key]) : '';
            $color->description = isset($descriptions[$key]) ? Str::upper($descriptions[$key]) : '';
            $color->make_id = isset($makes[$key]) ? $makes[$key] : '';
            $color->modele_id = isset($modeles[$key]) ? $modeles[$key] : '';
            $color->save();
        };

        return view('carImport.parseInput', compact( 'csv_data', 'csv_data_file', 'csv_header_fields','make', 'modele', 'version'));
    }
}
