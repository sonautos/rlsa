@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="card rounded shadow">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 >{{ trans('trans.seller') }} : <span style="color: #1a9ff1">{{ $proformaList->seller->name }}</span></h3>
                    </div>
                    <div class="text-right col-md-6">
                        <ul>
                            <li>
                                <h5>{{ trans('trans.ref_of_the') }} {{ trans('trans.proforma') }} : <span style="color: #1a9ff1" >{{$proformaList->ref}}</span>
                                </h5>
                                <p>{{ trans('trans.dateof') }} {{ trans('trans.proforma') }} : {{ $proformaList->date_created }}<br/>
                                    {{-- {{ trans('cruds.proformaList.fields.date_created') }} : {{ $proformaList->date_created }}<br/>
                                    {{ trans('cruds.proformaList.fields.date_valid') }} : {{ $proformaList->date_valid }}<br/> --}}
                                    {{ trans('cruds.proformaList.fields.cond_reglement') }} : {{ $proformaList->cond_reglement->name }}<br/>
                                    {{ trans('cruds.proformaList.fields.mode_reglement') }} : {{ $proformaList->mode_reglement->name }}<br/>
                                    {{ trans('trans.dateof') }} {{ trans('trans.delivery') }} : {{ $proformaList->date_livraison }}<br/>
                                @if(isset($proformaList->shipping_method->name)){{ trans('trans.delivery_method') }} : {{ $proformaList->shipping_method->name }}@endif</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <div class="card p-2 shadow-lg">
                            <ul>
                                <li><b>{{ $proformaList->client->name }}</b></li>
                                <li>{{ $proformaList->client->address }}</li>
                                <li>{{ $proformaList->client->zip }} {{ $proformaList->client->town }}</li>
                                <li>@if(isset($proformaList->client->state)){{ $proformaList->client->state }} - @endif{{ $proformaList->client->country }}</li>
                                @if (isset($proformaList->delivery_address->name))
                                    <li>{{ trans('cruds.proformaList.fields.delivery_address') }} : {{ $proformaList->delivery_address->name ?? '' }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-2 shadow-lg">
                            <td colspan="3">
                                <table style="width: 100%">
                                    <tr>
                                        <th style="bproforma-top:none">{{ trans('cruds.proformaList.fields.remise') }}</th>
                                        <td style="bproforma-top:none">{{ to_money($proformaList->remise ?? '0') }} €</td>
                                    </tr>
                                    <tr>
                                        <th style="bproforma-top:none">{{ trans('cruds.proformaList.fields.remise_percent') }}</th>
                                        <td style="bproforma-top:none">{{ to_money($proformaList->remise_percent ?? '0') }} %</td>
                                    </tr>
                                    <tr>
                                        <th style="bproforma-top:none">{{trans('trans.total_ht')}}</th>
                                        <td style="bproforma-top:none">{{ to_money($proformaList->total_ht)}} €</td>
                                    </tr>
                                    <tr>
                                        <th style="bproforma-top:none">{{trans('trans.total_ht')}}</th>
                                        <td style="bproforma-top:none">{{ to_money($proformaList->total_tva)}} €</td>
                                    </tr>
                                    <tr>
                                        <th  style="bproforma-top:none">{{trans('trans.total_ttc')}}</th>
                                        <td style="bproforma-top:none">{{ to_money((float)$proformaList->total_ttc)}} €</td>
                                    </tr>
                                    <tr>
                                        <th  style="bproforma-top:none">{{trans('trans.numberOf')}} {{ trans('vehicle.car') }}</th>
                                        <td>{{ count($lines)}}</td>
                                    </tr>
                                    <tr>
                                        <th  style="bproforma-top:none">{{trans('trans.totalComm')}}</th>
                                        <td>{{ to_money($comsellers+$comclients) }} € H.T</td>
                                    </tr>
                                </table>
                            </td>
                        </div>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="card" aria-label="Close"></button>
            </div>

            <div class="card-body">
                <div class="card shadow">
                    <div class="text-right">
                        {{-- @include('admin.proformaLists.includes.update-line') --}}
                        <button class="text-dark hover:bg-indigo-200 hover:text-black rounded" onclick="$('#Modal').modal('show')" href=""><i class="fas fa-edit"></i></button>
                    </div>
                    <div class="m-3">
                        <div class="table-responsive">
                            <table class=" table table-hover datatable datatable-proformaproformaLines">
                                <thead>
                                    <tr>
                                        <th width="10">

                                        </th>
                                        <th>
                                            {{ trans('global.designation') }}
                                        </th>
                                        <th>
                                            {{ trans('vehicle.vin') }}
                                        </th>
                                        <th>
                                            {{ trans('vehicle.plates') }}
                                        </th>
                                        <th>
                                            {{ trans('vehicle.color') }}
                                        </th>
                                        <th>
                                            {{ trans('vehicle.mec') }}
                                        </th>
                                        <th>
                                            {{ trans('vehicle.frevo') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.proformaLine.fields.total_ht') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.proformaLine.fields.total_tva') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.proformaLine.fields.total_ttc') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.proformaLine.fields.comclient') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.cars.fields.comseller') }}
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proformaList->proformaProformaLines as $key => $proformaLine)
                                        <tr data-entry-id="{{ $proformaLine->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $proformaLine->product->name ?? '' }}
                                                {{ $proformaLine->service->name ?? '' }}
                                                {{ $proformaLine->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $proformaLine->vehicle->vin ?? '' }}
                                            </td>
                                            <td>
                                                {{ $proformaLine->vehicle->plates ?? '' }}
                                            </td>
                                            <td>
                                                {{ $proformaLine->vehicle->color ?? '' }}
                                            </td>
                                            <td>
                                                {{ $proformaLine->vehicle->mec ?? '' }}
                                            </td>
                                            <td>
                                                {{ to_money($proformaLine->vehicle->frevo ?? '0') }}
                                            </td>
                                            <td>
                                                {{ $proformaLine->total_ht ?? '' }}
                                            </td>
                                            <td>
                                                {{ $proformaLine->total_tva ?? '' }}
                                            </td>
                                            <td>
                                                {{ $proformaLine->total_ttc ?? '' }}
                                            </td>
                                            <td>
                                                {{ $proformaLine->comclient ?? '' }}
                                            </td>
                                            <td>
                                                {{ $proformaLine->vehicle->comseller ?? '' }}
                                            </td>
                                            <td>
                                                @can('proforma_line_show')
                                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.proforma-lines.show', $proformaLine->id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('proforma_line_edit')
                                                    <a class="btn btn-xs btn-info" href="{{ route('admin.proforma-lines.edit', $proformaLine->id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('proforma_line_delete')
                                                    <form action="{{ route('admin.proforma-lines.destroy', $proformaLine->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @can('proforma_line_create')
                    <div style="margin-bottom: 10px;" class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-success float-right mx-5" href="{{ route('admin.proforma-lines.create') }}">+</a>
                        </div>
                    </div>
                    @endcan
                </div>
                <form action="{{ route('admin.proforma.pdf') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="" value="{{ $proformaList->id }}">
                    <button class="text-white bg-green-600 hover:bg-green-200 hover:text-black p-2 rounded" type="submit">
                        {{trans('trans.print')}}
                    </button>
                </form>
            </div>
            <div class="card-footer">
                <div class="btn-group d-block text-right" role="group" aria-label="Basic example">
                    <a type="button" class="btn btn-outline-dark" href='{{ route('admin.proforma-lists.index') }}'>{{trans('trans.back')}}</a>
                    <a type="button" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')" href="#">{{ trans('trans.delete') }}</a>
                  </div>
            </div>
        </div>
    </div>
</div>
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
            <table class="table table-bproformaed table-striped">
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
