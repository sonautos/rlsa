@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.proformaLine.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.proforma-lines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.id') }}
                        </th>
                        <td>
                            {{ $proformaLine->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.proforma') }}
                        </th>
                        <td>
                            {{ $proformaLine->proforma->ref ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.product') }}
                        </th>
                        <td>
                            {{ $proformaLine->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.service') }}
                        </th>
                        <td>
                            {{ $proformaLine->service->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.vehicle') }}
                        </th>
                        <td>
                            {{ $proformaLine->vehicle->vin ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.name') }}
                        </th>
                        <td>
                            {{ $proformaLine->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.description') }}
                        </th>
                        <td>
                            {{ $proformaLine->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.qty') }}
                        </th>
                        <td>
                            {{ $proformaLine->qty }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.tva_tx') }}
                        </th>
                        <td>
                            {{ $proformaLine->tva_tx }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.remise_percent') }}
                        </th>
                        <td>
                            {{ $proformaLine->remise_percent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.remise') }}
                        </th>
                        <td>
                            {{ $proformaLine->remise }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.total_ht') }}
                        </th>
                        <td>
                            {{ $proformaLine->total_ht }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.total_tva') }}
                        </th>
                        <td>
                            {{ $proformaLine->total_tva }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.total_ttc') }}
                        </th>
                        <td>
                            {{ $proformaLine->total_ttc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.cost_price') }}
                        </th>
                        <td>
                            {{ $proformaLine->cost_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.comclient') }}
                        </th>
                        <td>
                            {{ $proformaLine->comclient }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proformaLine.fields.status') }}
                        </th>
                        <td>
                            {{ $proformaLine->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.proforma-lines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection