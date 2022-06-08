<?php

namespace App\Http\Requests;

use App\Models\Feature;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFeatureRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('feature_edit');
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
