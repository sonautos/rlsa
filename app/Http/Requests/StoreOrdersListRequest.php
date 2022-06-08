<?php

namespace App\Http\Requests;

use App\Models\OrdersList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrdersListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('orders_list_create');
    }

    public function rules()
    {
        return [
            'ref'            => [
                'string',
                'required',
                'unique:orders_lists',
            ],
            'entity_id'      => [
                'required',
                'integer',
            ],
            'seller_id'      => [
                'required',
                'integer',
            ],
            'client_id'      => [
                'required',
                'integer',
            ],
            'date_created'   => [
                'required',
                'date',
                // 'date_format:' . config('panel.date_format'),
            ],
            'date_valid'     => [
                'date',
                // 'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'author_id'      => [
                'required',
                'integer',
            ],
            'remise_percent' => [
                'numeric',
            ],
            'date_livraison' => [
                'date',
                // 'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
