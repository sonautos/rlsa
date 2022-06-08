<?php

namespace App\Http\Requests;

use App\Models\InvoiceLine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInvoiceLineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('invoice_line_edit');
    }

    public function rules()
    {
        return [
            'proforma_id'    => [
                'required',
                'integer',
            ],
            'name'           => [
                'string',
                'required',
            ],
            'description'    => [
                'string',
                'nullable',
            ],
            'qty'            => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'tva_tx'         => [
                'numeric',
            ],
            'remise_percent' => [
                'numeric',
            ],
        ];
    }
}
