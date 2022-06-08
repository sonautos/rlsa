@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.shippLine.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.shipp-lines.update", [$shippLine->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="seller_id">{{ trans('cruds.shippLine.fields.seller') }}</label>
                <select class="form-control select2 {{ $errors->has('seller') ? 'is-invalid' : '' }}" name="seller_id" id="seller_id" required>
                    @foreach($sellers as $id => $seller)
                        <option value="{{ $id }}" {{ (old('seller_id') ? old('seller_id') : $shippLine->seller->id ?? '') == $id ? 'selected' : '' }}>{{ $seller }}</option>
                    @endforeach
                </select>
                @if($errors->has('seller'))
                    <span class="text-danger">{{ $errors->first('seller') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.seller_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_id">{{ trans('cruds.shippLine.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $shippLine->client->id ?? '') == $id ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="modele">{{ trans('cruds.shippLine.fields.modele') }}</label>
                <input class="form-control {{ $errors->has('modele') ? 'is-invalid' : '' }}" type="text" name="modele" id="modele" value="{{ old('modele', $shippLine->modele) }}" required>
                @if($errors->has('modele'))
                    <span class="text-danger">{{ $errors->first('modele') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.modele_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vehicle_id">{{ trans('cruds.shippLine.fields.vehicle') }}</label>
                <select class="form-control select2 {{ $errors->has('vehicle') ? 'is-invalid' : '' }}" name="vehicle_id" id="vehicle_id">
                    @foreach($vehicles as $id => $vehicle)
                        <option value="{{ $id }}" {{ (old('vehicle_id') ? old('vehicle_id') : $shippLine->vehicle->id ?? '') == $id ? 'selected' : '' }}>{{ $vehicle }}</option>
                    @endforeach
                </select>
                @if($errors->has('vehicle'))
                    <span class="text-danger">{{ $errors->first('vehicle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.vehicle_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="vin">{{ trans('cruds.shippLine.fields.vin') }}</label>
                <input class="form-control {{ $errors->has('vin') ? 'is-invalid' : '' }}" type="text" name="vin" id="vin" value="{{ old('vin', $shippLine->vin) }}" required>
                @if($errors->has('vin'))
                    <span class="text-danger">{{ $errors->first('vin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.vin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="color">{{ trans('cruds.shippLine.fields.color') }}</label>
                <input class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}" type="text" name="color" id="color" value="{{ old('color', $shippLine->color) }}">
                @if($errors->has('color'))
                    <span class="text-danger">{{ $errors->first('color') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.color_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="plates">{{ trans('cruds.shippLine.fields.plates') }}</label>
                <input class="form-control {{ $errors->has('plates') ? 'is-invalid' : '' }}" type="text" name="plates" id="plates" value="{{ old('plates', $shippLine->plates) }}" required>
                @if($errors->has('plates'))
                    <span class="text-danger">{{ $errors->first('plates') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.plates_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="loading_place">{{ trans('cruds.shippLine.fields.loading_place') }}</label>
                <input class="form-control {{ $errors->has('loading_place') ? 'is-invalid' : '' }}" type="text" name="loading_place" id="loading_place" value="{{ old('loading_place', $shippLine->loading_place) }}" required>
                @if($errors->has('loading_place'))
                    <span class="text-danger">{{ $errors->first('loading_place') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.loading_place_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="delivery_place">{{ trans('cruds.shippLine.fields.delivery_place') }}</label>
                <input class="form-control {{ $errors->has('delivery_place') ? 'is-invalid' : '' }}" type="text" name="delivery_place" id="delivery_place" value="{{ old('delivery_place', $shippLine->delivery_place) }}" required>
                @if($errors->has('delivery_place'))
                    <span class="text-danger">{{ $errors->first('delivery_place') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.delivery_place_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cmr_date">{{ trans('cruds.shippLine.fields.cmr_date') }}</label>
                <input class="form-control date {{ $errors->has('cmr_date') ? 'is-invalid' : '' }}" type="text" name="cmr_date" id="cmr_date" value="{{ old('cmr_date', $shippLine->cmr_date) }}">
                @if($errors->has('cmr_date'))
                    <span class="text-danger">{{ $errors->first('cmr_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.cmr_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.shippLine.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $shippLine->status->id ?? '') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.shippLine.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $shippLine->price) }}" step="0.01">
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('paid') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="paid" value="0">
                    <input class="form-check-input" type="checkbox" name="paid" id="paid" value="1" {{ $shippLine->paid || old('paid', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="paid">{{ trans('cruds.shippLine.fields.paid') }}</label>
                </div>
                @if($errors->has('paid'))
                    <span class="text-danger">{{ $errors->first('paid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.paid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="shippment_id">{{ trans('cruds.shippLine.fields.shippment') }}</label>
                <select class="form-control select2 {{ $errors->has('shippment') ? 'is-invalid' : '' }}" name="shippment_id" id="shippment_id" required>
                    @foreach($shippments as $id => $shippment)
                        <option value="{{ $id }}" {{ (old('shippment_id') ? old('shippment_id') : $shippLine->shippment->id ?? '') == $id ? 'selected' : '' }}>{{ $shippment }}</option>
                    @endforeach
                </select>
                @if($errors->has('shippment'))
                    <span class="text-danger">{{ $errors->first('shippment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.shippment_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.shippLine.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $shippLine->user->id ?? '') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order_id">{{ trans('cruds.shippLine.fields.order') }}</label>
                <select class="form-control select2 {{ $errors->has('order') ? 'is-invalid' : '' }}" name="order_id" id="order_id">
                    @foreach($orders as $id => $order)
                        <option value="{{ $id }}" {{ (old('order_id') ? old('order_id') : $shippLine->order->id ?? '') == $id ? 'selected' : '' }}>{{ $order }}</option>
                    @endforeach
                </select>
                @if($errors->has('order'))
                    <span class="text-danger">{{ $errors->first('order') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippLine.fields.order_helper') }}</span>
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