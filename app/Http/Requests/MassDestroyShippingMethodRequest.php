<?php

namespace App\Http\Requests;

use App\Models\ShippingMethod;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyShippingMethodRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('shipping_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:shipping_methods,id',
        ];
    }
}
