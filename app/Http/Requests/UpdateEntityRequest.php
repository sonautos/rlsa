<?php

namespace App\Http\Requests;

use App\Models\Entity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEntityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('entity_edit');
    }

    public function rules()
    {
        return [
            'name'          => [
                'string',
                'required',
            ],
            'alias'         => [
                'string',
                'nullable',
            ],
            'supplier'      => [
                'required',
            ],
            'status'        => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'parent'        => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'code_client'   => [
                'string',
                'nullable',
            ],
            'code_supplier' => [
                'string',
                'nullable',
            ],
            'address'       => [
                'string',
                'required',
            ],
            'address_2'     => [
                'string',
                'nullable',
            ],
            'zip'           => [
                'string',
                'required',
            ],
            'city'          => [
                'string',
                'required',
            ],
            'state'         => [
                'string',
                'nullable',
            ],
            'country'       => [
                'string',
                'nullable',
            ],
            'latitude'      => [
                'string',
                'nullable',
            ],
            'longitude'     => [
                'string',
                'nullable',
            ],
            'url_place'     => [
                'string',
                'nullable',
            ],
            'phone'         => [
                'string',
                'nullable',
            ],
            'email'         => [
                'required',
            ],
            'siren'         => [
                'string',
                'nullable',
            ],
            'siret'         => [
                'string',
                'nullable',
            ],
            'ape'           => [
                'string',
                'nullable',
            ],
            'vatnumber'     => [
                'string',
                'required',
            ],
        ];
    }
}
