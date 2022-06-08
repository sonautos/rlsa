@extends('layouts.admin')
@section('content')

{{-- @if (count($errors) > 0)
<div class = "bg-danger text-black shadow text-center rounded-bottom">
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif --}}

<div class="container pb-2">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="navbar-collapse collapse w-100 dual-collapse2 order-1 order-md-0">
            <ul class="navbar-nav ml-auto text-center">
                <li class="nav-item active px-3">
                    <a class="navbar-brand" href="{{ route('admin.shippmentslists.show', [$shippmentslist->id]) }}">{{ trans('trans.Resume')}}</a>
                </li>
            </ul>
        </div>
        <div class="navbar-collapse collapse w-100 dual-collapse2 order-2 order-md-2">
            <ul class="navbar-nav mr-auto text-center">
                <li class="nav-item px-3">
                    <a class="navbar-brand" href="{{ route('admin.shipp-docs.show', [$shippmentslist->id]) }}">{{ trans('trans.Documents')}}</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div class="container-fluid">
    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <div class="row">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card shadow p-2" style="height: 100%">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h5>{{ trans('exp.Shippment')}} {{ trans('trans.Ref')}} : {{$shippmentslist->ref}}</h5>
                                                <div class="float-left">
                                                    <span class="badge badge-inline badge-success">{{ trans('trans.'.$shippmentslist->status->name) }}</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="card col bg-success text-gray-600 text-justify mx-3 shadow-xl">
                                                    @include('admin.shippmentslists.includes.entity-update')
                                                    <div class="text-right">
                                                        <button class="text-dark hover:bg-indigo-200 hover:text-black rounded" onclick="$('#entityModal').modal('show')" href=""><i class="fas fa-edit"></i></button>
                                                    </div>
                                                    <h5 class="text-center pb-3">{{ trans('trans.Societe')}} {{ trans('trans.who_invoice')}} : {{ $shippmentslist->entity->name }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @include('admin.shippmentslists.includes.shippment-update')
                                        <div class="text-right">
                                            <button class="text-dark hover:bg-indigo-200 hover:text-black rounded" onclick="$('#shippModal').modal('show')" href=""><i class="fas fa-edit"></i></button>
                                        </div>
                                        <div class="">
                                            <div class="pb-2">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        {{ trans('trans.create-date') }}:
                                                        {{  to_date($shippmentslist->created_at) }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        {{ trans('trans.expected-delivery') }}:
                                                        {{  $shippmentslist->date_delivery }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p><b style="text-transform: uppercase">{{ trans('trans.Note_private')}} : </b><br/>
                                                        @if ($shippmentslist->note_private){{  $shippmentslist->note_private }}@endif</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p><b style="text-transform: uppercase">{{ trans('trans.Note_public')}} : </b><br/>
                                                        @if ($shippmentslist->note_public){{  $shippmentslist->note_public }}@endif</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow" style="height: 100%">
                                    <div class="card-header">
                                        <h5>{{trans('trans.transporter_data')}}</h5>
                                        <div class="float-right">
                                            @if (isset($shippmentslist->shippmentTrucks->status) && $shippmentslist->shippmentTrucks->status == 1)
                                                <span class="badge badge-inline badge-success">{{ trans('trans.draft')}}</span>
                                            @endif
                                            <button class="text-dark hover:bg-indigo-200 hover:text-black rounded" onclick="$('#truckModal').modal('show')" href=""><i class="fas fa-edit"></i></button>
                                        </div>
                                        <div class="float-left">
                                            @if (isset($shippmentslist->shippmentTrucks->status))
                                            @include('admin.shippmentslists.includes.statuesview',['statues'=>$shippmentslist->shippmentTrucks->status])
                                            @endif
                                            @if (isset($shippmentslist->shippmentTrucks->paid) && $shippmentslist->shippmentTrucks->paid == 1)
                                            <span class="badge badge-inline badge-success">{{trans('trans.paid')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @include('admin.shippmentslists.includes.truck-update')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="list-group shadow">
                                                    <li class="list-group-item">{{ trans('trans.supplier')}} : {{$shippmentslist->shippmentTrucks->supplier->name ?? '' }}</li>
                                                    <li class="list-group-item">{{ trans('trans.date_order')}} : {{ isset($shippmentslist->shippmentTrucks->created_at) ? to_date($shippmentslist->shippmentTrucks->created_at) : '' }}</li>
                                                    <li class="list-group-item">{{ trans('trans.date_load')}} : {{ isset($shippmentslist->shippmentTrucks->date_load) ? to_date($shippmentslist->shippmentTrucks->date_load) : '' }}</li>
                                                    <li class="list-group-item">{{ trans('trans.date_cmr')}} : {{ isset($shippmentslist->shippmentTrucks->date_cmr) ? ($shippmentslist->shippmentTrucks->date_cmr) : ''}}</li>

                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="list-group shadow">
                                                    <li class="list-group-item">{{ trans('trans.plates')}} : {{$shippmentslist->shippmentTrucks->plates ?? ''}}</li>
                                                    <li class="list-group-item">{{ trans('trans.chauffeur')}} : {{$shippmentslist->shippmentTrucks->chauffeur ?? '' }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-center">
                                            {{ trans('trans.price')}} : @if ($shippmentslist->shippmentTrucks){{number_format($shippmentslist->shippmentTrucks->price, 2, '.', '')}} €.H.T @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card shadow">
                    <table class="table table-sm table-responsive-sm text-center" id="dataTable">
                        <div class="p-3">
                            <form action="{{ route('admin.shippments.export', $shippmentslist->id )}}" method="POST">
                                @csrf
                                <input name="id" value="{{ $shippmentslist->id }}" hidden>
                                <input name="ref" value="{{ $shippmentslist->ref }}" hidden>
                                <button class="text-white bg-green-600 hover:bg-green-200 hover:text-black p-1 rounded" type="submit">Excel</button>
                            </form>
                            <div class="float-right">
                                <button class="text-dark hover:bg-indigo-200 hover:text-indigo-500 rounded" onclick="$('#editPrices').modal('show')" href="">{{trans('trans.editPrice')}} <i class="fas fa-edit"></i></button>
                            </div>
                            @include('admin.shippmentslists.includes.total-lines')
                        </div>
                        <thead class="thead-white text-center">
                            <tr>
                                <th></th>
                                <th>{{ trans('trans.description')}}</th>
                                <th>{{ trans('vehicle.vin')}}</th>
                                <th>{{ trans('vehicle.color')}}</th>
                                <th>{{ trans('vehicle.plates')}}</th>
                                <th>{{ trans('trans.seller')}}</th>
                                <th>{{ trans('exp.loadingplace')}}</th>
                                <th>{{ trans('trans.Client')}}</th>
                                <th>{{ trans('exp.destination')}}</th>
                                <th>{{ trans('trans.price')}}</th>
                                <th>{{ trans('trans.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shippmentslist->shippmentShippLines as $line)
                            <tr>
                                <td></td>
                                <td>{{ $line->modele }}</td>
                                <td>{{ $line->vin }}</td>
                                <td>{{ $line->color}}</td>
                                <td>{{ $line->plates }}</td>
                                <td>{{ $line->seller->name }}</td>
                                <td>{{ $line->loading_place }}</td>
                                <td>{{ $line->client->name }}</td>
                                <td>{{ $line->delivery_place }}</td>
                                <td>{{ to_money($line->price) }} €.H.T</td>
                                <td>
                                    <div class="flex space-x-1 justify-around">
                                        <a href="#" data-toggle="modal" data-target="#editlineModal{{ $line->id }}" class="p-1 text-teal-600 hover:bg-teal-600 hover:text-white rounded">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                                        </a>
                                        @include('admin.shippmentslists.includes.lines-update')
                                        <button href="#" data-toggle="modal" data-target="#deletelineModal{{ $line->id }}" class="p-1 text-red-600 hover:bg-red-600 hover:text-white rounded">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                        </button>
                                        @include('admin.shippmentslists.includes.delete-line')
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="btn btn-group float-right">
                    <a class="border-2 border-gray-600 hover:bg-gray-200 hover:text-black p-1 rounded" href="{{ route('admin.shippmentslists.index')}}">{{trans('trans.back')}}</a>
                    {{-- <a class="border-2 border-gray-600 hover:bg-gray-200 hover:text-black p-1 rounded" href="#">{{trans('trans.Proform')}}</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.shippmentslist.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shippmentslists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.shippmentslist.fields.id') }}
                        </th>
                        <td>
                            {{ $shippmentslist->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippmentslist.fields.ref') }}
                        </th>
                        <td>
                            {{ $shippmentslist->ref }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippmentslist.fields.entity') }}
                        </th>
                        <td>
                            {{ $shippmentslist->entity->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippmentslist.fields.status') }}
                        </th>
                        <td>
                            {{ $shippmentslist->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippmentslist.fields.user') }}
                        </th>
                        <td>
                            {{ $shippmentslist->user->firstname ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippmentslist.fields.note_private') }}
                        </th>
                        <td>
                            {{ $shippmentslist->note_private }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippmentslist.fields.note_public') }}
                        </th>
                        <td>
                            {{ $shippmentslist->note_public }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippmentslist.fields.date_delivery') }}
                        </th>
                        <td>
                            {{ $shippmentslist->date_delivery }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shippmentslists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#shippment_shipp_lines" role="tab" data-toggle="tab">
                {{ trans('cruds.shippLine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#shippment_trucks" role="tab" data-toggle="tab">
                {{ trans('cruds.truck.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="shippment_shipp_lines">
            @includeIf('admin.shippmentslists.relationships.shippmentShippLines', ['shippLines' => $shippmentslist->shippmentShippLines])
        </div>
        <div class="tab-pane" role="tabpanel" id="shippment_trucks">
            @includeIf('admin.shippmentslists.relationships.shippmentTrucks', ['trucks' => $shippmentslist->shippmentTrucks])
        </div>
    </div>
</div> --}}

@endsection
