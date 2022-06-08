<?php

namespace App\Http\Requests;

use App\Models\Individual;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIndividualRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('individual_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:individuals,id',
        ];
    }
}
