<?php

namespace App\Http\Requests;

use App\Models\CondReglement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCondReglementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cond_reglement_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
