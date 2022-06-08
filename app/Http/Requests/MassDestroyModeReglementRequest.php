<?php

namespace App\Http\Requests;

use App\Models\ModeReglement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyModeReglementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('mode_reglement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:mode_reglements,id',
        ];
    }
}
