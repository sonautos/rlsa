@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.shippLine.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shipp-lines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.id') }}
                        </th>
                        <td>
                            {{ $shippLine->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.seller') }}
                        </th>
                        <td>
                            {{ $shippLine->seller->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.client') }}
                        </th>
                        <td>
                            {{ $shippLine->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.modele') }}
                        </th>
                        <td>
                            {{ $shippLine->modele }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.vehicle') }}
                        </th>
                        <td>
                            {{ $shippLine->vehicle->vin ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.vin') }}
                        </th>
                        <td>
                            {{ $shippLine->vin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.color') }}
                        </th>
                        <td>
                            {{ $shippLine->color }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.plates') }}
                        </th>
                        <td>
                            {{ $shippLine->plates }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.loading_place') }}
                        </th>
                        <td>
                            {{ $shippLine->loading_place }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.delivery_place') }}
                        </th>
                        <td>
                            {{ $shippLine->delivery_place }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.cmr_date') }}
                        </th>
                        <td>
                            {{ $shippLine->cmr_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.status') }}
                        </th>
                        <td>
                            {{ $shippLine->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.price') }}
                        </th>
                        <td>
                            {{ $shippLine->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.paid') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $shippLine->paid ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.shippment') }}
                        </th>
                        <td>
                            {{ $shippLine->shippment->ref ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.user') }}
                        </th>
                        <td>
                            {{ $shippLine->user->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippLine.fields.order') }}
                        </th>
                        <td>
                            {{ $shippLine->order->ref ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shipp-lines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection