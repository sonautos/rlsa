@extends('layouts.admin')

@section('style')
    <style>
        .tab-content {
            text-align: center;
        }
    </style>
@endsection

@section('content')
<div class="card shadow p-3">
    <div class="card-header text-center">
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
            <a class="nav-link" href="#societe_bank" role="tab" data-toggle="tab">
                {{ trans('cruds.banks.title') }}
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
        <div class="tab-pane" role="tabpanel" id="societe_bank">
            @includeIf('admin.companies.relationships.companyBanks', ['banks' => $company->companyBanks])
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.company.title') }}
    </div>
    <div class="form-group text-right p-2">
        <a class="btn btn-default" href="{{ route('admin.companies.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>
    <div class="card-body">
        <div class="float text-right">
            {{ $company->entity->name ?? '' }}
        </div>
        <div class="card col-md-6 mx-auto">
            <div class="card-body">
                {{ trans('cruds.company.fields.photo') }}
                @if($company->photo)
                    <a href="{{ $company->photo->getUrl() }}" target="_blank" style="display: inline-block">
                        <img src="{{ $company->photo->getUrl('thumb') }}">
                    </a>
                @endif
            </div>
        </div>

        <div class="form-group">



            <div class="row">
                <div class="col-md-4">
                    <div id="map" style="height:360px;"></div>
                </div>
                <div class="col-md-4">
                    <table class="table table-bordered table-sm">
                        <tbody>
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
                                    {{ trans('cruds.company.fields.code_client') }}
                                </th>
                                <td>
                                    {{ $company->code_client }}
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
                                    {{ trans('cruds.company.fields.zip') }}
                                </th>
                                <td>
                                    {{ $company->zip }}
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
                                    {{ trans('cruds.company.fields.phone') }}
                                </th>
                                <td>
                                    {{ $company->phone }}
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
                                    {{ trans('cruds.company.fields.ape') }}
                                </th>
                                <td>
                                    {{ $company->ape }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-bordered table-sm">
                        <tbody>
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
                                    {{ trans('cruds.company.fields.code_client') }}
                                </th>
                                <td>
                                    {{ $company->code_client }}
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
                                    {{ trans('cruds.company.fields.city') }}
                                </th>
                                <td>
                                    {{ $company->city }}
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
                                    {{ trans('cruds.company.fields.email') }}
                                </th>
                                <td>
                                    {{ $company->email }}
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
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="">{{ trans('cruds.company.fields.note_private') }}</label>
                    <textarea name="" id="" cols="100" rows="5">{{ $company->note_private }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="">{{ trans('cruds.company.fields.note_public') }}</label>
                    <textarea name="" id="" cols="100" rows="5">{{ $company->note_public }}</textarea>
                </div>
            </div>


            <div class="card shadow">
                <ul>
                    <li>{{ trans('cruds.company.fields.supplier') }}
                        <input type="checkbox" disabled="disabled" {{ $company->supplier ? 'checked' : '' }}>
                    </li>
                    <li>
                        {{ trans('cruds.company.fields.status') }}
                        {{ $company->status }}
                    </li>
                    <li>
                        {{ trans('cruds.company.fields.parent') }}
                        {{ $company->parent }}
                    </li>
                    <li>
                        {{ trans('cruds.company.fields.active') }}
                        <input type="checkbox" disabled="disabled" {{ $company->active ? 'checked' : '' }}>
                    </li>
                    <li>

                    </li>
                </ul>
            </div>

            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?callback=InitMap&amp;key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
<script>
    var latitude = <?php echo $company->latitude; ?>;
    var longitude = <?php echo $company->longitude; ?>;
    const InitMap = () => {
    const locations = [
        {
        label: 'S',
        draggable: false,
        title: 'Stanford',
        www: 'https://www.stanford.edu/'
        }
    ]
    const map = new google.maps.Map(document.getElementById('map'), {
        center: {
        lat: latitude,
        lng: longitude
        },
        zoom: 16
    })
    const markers = locations.map((location, i) => {
        const contentString = `<a href="${location.www}" target="_blank"><strong>${location.title}</strong></a>`
        const infoWindow = new google.maps.InfoWindow({
        content: contentString,
        maxWidth: 200
        })
        const marker = new google.maps.Marker({
        position: location,
        label: location.label,
        map,
        title: location.title,
        contentString
        })
        marker.addListener('click', () => {
        infoWindow.open(map, marker)
        })
        return marker
    })
    }

    if (window.google && window.google.maps) {
    InitMap()
    }
</script>
@endsection
