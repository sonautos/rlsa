<?php

namespace App\Http\Requests;

use App\Models\TagContact;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTagContactRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tag_contact_create');
    }

    public function rules()
    {
        return [
            'tag' => [
                'string',
                'required',
                'unique:tag_contacts',
            ],
        ];
    }
}
