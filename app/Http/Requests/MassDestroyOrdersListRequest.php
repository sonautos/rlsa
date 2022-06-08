<?php

namespace App\Http\Requests;

use App\Models\OrdersList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOrdersListRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('orders_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:orders_lists,id',
        ];
    }
}
