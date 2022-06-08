<?php

namespace App\Http\Requests;

use App\Models\Make;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMakeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('make_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:0',
                'max:255',
                'required',
            ],
            'slug' => [
                'string',
                'required',
                'unique:makes',
            ],
        ];
    }
}
