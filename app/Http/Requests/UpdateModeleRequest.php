<?php

namespace App\Http\Requests;

use App\Models\Modele;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateModeleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('modele_edit');
    }

    public function rules()
    {
        return [
            'name'    => [
                'string',
                'required',
            ],
            'slug'    => [
                'string',
                'nullable',
            ],
            'make_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
