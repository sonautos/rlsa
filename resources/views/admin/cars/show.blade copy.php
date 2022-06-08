@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.car.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.id') }}
                        </th>
                        <td>
                            {{ $car->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.user') }}
                        </th>
                        <td>
                            {{ $car->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.entity') }}
                        </th>
                        <td>
                            {{ $car->entity->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.seller') }}
                        </th>
                        <td>
                            {{ $car->seller->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.country') }}
                        </th>
                        <td>
                            {{ $car->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.categorie') }}
                        </th>
                        <td>
                            @foreach($car->categories as $key => $categorie)
                                <span class="label label-info">{{ $categorie->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.vin') }}
                        </th>
                        <td>
                            {{ $car->vin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.plates') }}
                        </th>
                        <td>
                            {{ $car->plates }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.idv') }}
                        </th>
                        <td>
                            {{ $car->idv }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.name') }}
                        </th>
                        <td>
                            {{ $car->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.description') }}
                        </th>
                        <td>
                            {{ $car->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.private_note') }}
                        </th>
                        <td>
                            {{ $car->private_note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.code_model') }}
                        </th>
                        <td>
                            {{ $car->code_model->code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.make') }}
                        </th>
                        <td>
                            {{ $car->make }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.modele') }}
                        </th>
                        <td>
                            {{ $car->modele }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.version') }}
                        </th>
                        <td>
                            {{ $car->version->description ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.motor') }}
                        </th>
                        <td>
                            {{ $car->motor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.ch') }}
                        </th>
                        <td>
                            {{ $car->ch }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.co_2') }}
                        </th>
                        <td>
                            {{ $car->co_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.energy') }}
                        </th>
                        <td>
                            {{ $car->energy }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.gear') }}
                        </th>
                        <td>
                            {{ $car->gear }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.conso') }}
                        </th>
                        <td>
                            {{ $car->conso }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.image') }}
                        </th>
                        <td>
                            @foreach($car->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.mec') }}
                        </th>
                        <td>
                            {{ $car->mec }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.kms') }}
                        </th>
                        <td>
                            {{ $car->kms }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.color') }}
                        </th>
                        <td>
                            {{ $car->color }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.interior') }}
                        </th>
                        <td>
                            {{ $car->interior }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.serie') }}
                        </th>
                        <td>
                            {!! $car->serie !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.feature') }}
                        </th>
                        <td>
                            {!! $car->feature !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.price_new') }}
                        </th>
                        <td>
                            {{ $car->price_new }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.frevo') }}
                        </th>
                        <td>
                            {{ $car->frevo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.real_frevo') }}
                        </th>
                        <td>
                            {{ $car->real_frevo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.link_frevo') }}
                        </th>
                        <td>
                            {{ $car->link_frevo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.discount') }}
                        </th>
                        <td>
                            {{ $car->discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.price_ht') }}
                        </th>
                        <td>
                            {{ $car->price_ht }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.price_ttc') }}
                        </th>
                        <td>
                            {{ $car->price_ttc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.tax') }}
                        </th>
                        <td>
                            {{ $car->tax }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.last_price_update') }}
                        </th>
                        <td>
                            {{ $car->last_price_update }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.cost_price') }}
                        </th>
                        <td>
                            {{ $car->cost_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.impuesto') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $car->impuesto ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $car->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.qty') }}
                        </th>
                        <td>
                            {{ $car->qty }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.draft') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $car->draft ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.dispo') }}
                        </th>
                        <td>
                            {{ $car->dispo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.warehouse') }}
                        </th>
                        <td>
                            {{ $car->warehouse }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.comseller') }}
                        </th>
                        <td>
                            {{ $car->comseller }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.import_key') }}
                        </th>
                        <td>
                            {{ $car->import_key }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.tags') }}
                        </th>
                        <td>
                            @foreach($car->tags as $key => $tags)
                                <span class="label label-info">{{ $tags->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cars.index') }}">
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
            <a class="nav-link" href="#vehicle_shipp_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.shippLine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#vehicle_order_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.orderLine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#vehicle_proforma_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.proformaLine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#vehicle_invoice_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.invoiceLine.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="vehicle_shipp_lines">
            @includeIf('admin.cars.relationships.vehicleShippLines', ['shippLines' => $car->vehicleShippLines])
        </div>
        <div class="tab-pane" role="tabpanel" id="vehicle_order_lines">
            @includeIf('admin.cars.relationships.vehicleOrderLines', ['orderLines' => $car->vehicleOrderLines])
        </div>
        <div class="tab-pane" role="tabpanel" id="vehicle_proforma_lines">
            @includeIf('admin.cars.relationships.vehicleProformaLines', ['proformaLines' => $car->vehicleProformaLines])
        </div>
        <div class="tab-pane" role="tabpanel" id="vehicle_invoice_lines">
            @includeIf('admin.cars.relationships.vehicleInvoiceLines', ['invoiceLines' => $car->vehicleInvoiceLines])
        </div>
    </div>
</div>

@endsection