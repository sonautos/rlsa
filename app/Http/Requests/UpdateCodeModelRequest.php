<?php

namespace App\Http\Requests;

use App\Models\CodeModel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCodeModelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('code_model_edit');
    }

    public function rules()
    {
        return [
            'code'       => [
                'string',
                'required',
                'unique:code_models,code,' . request()->route('code_model')->id,
            ],
            'make_id'    => [
                'required',
                'integer',
            ],
            'modele_id'  => [
                'required',
                'integer',
            ],
            'version_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
