@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.invoiceLine.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.invoice-lines.update", [$invoiceLine->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="proforma_id">{{ trans('cruds.invoiceLine.fields.proforma') }}</label>
                <select class="form-control select2 {{ $errors->has('proforma') ? 'is-invalid' : '' }}" name="proforma_id" id="proforma_id" required>
                    @foreach($proformas as $id => $proforma)
                        <option value="{{ $id }}" {{ (old('proforma_id') ? old('proforma_id') : $invoiceLine->proforma->id ?? '') == $id ? 'selected' : '' }}>{{ $proforma }}</option>
                    @endforeach
                </select>
                @if($errors->has('proforma'))
                    <span class="text-danger">{{ $errors->first('proforma') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.proforma_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.invoiceLine.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $product)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $invoiceLine->product->id ?? '') == $id ? 'selected' : '' }}>{{ $product }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_id">{{ trans('cruds.invoiceLine.fields.service') }}</label>
                <select class="form-control select2 {{ $errors->has('service') ? 'is-invalid' : '' }}" name="service_id" id="service_id">
                    @foreach($services as $id => $service)
                        <option value="{{ $id }}" {{ (old('service_id') ? old('service_id') : $invoiceLine->service->id ?? '') == $id ? 'selected' : '' }}>{{ $service }}</option>
                    @endforeach
                </select>
                @if($errors->has('service'))
                    <span class="text-danger">{{ $errors->first('service') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.service_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vehicle_id">{{ trans('cruds.invoiceLine.fields.vehicle') }}</label>
                <select class="form-control select2 {{ $errors->has('vehicle') ? 'is-invalid' : '' }}" name="vehicle_id" id="vehicle_id">
                    @foreach($vehicles as $id => $vehicle)
                        <option value="{{ $id }}" {{ (old('vehicle_id') ? old('vehicle_id') : $invoiceLine->vehicle->id ?? '') == $id ? 'selected' : '' }}>{{ $vehicle }}</option>
                    @endforeach
                </select>
                @if($errors->has('vehicle'))
                    <span class="text-danger">{{ $errors->first('vehicle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.vehicle_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.invoiceLine.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $invoiceLine->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.invoiceLine.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $invoiceLine->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="qty">{{ trans('cruds.invoiceLine.fields.qty') }}</label>
                <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" type="number" name="qty" id="qty" value="{{ old('qty', $invoiceLine->qty) }}" step="1" required>
                @if($errors->has('qty'))
                    <span class="text-danger">{{ $errors->first('qty') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.qty_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tva_tx">{{ trans('cruds.invoiceLine.fields.tva_tx') }}</label>
                <input class="form-control {{ $errors->has('tva_tx') ? 'is-invalid' : '' }}" type="number" name="tva_tx" id="tva_tx" value="{{ old('tva_tx', $invoiceLine->tva_tx) }}" step="0.01">
                @if($errors->has('tva_tx'))
                    <span class="text-danger">{{ $errors->first('tva_tx') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.tva_tx_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remise_percent">{{ trans('cruds.invoiceLine.fields.remise_percent') }}</label>
                <input class="form-control {{ $errors->has('remise_percent') ? 'is-invalid' : '' }}" type="number" name="remise_percent" id="remise_percent" value="{{ old('remise_percent', $invoiceLine->remise_percent) }}" step="0.01">
                @if($errors->has('remise_percent'))
                    <span class="text-danger">{{ $errors->first('remise_percent') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.remise_percent_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remise">{{ trans('cruds.invoiceLine.fields.remise') }}</label>
                <input class="form-control {{ $errors->has('remise') ? 'is-invalid' : '' }}" type="number" name="remise" id="remise" value="{{ old('remise', $invoiceLine->remise) }}" step="0.01">
                @if($errors->has('remise'))
                    <span class="text-danger">{{ $errors->first('remise') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.remise_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_ht">{{ trans('cruds.invoiceLine.fields.total_ht') }}</label>
                <input class="form-control {{ $errors->has('total_ht') ? 'is-invalid' : '' }}" type="number" name="total_ht" id="total_ht" value="{{ old('total_ht', $invoiceLine->total_ht) }}" step="0.01">
                @if($errors->has('total_ht'))
                    <span class="text-danger">{{ $errors->first('total_ht') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.total_ht_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_tva">{{ trans('cruds.invoiceLine.fields.total_tva') }}</label>
                <input class="form-control {{ $errors->has('total_tva') ? 'is-invalid' : '' }}" type="number" name="total_tva" id="total_tva" value="{{ old('total_tva', $invoiceLine->total_tva) }}" step="0.01">
                @if($errors->has('total_tva'))
                    <span class="text-danger">{{ $errors->first('total_tva') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.total_tva_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_ttc">{{ trans('cruds.invoiceLine.fields.total_ttc') }}</label>
                <input class="form-control {{ $errors->has('total_ttc') ? 'is-invalid' : '' }}" type="number" name="total_ttc" id="total_ttc" value="{{ old('total_ttc', $invoiceLine->total_ttc) }}" step="0.01">
                @if($errors->has('total_ttc'))
                    <span class="text-danger">{{ $errors->first('total_ttc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.total_ttc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cost_price">{{ trans('cruds.invoiceLine.fields.cost_price') }}</label>
                <input class="form-control {{ $errors->has('cost_price') ? 'is-invalid' : '' }}" type="number" name="cost_price" id="cost_price" value="{{ old('cost_price', $invoiceLine->cost_price) }}" step="0.01">
                @if($errors->has('cost_price'))
                    <span class="text-danger">{{ $errors->first('cost_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.cost_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comclient">{{ trans('cruds.invoiceLine.fields.comclient') }}</label>
                <input class="form-control {{ $errors->has('comclient') ? 'is-invalid' : '' }}" type="number" name="comclient" id="comclient" value="{{ old('comclient', $invoiceLine->comclient) }}" step="0.01">
                @if($errors->has('comclient'))
                    <span class="text-danger">{{ $errors->first('comclient') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.comclient_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.invoiceLine.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $invoiceLine->status->id ?? '') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceLine.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection