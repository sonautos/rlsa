<?php

namespace App\Http\Requests;

use App\Models\ShippLine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyShippLineRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('shipp_line_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:shipp_lines,id',
        ];
    }
}
