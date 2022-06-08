<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Modele;
use App\Models\Version;
use Illuminate\Http\Request;

class GetCarApiController extends Controller
{
    public function get_by_make(Request $request)
    {
        abort_unless(\Gate::allows('modele_access'), 401);

        if (!$request->make_id) {
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
        } else {
            $html = '';
            $modeles = Modele::where('make_id', $request->make_id)->get();
            foreach ($modeles as $modele) {
                $html .= '<option value="'.$modele->id.'">'.$modele->name.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }
    public function get_by_modele(Request $request)
    {
        abort_unless(\Gate::allows('modele_access'), 401);

        if (!$request->modele_id) {
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
        } else {
            $html = '';
            $versions = Version::where('modele_id', $request->modele_id)->get();
            foreach ($versions as $version) {
                $html .= '<option value="">'.trans('global.pleaseSelect').'</option><option value="'.$version->id.'">'.$version->description.' '.$version->motor.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }

    public function get_by_version(Request $request)
    {
        abort_unless(\Gate::allows('modele_access'), 401);

        if (!$request->version_id) {
            $specs = '';
        } else {
            $specs = '';
            $specs = Version::where("id",$request->version_id)->get();
        }

        return response()->json($specs);
    }
}
