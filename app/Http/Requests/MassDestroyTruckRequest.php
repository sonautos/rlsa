<?php

namespace App\Http\Requests;

use App\Models\Truck;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTruckRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('truck_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:trucks,id',
        ];
    }
}
