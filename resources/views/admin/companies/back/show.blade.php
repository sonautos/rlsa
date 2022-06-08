@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.company.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.id') }}
                        </th>
                        <td>
                            {{ $company->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.entity') }}
                        </th>
                        <td>
                            {{ $company->entity->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.name') }}
                        </th>
                        <td>
                            {{ $company->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.alias') }}
                        </th>
                        <td>
                            {{ $company->alias }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.supplier') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $company->supplier ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.status') }}
                        </th>
                        <td>
                            {{ $company->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.parent') }}
                        </th>
                        <td>
                            {{ $company->parent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.code_client') }}
                        </th>
                        <td>
                            {{ $company->code_client }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.code_supplier') }}
                        </th>
                        <td>
                            {{ $company->code_supplier }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.address') }}
                        </th>
                        <td>
                            {{ $company->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.address_2') }}
                        </th>
                        <td>
                            {{ $company->address_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.zip') }}
                        </th>
                        <td>
                            {{ $company->zip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.city') }}
                        </th>
                        <td>
                            {{ $company->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.state') }}
                        </th>
                        <td>
                            {{ $company->state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.country') }}
                        </th>
                        <td>
                            {{ $company->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.phone') }}
                        </th>
                        <td>
                            {{ $company->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.email') }}
                        </th>
                        <td>
                            {{ $company->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.siren') }}
                        </th>
                        <td>
                            {{ $company->siren }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.siret') }}
                        </th>
                        <td>
                            {{ $company->siret }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.ape') }}
                        </th>
                        <td>
                            {{ $company->ape }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.vatnumber') }}
                        </th>
                        <td>
                            {{ $company->vatnumber }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.capital') }}
                        </th>
                        <td>
                            {{ $company->capital }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.note_private') }}
                        </th>
                        <td>
                            {{ $company->note_private }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.note_public') }}
                        </th>
                        <td>
                            {{ $company->note_public }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $company->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.photo') }}
                        </th>
                        <td>
                            @if($company->photo)
                                <a href="{{ $company->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $company->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.tags') }}
                        </th>
                        <td>
                            @foreach($company->tags as $key => $tags)
                                <span class="label label-info">{{ $tags->tag }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.latitude') }}
                        </th>
                        <td>
                            {{ $company->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.longitude') }}
                        </th>
                        <td>
                            {{ $company->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.company.fields.url_place') }}
                        </th>
                        <td>
                            {{ $company->url_place }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.companies.index') }}">
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
            <a class="nav-link" href="#societe_individuals" role="tab" data-toggle="tab">
                {{ trans('cruds.individual.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#societe_addresses" role="tab" data-toggle="tab">
                {{ trans('cruds.address.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#seller_shipp_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.shippLine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_shipp_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.shippLine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#supplier_trucks" role="tab" data-toggle="tab">
                {{ trans('cruds.truck.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#societe_orders_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.ordersList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#societe_proforma_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.proformaList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#societe_invoices_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.invoicesList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#seller_cars" role="tab" data-toggle="tab">
                {{ trans('cruds.car.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="societe_individuals">
            @includeIf('admin.companies.relationships.societeIndividuals', ['individuals' => $company->societeIndividuals])
        </div>
        <div class="tab-pane" role="tabpanel" id="societe_addresses">
            @includeIf('admin.companies.relationships.societeAddresses', ['addresses' => $company->societeAddresses])
        </div>
        <div class="tab-pane" role="tabpanel" id="seller_shipp_lines">
            @includeIf('admin.companies.relationships.sellerShippLines', ['shippLines' => $company->sellerShippLines])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_shipp_lines">
            @includeIf('admin.companies.relationships.clientShippLines', ['shippLines' => $company->clientShippLines])
        </div>
        <div class="tab-pane" role="tabpanel" id="supplier_trucks">
            @includeIf('admin.companies.relationships.supplierTrucks', ['trucks' => $company->supplierTrucks])
        </div>
        <div class="tab-pane" role="tabpanel" id="societe_orders_lists">
            @includeIf('admin.companies.relationships.societeOrdersLists', ['ordersLists' => $company->societeOrdersLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="societe_proforma_lists">
            @includeIf('admin.companies.relationships.societeProformaLists', ['proformaLists' => $company->societeProformaLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="societe_invoices_lists">
            @includeIf('admin.companies.relationships.societeInvoicesLists', ['invoicesLists' => $company->societeInvoicesLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="seller_cars">
            @includeIf('admin.companies.relationships.sellerCars', ['cars' => $company->sellerCars])
        </div>
    </div>
</div>

@endsection