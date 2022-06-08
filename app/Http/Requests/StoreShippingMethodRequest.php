<?php

namespace App\Http\Requests;

use App\Models\ShippingMethod;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreShippingMethodRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shipping_method_create');
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
