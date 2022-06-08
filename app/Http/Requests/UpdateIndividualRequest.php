<?php

namespace App\Http\Requests;

use App\Models\Individual;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateIndividualRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('individual_edit');
    }

    public function rules()
    {
        return [
            'entity_id'      => [
                'required',
                'integer',
            ],
            'firstname'      => [
                'string',
                'nullable',
            ],
            'lastname'       => [
                'string',
                'required',
            ],
            'address'        => [
                'string',
                'nullable',
            ],
            'address_2'      => [
                'string',
                'nullable',
            ],
            'zip'            => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'city'           => [
                'string',
                'nullable',
            ],
            'state'          => [
                'string',
                'nullable',
            ],
            'country'        => [
                'string',
                'nullable',
            ],
            'poste'          => [
                'string',
                'nullable',
            ],
            'phone'          => [
                'string',
                'nullable',
            ],
            'mobile'         => [
                'string',
                'nullable',
            ],
            'user_create_id' => [
                'required',
                'integer',
            ],
            'user_modif_id'  => [
                'required',
                'integer',
            ],
            'tags.*'         => [
                'integer',
            ],
            'tags'           => [
                'array',
            ],
            'latitude'       => [
                'string',
                'nullable',
            ],
            'longitude'      => [
                'string',
                'nullable',
            ],
            'url_place'      => [
                'string',
                'nullable',
            ],
        ];
    }
}
