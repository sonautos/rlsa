<?php

namespace App\Http\Requests;

use App\Models\ShippingMethod;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateShippingMethodRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shipping_method_edit');
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
