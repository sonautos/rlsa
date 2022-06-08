<?php

namespace App\Http\Requests;

use App\Models\CondReglement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCondReglementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cond_reglement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cond_reglements,id',
        ];
    }
}
