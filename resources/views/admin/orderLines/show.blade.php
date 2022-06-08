@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.orderLine.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.order-lines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.id') }}
                        </th>
                        <td>
                            {{ $orderLine->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.order') }}
                        </th>
                        <td>
                            {{ $orderLine->order->ref ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.product') }}
                        </th>
                        <td>
                            {{ $orderLine->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.service') }}
                        </th>
                        <td>
                            {{ $orderLine->service->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.vehicle') }}
                        </th>
                        <td>
                            {{ $orderLine->vehicle->vin ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.name') }}
                        </th>
                        <td>
                            {{ $orderLine->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.description') }}
                        </th>
                        <td>
                            {{ $orderLine->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.qty') }}
                        </th>
                        <td>
                            {{ $orderLine->qty }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.tva_tx') }}
                        </th>
                        <td>
                            {{ $orderLine->tva_tx }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.remise_percent') }}
                        </th>
                        <td>
                            {{ $orderLine->remise_percent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.remise') }}
                        </th>
                        <td>
                            {{ $orderLine->remise }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.total_ht') }}
                        </th>
                        <td>
                            {{ $orderLine->total_ht }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.total_tva') }}
                        </th>
                        <td>
                            {{ $orderLine->total_tva }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.total_ttc') }}
                        </th>
                        <td>
                            {{ $orderLine->total_ttc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.cost_price') }}
                        </th>
                        <td>
                            {{ $orderLine->cost_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.comclient') }}
                        </th>
                        <td>
                            {{ $orderLine->comclient }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orderLine.fields.status') }}
                        </th>
                        <td>
                            {{ $orderLine->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.order-lines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection