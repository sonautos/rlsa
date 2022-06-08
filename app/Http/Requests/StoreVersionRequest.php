<?php

namespace App\Http\Requests;

use App\Models\Version;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVersionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('version_create');
    }

    public function rules()
    {
        return [
            'description' => [
                'string',
                'required',
            ],
            'slug'        => [
                'string',
                'nullable',
                'unique:versions',
            ],
            'motor'       => [
                'string',
                'required',
            ],
            'equipment'   => [
                'required',
            ],
            'kw'          => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'ch'          => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'co_2'        => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'conso'       => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'make_id'     => [
                'required',
                'integer',
            ],
            'modele_id'   => [
                'required',
                'integer',
            ],
        ];
    }
}
