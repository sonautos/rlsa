<?php

namespace App\Http\Requests;

use App\Models\ShippStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateShippStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shipp_status_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
