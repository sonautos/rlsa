<?php

namespace App\Http\Requests;

use App\Models\ShippLine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreShippLineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shipp_line_create');
    }

    public function rules()
    {
        return [
            'seller_id'      => [
                'required',
                'integer',
            ],
            'modele'         => [
                'string',
                'required',
            ],
            'vin'            => [
                'string',
                'max:17',
                'required',
            ],
            'color'          => [
                'string',
                'nullable',
            ],
            'plates'         => [
                'string',
                'nullable',
            ],
            'loading_place'  => [
                'string',
                'required',
            ],
            'delivery_place' => [
                'string',
                'required',
            ],
            'cmr_date'       => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'status_id'      => [
                'required',
                'integer',
            ],
            'shippment_id'   => [
                'required',
                'integer',
            ],
            'user_id'        => [
                'required',
                'integer',
            ],
        ];
    }
}
