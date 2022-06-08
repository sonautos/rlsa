<?php

namespace App\Http\Requests;

use App\Models\OrderLine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrderLineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_line_edit');
    }

    public function rules()
    {
        return [
            'order_id'       => [
                'required',
                'integer',
            ],
            'name'           => [
                'string',
                'required',
            ],
            'description'    => [
                'string',
                'nullable',
            ],
            'qty'            => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'tva_tx'         => [
                'numeric',
            ],
            'remise_percent' => [
                'numeric',
            ],
        ];
    }
}
