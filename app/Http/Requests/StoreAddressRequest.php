<?php

namespace App\Http\Requests;

use App\Models\Address;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAddressRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('address_create');
    }

    public function rules()
    {
        return [
            'entity_id'      => [
                'required',
                'integer',
            ],
            'fonction'       => [
                'string',
                'nullable',
            ],
            'name'           => [
                'string',
                'nullable',
            ],
            'address'        => [
                'string',
                'nullable',
            ],
            'address_2'      => [
                'string',
                'nullable',
            ],
            // 'zip'            => [
            //     'nullable',
            //     'integer',
            //     'min:-2147483648',
            //     'max:2147483647',
            // ],
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
