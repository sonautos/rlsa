<?php

namespace App\Http\Requests;

use App\Models\ProformaList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProformaListRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('proforma_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:proforma_lists,id',
        ];
    }
}
