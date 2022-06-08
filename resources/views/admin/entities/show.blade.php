@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.entity.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.entities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.id') }}
                        </th>
                        <td>
                            {{ $entity->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.name') }}
                        </th>
                        <td>
                            {{ $entity->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.alias') }}
                        </th>
                        <td>
                            {{ $entity->alias }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.supplier') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $entity->supplier ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.status') }}
                        </th>
                        <td>
                            {{ $entity->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.parent') }}
                        </th>
                        <td>
                            {{ $entity->parent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.code_client') }}
                        </th>
                        <td>
                            {{ $entity->code_client }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.code_supplier') }}
                        </th>
                        <td>
                            {{ $entity->code_supplier }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.address') }}
                        </th>
                        <td>
                            {{ $entity->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.address_2') }}
                        </th>
                        <td>
                            {{ $entity->address_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.zip') }}
                        </th>
                        <td>
                            {{ $entity->zip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.city') }}
                        </th>
                        <td>
                            {{ $entity->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.state') }}
                        </th>
                        <td>
                            {{ $entity->state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.country') }}
                        </th>
                        <td>
                            {{ $entity->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.latitude') }}
                        </th>
                        <td>
                            {{ $entity->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.longitude') }}
                        </th>
                        <td>
                            {{ $entity->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.url_place') }}
                        </th>
                        <td>
                            {{ $entity->url_place }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.phone') }}
                        </th>
                        <td>
                            {{ $entity->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.email') }}
                        </th>
                        <td>
                            {{ $entity->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.siren') }}
                        </th>
                        <td>
                            {{ $entity->siren }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.siret') }}
                        </th>
                        <td>
                            {{ $entity->siret }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.ape') }}
                        </th>
                        <td>
                            {{ $entity->ape }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.vatnumber') }}
                        </th>
                        <td>
                            {{ $entity->vatnumber }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.capital') }}
                        </th>
                        <td>
                            {{ $entity->capital }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.note_private') }}
                        </th>
                        <td>
                            {{ $entity->note_private }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.note_public') }}
                        </th>
                        <td>
                            {{ $entity->note_public }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.entity.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $entity->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.entities.index') }}">
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
            <a class="nav-link" href="#entity_companies" role="tab" data-toggle="tab">
                {{ trans('cruds.company.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#entity_individuals" role="tab" data-toggle="tab">
                {{ trans('cruds.individual.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#entity_addresses" role="tab" data-toggle="tab">
                {{ trans('cruds.address.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#entity_shippmentslists" role="tab" data-toggle="tab">
                {{ trans('cruds.shippmentslist.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#entity_orders_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.ordersList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#entity_proforma_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.proformaList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#entity_invoices_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.invoicesList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#entity_cars" role="tab" data-toggle="tab">
                {{ trans('cruds.car.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#entity_banks" role="tab" data-toggle="tab">
                {{ trans('trans.bank') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="entity_companies">
            @includeIf('admin.entities.relationships.entityCompanies', ['companies' => $entity->entityCompanies])
        </div>
        <div class="tab-pane" role="tabpanel" id="entity_individuals">
            @includeIf('admin.entities.relationships.entityIndividuals', ['individuals' => $entity->entityIndividuals])
        </div>
        <div class="tab-pane" role="tabpanel" id="entity_addresses">
            @includeIf('admin.entities.relationships.entityAddresses', ['addresses' => $entity->entityAddresses])
        </div>
        <div class="tab-pane" role="tabpanel" id="entity_shippmentslists">
            @includeIf('admin.entities.relationships.entityShippmentslists', ['shippmentslists' => $entity->entityShippmentslists])
        </div>
        <div class="tab-pane" role="tabpanel" id="entity_orders_lists">
            @includeIf('admin.entities.relationships.entityOrdersLists', ['ordersLists' => $entity->entityOrdersLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="entity_proforma_lists">
            @includeIf('admin.entities.relationships.entityProformaLists', ['proformaLists' => $entity->entityProformaLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="entity_invoices_lists">
            @includeIf('admin.entities.relationships.entityInvoicesLists', ['invoicesLists' => $entity->entityInvoicesLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="entity_cars">
            @includeIf('admin.entities.relationships.entityCars', ['cars' => $entity->entityCars])
        </div>
        <div class="tab-pane" role="tabpanel" id="entity_banks">
            @includeIf('admin.entities.relationships.entityBanks', ['banks' => $entity->entityBanks])
        </div>
    </div>
</div>

@endsection