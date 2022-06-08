<?php

namespace App\Http\Requests;

use App\Models\ShippStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreShippStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shipp_status_create');
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
