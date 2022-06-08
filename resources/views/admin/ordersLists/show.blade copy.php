@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ordersList.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orders-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.id') }}
                        </th>
                        <td>
                            {{ $ordersList->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.ref') }}
                        </th>
                        <td>
                            {{ $ordersList->ref }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.entity') }}
                        </th>
                        <td>
                            {{ $ordersList->entity->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.seller') }}
                        </th>
                        <td>
                            {{ $ordersList->seller->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.client') }}
                        </th>
                        <td>
                            {{ $ordersList->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.task') }}
                        </th>
                        <td>
                            {{ $ordersList->task->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.date_created') }}
                        </th>
                        <td>
                            {{ $ordersList->date_created }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.date_valid') }}
                        </th>
                        <td>
                            {{ $ordersList->date_valid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.author') }}
                        </th>
                        <td>
                            {{ $ordersList->author->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.valid') }}
                        </th>
                        <td>
                            {{ $ordersList->valid->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.user_updated') }}
                        </th>
                        <td>
                            {{ $ordersList->user_updated->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.status') }}
                        </th>
                        <td>
                            {{ $ordersList->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.total_ht') }}
                        </th>
                        <td>
                            {{ $ordersList->total_ht }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.tva') }}
                        </th>
                        <td>
                            {{ $ordersList->tva }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.total_ttc') }}
                        </th>
                        <td>
                            {{ $ordersList->total_ttc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.remise') }}
                        </th>
                        <td>
                            {{ $ordersList->remise }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.remise_percent') }}
                        </th>
                        <td>
                            {{ $ordersList->remise_percent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.cond_reglement') }}
                        </th>
                        <td>
                            {{ $ordersList->cond_reglement->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.mode_reglement') }}
                        </th>
                        <td>
                            {{ $ordersList->mode_reglement->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.note_private') }}
                        </th>
                        <td>
                            {{ $ordersList->note_private }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.note_public') }}
                        </th>
                        <td>
                            {{ $ordersList->note_public }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.date_livraison') }}
                        </th>
                        <td>
                            {{ $ordersList->date_livraison }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.shipping_method') }}
                        </th>
                        <td>
                            {{ $ordersList->shipping_method->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.delivery_address') }}
                        </th>
                        <td>
                            {{ $ordersList->delivery_address->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ordersList.fields.signed') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $ordersList->signed ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orders-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#order_shipp_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.shippLine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#order_order_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.orderLine.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="order_shipp_lines">
            @includeIf('admin.ordersLists.relationships.orderShippLines', ['shippLines' => $ordersList->orderShippLines])
        </div>
        <div class="tab-pane" role="tabpanel" id="order_order_lines">
            @includeIf('admin.ordersLists.relationships.orderOrderLines', ['orderLines' => $ordersList->orderOrderLines])
        </div>
    </div>
</div>

@endsection