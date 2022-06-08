@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.proformaList.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.proforma-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.id') }}
                        </th>
                        <td>
                            {{ $proformaList->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.ref') }}
                        </th>
                        <td>
                            {{ $proformaList->ref }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.entity') }}
                        </th>
                        <td>
                            {{ $proformaList->entity->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.seller') }}
                        </th>
                        <td>
                            {{ $proformaList->seller->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.client') }}
                        </th>
                        <td>
                            {{ $proformaList->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.task') }}
                        </th>
                        <td>
                            {{ $proformaList->task->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.date_created') }}
                        </th>
                        <td>
                            {{ $proformaList->date_created }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.date_valid') }}
                        </th>
                        <td>
                            {{ $proformaList->date_valid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.author') }}
                        </th>
                        <td>
                            {{ $proformaList->author->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.valid') }}
                        </th>
                        <td>
                            {{ $proformaList->valid->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.user_updated') }}
                        </th>
                        <td>
                            {{ $proformaList->user_updated->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.status') }}
                        </th>
                        <td>
                            {{ $proformaList->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.total_ht') }}
                        </th>
                        <td>
                            {{ $proformaList->total_ht }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.tva') }}
                        </th>
                        <td>
                            {{ $proformaList->tva }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.total_ttc') }}
                        </th>
                        <td>
                            {{ $proformaList->total_ttc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.remise') }}
                        </th>
                        <td>
                            {{ $proformaList->remise }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.remise_percent') }}
                        </th>
                        <td>
                            {{ $proformaList->remise_percent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.cond_reglement') }}
                        </th>
                        <td>
                            {{ $proformaList->cond_reglement->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.mode_reglement') }}
                        </th>
                        <td>
                            {{ $proformaList->mode_reglement->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.note_private') }}
                        </th>
                        <td>
                            {{ $proformaList->note_private }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.note_public') }}
                        </th>
                        <td>
                            {{ $proformaList->note_public }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.date_livraison') }}
                        </th>
                        <td>
                            {{ $proformaList->date_livraison }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.shipping_method') }}
                        </th>
                        <td>
                            {{ $proformaList->shipping_method->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.delivery_address') }}
                        </th>
                        <td>
                            {{ $proformaList->delivery_address->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaList.fields.paid') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $proformaList->paid ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.proforma-lists.index') }}">
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
            <a class="nav-link" href="#proforma_proforma_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.proformaLine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#proforma_invoice_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.invoiceLine.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="proforma_proforma_lines">
            @includeIf('admin.proformaLists.relationships.proformaProformaLines', ['proformaLines' => $proformaList->proformaProformaLines])
        </div>
        <div class="tab-pane" role="tabpanel" id="proforma_invoice_lines">
            @includeIf('admin.proformaLists.relationships.proformaInvoiceLines', ['invoiceLines' => $proformaList->proformaInvoiceLines])
        </div>
    </div>
</div>

@endsection
