<?php

namespace App\Http\Requests;

use App\Models\CodeModel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCodeModelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('code_model_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:code_models,id',
        ];
    }
}
