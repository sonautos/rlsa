<?php

namespace App\Http\Requests;

use App\Models\Truck;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTruckRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('truck_create');
    }

    public function rules()
    {
        return [
            'plates'    => [
                'string',
                'nullable',
            ],
            'chauffeur' => [
                'string',
                'nullable',
            ],
            'date_load' => [
                'string',
                'nullable',
            ],
            'date_cmr'  => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'status'    => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
