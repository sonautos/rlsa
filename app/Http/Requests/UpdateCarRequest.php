<?php

namespace App\Http\Requests;

use App\Models\Car;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('car_edit');
    }

    public function rules()
    {
        return [
            'entity_id'         => [
                'required',
                'integer',
            ],
            'country'           => [
                'string',
                'nullable',
            ],
            'categories.*'      => [
                'integer',
            ],
            'categories'        => [
                'array',
            ],
            'vin'               => [
                'string',
                'min:17',
                'max:17',
                'required',
                'unique:cars,vin,' . request()->route('car')->id,
            ],
            'plates'            => [
                'string',
                'nullable',
            ],
            'idv'               => [
                'string',
                'nullable',
            ],
            'name'              => [
                'string',
                'required',
            ],
            'description'       => [
                'string',
                'nullable',
            ],
            'private_note'      => [
                'string',
                'nullable',
            ],
            'make'              => [
                'string',
                'nullable',
            ],
            'modele'            => [
                'string',
                'nullable',
            ],
            'motor'             => [
                'string',
                'nullable',
            ],
            'ch'                => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'co_2'              => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'energy'            => [
                'string',
                'nullable',
            ],
            'gear'              => [
                'string',
                'nullable',
            ],
            'conso'             => [
                'numeric',
                'max:100',
            ],
            'mec'               => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'kms'               => [
                'numeric',
            ],
            'color'             => [
                'string',
                'nullable',
            ],
            'interior'          => [
                'string',
                'nullable',
            ],
            'link_frevo'        => [
                'string',
                'nullable',
            ],
            'last_price_update' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'qty'               => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'dispo'             => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'warehouse'         => [
                'string',
                'nullable',
            ],
            'import_key'        => [
                'string',
                'nullable',
            ],
            'tags.*'            => [
                'integer',
            ],
            'tags'              => [
                'array',
            ],
        ];
    }
}
