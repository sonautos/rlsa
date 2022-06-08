@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.invoiceLine.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.invoice-lines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.id') }}
                        </th>
                        <td>
                            {{ $invoiceLine->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.proforma') }}
                        </th>
                        <td>
                            {{ $invoiceLine->proforma->ref ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.product') }}
                        </th>
                        <td>
                            {{ $invoiceLine->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.service') }}
                        </th>
                        <td>
                            {{ $invoiceLine->service->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.vehicle') }}
                        </th>
                        <td>
                            {{ $invoiceLine->vehicle->vin ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.name') }}
                        </th>
                        <td>
                            {{ $invoiceLine->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.description') }}
                        </th>
                        <td>
                            {{ $invoiceLine->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.qty') }}
                        </th>
                        <td>
                            {{ $invoiceLine->qty }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.tva_tx') }}
                        </th>
                        <td>
                            {{ $invoiceLine->tva_tx }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.remise_percent') }}
                        </th>
                        <td>
                            {{ $invoiceLine->remise_percent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.remise') }}
                        </th>
                        <td>
                            {{ $invoiceLine->remise }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.total_ht') }}
                        </th>
                        <td>
                            {{ $invoiceLine->total_ht }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.total_tva') }}
                        </th>
                        <td>
                            {{ $invoiceLine->total_tva }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.total_ttc') }}
                        </th>
                        <td>
                            {{ $invoiceLine->total_ttc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.cost_price') }}
                        </th>
                        <td>
                            {{ $invoiceLine->cost_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.comclient') }}
                        </th>
                        <td>
                            {{ $invoiceLine->comclient }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceLine.fields.status') }}
                        </th>
                        <td>
                            {{ $invoiceLine->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.invoice-lines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection