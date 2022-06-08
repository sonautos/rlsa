<?php

namespace App\Http\Requests;

use App\Models\Shippmentslist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateShippmentslistRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shippmentslist_edit');
    }

    public function rules()
    {
        return [
            'ref'           => [
                'string',
                'required',
                'unique:shippmentslists,ref,' . request()->route('shippmentslist')->id,
            ],
            'entity_id'     => [
                'required',
                'integer',
            ],
            'status_id'     => [
                'required',
                'integer',
            ],
            'user_id'       => [
                'required',
                'integer',
            ],
            'date_delivery' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
