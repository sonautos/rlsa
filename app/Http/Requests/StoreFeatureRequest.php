<?php

namespace App\Http\Requests;

use App\Models\Feature;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFeatureRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('feature_create');
    }

    public function rules()
    {
        return [
            'make_id'   => [
                'required',
                'integer',
            ],
            'modele_id' => [
                'required',
                'integer',
            ],
            'code'      => [
                'string',
                'required',
            ],
            'name'      => [
                'required',
            ],
        ];
    }
}
