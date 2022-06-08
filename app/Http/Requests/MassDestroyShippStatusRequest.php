<?php

namespace App\Http\Requests;

use App\Models\ShippStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyShippStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('shipp_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:shipp_statuses,id',
        ];
    }
}
