@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.invoicesList.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.invoices-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.id') }}
                        </th>
                        <td>
                            {{ $invoicesList->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.ref') }}
                        </th>
                        <td>
                            {{ $invoicesList->ref }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.entity') }}
                        </th>
                        <td>
                            {{ $invoicesList->entity->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.seller') }}
                        </th>
                        <td>
                            {{ $invoicesList->seller->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.client') }}
                        </th>
                        <td>
                            {{ $invoicesList->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.task') }}
                        </th>
                        <td>
                            {{ $invoicesList->task->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.date_created') }}
                        </th>
                        <td>
                            {{ $invoicesList->date_created }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.date_valid') }}
                        </th>
                        <td>
                            {{ $invoicesList->date_valid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.author') }}
                        </th>
                        <td>
                            {{ $invoicesList->author->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.valid') }}
                        </th>
                        <td>
                            {{ $invoicesList->valid->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.user_updated') }}
                        </th>
                        <td>
                            {{ $invoicesList->user_updated->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.status') }}
                        </th>
                        <td>
                            {{ $invoicesList->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.total_ht') }}
                        </th>
                        <td>
                            {{ $invoicesList->total_ht }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.tva') }}
                        </th>
                        <td>
                            {{ $invoicesList->tva }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.total_ttc') }}
                        </th>
                        <td>
                            {{ $invoicesList->total_ttc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.remise') }}
                        </th>
                        <td>
                            {{ $invoicesList->remise }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.remise_percent') }}
                        </th>
                        <td>
                            {{ $invoicesList->remise_percent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.cond_reglement') }}
                        </th>
                        <td>
                            {{ $invoicesList->cond_reglement->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.mode_reglement') }}
                        </th>
                        <td>
                            {{ $invoicesList->mode_reglement->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.note_private') }}
                        </th>
                        <td>
                            {{ $invoicesList->note_private }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.note_public') }}
                        </th>
                        <td>
                            {{ $invoicesList->note_public }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.date_livraison') }}
                        </th>
                        <td>
                            {{ $invoicesList->date_livraison }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.shipping_method') }}
                        </th>
                        <td>
                            {{ $invoicesList->shipping_method->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.delivery_address') }}
                        </th>
                        <td>
                            {{ $invoicesList->delivery_address->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoicesList.fields.paid') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $invoicesList->paid ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.invoices-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection