@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ordersList.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders-lists.update", [$ordersList->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="ref">{{ trans('cruds.ordersList.fields.ref') }}</label>
                <input class="form-control {{ $errors->has('ref') ? 'is-invalid' : '' }}" type="text" name="ref" id="ref" value="{{ old('ref', $ordersList->ref) }}" required>
                @if($errors->has('ref'))
                    <span class="text-danger">{{ $errors->first('ref') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.ref_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="entity_id">{{ trans('cruds.ordersList.fields.entity') }}</label>
                <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                    @foreach($entities as $id => $entity)
                        <option value="{{ $id }}" {{ (old('entity_id') ? old('entity_id') : $ordersList->entity->id ?? '') == $id ? 'selected' : '' }}>{{ $entity }}</option>
                    @endforeach
                </select>
                @if($errors->has('entity'))
                    <span class="text-danger">{{ $errors->first('entity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="seller_id">{{ trans('cruds.ordersList.fields.seller') }}</label>
                <select class="form-control select2 {{ $errors->has('seller') ? 'is-invalid' : '' }}" name="seller_id" id="seller_id" required>
                    @foreach($sellers as $id => $seller)
                        <option value="{{ $id }}" {{ (old('seller_id') ? old('seller_id') : $ordersList->seller->id ?? '') == $id ? 'selected' : '' }}>{{ $seller }}</option>
                    @endforeach
                </select>
                @if($errors->has('seller'))
                    <span class="text-danger">{{ $errors->first('seller') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.seller_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.ordersList.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $ordersList->client->id ?? '') == $id ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="task_id">{{ trans('cruds.ordersList.fields.task') }}</label>
                <select class="form-control select2 {{ $errors->has('task') ? 'is-invalid' : '' }}" name="task_id" id="task_id">
                    @foreach($tasks as $id => $task)
                        <option value="{{ $id }}" {{ (old('task_id') ? old('task_id') : $ordersList->task->id ?? '') == $id ? 'selected' : '' }}>{{ $task }}</option>
                    @endforeach
                </select>
                @if($errors->has('task'))
                    <span class="text-danger">{{ $errors->first('task') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.task_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_created">{{ trans('cruds.ordersList.fields.date_created') }}</label>
                <input class="form-control date {{ $errors->has('date_created') ? 'is-invalid' : '' }}" type="text" name="date_created" id="date_created" value="{{ old('date_created', $ordersList->date_created) }}" required>
                @if($errors->has('date_created'))
                    <span class="text-danger">{{ $errors->first('date_created') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.date_created_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_valid">{{ trans('cruds.ordersList.fields.date_valid') }}</label>
                <input class="form-control date {{ $errors->has('date_valid') ? 'is-invalid' : '' }}" type="text" name="date_valid" id="date_valid" value="{{ old('date_valid', $ordersList->date_valid) }}">
                @if($errors->has('date_valid'))
                    <span class="text-danger">{{ $errors->first('date_valid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.date_valid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="author_id">{{ trans('cruds.ordersList.fields.author') }}</label>
                <select class="form-control select2 {{ $errors->has('author') ? 'is-invalid' : '' }}" name="author_id" id="author_id" required>
                    @foreach($authors as $id => $author)
                        <option value="{{ $id }}" {{ (old('author_id') ? old('author_id') : $ordersList->author->id ?? '') == $id ? 'selected' : '' }}>{{ $author }}</option>
                    @endforeach
                </select>
                @if($errors->has('author'))
                    <span class="text-danger">{{ $errors->first('author') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.author_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="valid_id">{{ trans('cruds.ordersList.fields.valid') }}</label>
                <select class="form-control select2 {{ $errors->has('valid') ? 'is-invalid' : '' }}" name="valid_id" id="valid_id">
                    @foreach($valids as $id => $valid)
                        <option value="{{ $id }}" {{ (old('valid_id') ? old('valid_id') : $ordersList->valid->id ?? '') == $id ? 'selected' : '' }}>{{ $valid }}</option>
                    @endforeach
                </select>
                @if($errors->has('valid'))
                    <span class="text-danger">{{ $errors->first('valid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.valid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_updated_id">{{ trans('cruds.ordersList.fields.user_updated') }}</label>
                <select class="form-control select2 {{ $errors->has('user_updated') ? 'is-invalid' : '' }}" name="user_updated_id" id="user_updated_id">
                    @foreach($user_updateds as $id => $user_updated)
                        <option value="{{ $id }}" {{ (old('user_updated_id') ? old('user_updated_id') : $ordersList->user_updated->id ?? '') == $id ? 'selected' : '' }}>{{ $user_updated }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_updated'))
                    <span class="text-danger">{{ $errors->first('user_updated') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.user_updated_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.ordersList.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $ordersList->status->id ?? '') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_ht">{{ trans('cruds.ordersList.fields.total_ht') }}</label>
                <input class="form-control {{ $errors->has('total_ht') ? 'is-invalid' : '' }}" type="number" name="total_ht" id="total_ht" value="{{ old('total_ht', $ordersList->total_ht) }}" step="0.01">
                @if($errors->has('total_ht'))
                    <span class="text-danger">{{ $errors->first('total_ht') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.total_ht_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tva">{{ trans('cruds.ordersList.fields.tva') }}</label>
                <input class="form-control {{ $errors->has('tva') ? 'is-invalid' : '' }}" type="number" name="tva" id="tva" value="{{ old('tva', $ordersList->tva) }}" step="0.01">
                @if($errors->has('tva'))
                    <span class="text-danger">{{ $errors->first('tva') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.tva_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_ttc">{{ trans('cruds.ordersList.fields.total_ttc') }}</label>
                <input class="form-control {{ $errors->has('total_ttc') ? 'is-invalid' : '' }}" type="number" name="total_ttc" id="total_ttc" value="{{ old('total_ttc', $ordersList->total_ttc) }}" step="0.01">
                @if($errors->has('total_ttc'))
                    <span class="text-danger">{{ $errors->first('total_ttc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.total_ttc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remise">{{ trans('cruds.ordersList.fields.remise') }}</label>
                <input class="form-control {{ $errors->has('remise') ? 'is-invalid' : '' }}" type="number" name="remise" id="remise" value="{{ old('remise', $ordersList->remise) }}" step="0.01">
                @if($errors->has('remise'))
                    <span class="text-danger">{{ $errors->first('remise') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.remise_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remise_percent">{{ trans('cruds.ordersList.fields.remise_percent') }}</label>
                <input class="form-control {{ $errors->has('remise_percent') ? 'is-invalid' : '' }}" type="number" name="remise_percent" id="remise_percent" value="{{ old('remise_percent', $ordersList->remise_percent) }}" step="0.01">
                @if($errors->has('remise_percent'))
                    <span class="text-danger">{{ $errors->first('remise_percent') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.remise_percent_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cond_reglement_id">{{ trans('cruds.ordersList.fields.cond_reglement') }}</label>
                <select class="form-control select2 {{ $errors->has('cond_reglement') ? 'is-invalid' : '' }}" name="cond_reglement_id" id="cond_reglement_id">
                    @foreach($cond_reglements as $id => $cond_reglement)
                        <option value="{{ $id }}" {{ (old('cond_reglement_id') ? old('cond_reglement_id') : $ordersList->cond_reglement->id ?? '') == $id ? 'selected' : '' }}>{{ $cond_reglement }}</option>
                    @endforeach
                </select>
                @if($errors->has('cond_reglement'))
                    <span class="text-danger">{{ $errors->first('cond_reglement') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.cond_reglement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mode_reglement_id">{{ trans('cruds.ordersList.fields.mode_reglement') }}</label>
                <select class="form-control select2 {{ $errors->has('mode_reglement') ? 'is-invalid' : '' }}" name="mode_reglement_id" id="mode_reglement_id">
                    @foreach($mode_reglements as $id => $mode_reglement)
                        <option value="{{ $id }}" {{ (old('mode_reglement_id') ? old('mode_reglement_id') : $ordersList->mode_reglement->id ?? '') == $id ? 'selected' : '' }}>{{ $mode_reglement }}</option>
                    @endforeach
                </select>
                @if($errors->has('mode_reglement'))
                    <span class="text-danger">{{ $errors->first('mode_reglement') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.mode_reglement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note_private">{{ trans('cruds.ordersList.fields.note_private') }}</label>
                <textarea class="form-control {{ $errors->has('note_private') ? 'is-invalid' : '' }}" name="note_private" id="note_private">{{ old('note_private', $ordersList->note_private) }}</textarea>
                @if($errors->has('note_private'))
                    <span class="text-danger">{{ $errors->first('note_private') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.note_private_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note_public">{{ trans('cruds.ordersList.fields.note_public') }}</label>
                <textarea class="form-control {{ $errors->has('note_public') ? 'is-invalid' : '' }}" name="note_public" id="note_public">{{ old('note_public', $ordersList->note_public) }}</textarea>
                @if($errors->has('note_public'))
                    <span class="text-danger">{{ $errors->first('note_public') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.note_public_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_livraison">{{ trans('cruds.ordersList.fields.date_livraison') }}</label>
                <input class="form-control date {{ $errors->has('date_livraison') ? 'is-invalid' : '' }}" type="text" name="date_livraison" id="date_livraison" value="{{ old('date_livraison', $ordersList->date_livraison) }}">
                @if($errors->has('date_livraison'))
                    <span class="text-danger">{{ $errors->first('date_livraison') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.date_livraison_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shipping_method_id">{{ trans('cruds.ordersList.fields.shipping_method') }}</label>
                <select class="form-control select2 {{ $errors->has('shipping_method') ? 'is-invalid' : '' }}" name="shipping_method_id" id="shipping_method_id">
                    @foreach($shipping_methods as $id => $shipping_method)
                        <option value="{{ $id }}" {{ (old('shipping_method_id') ? old('shipping_method_id') : $ordersList->shipping_method->id ?? '') == $id ? 'selected' : '' }}>{{ $shipping_method }}</option>
                    @endforeach
                </select>
                @if($errors->has('shipping_method'))
                    <span class="text-danger">{{ $errors->first('shipping_method') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.shipping_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="delivery_address_id">{{ trans('cruds.ordersList.fields.delivery_address') }}</label>
                <select class="form-control select2 {{ $errors->has('delivery_address') ? 'is-invalid' : '' }}" name="delivery_address_id" id="delivery_address_id">
                    @foreach($delivery_addresses as $id => $delivery_address)
                        <option value="{{ $id }}" {{ (old('delivery_address_id') ? old('delivery_address_id') : $ordersList->delivery_address->id ?? '') == $id ? 'selected' : '' }}>{{ $delivery_address }}</option>
                    @endforeach
                </select>
                @if($errors->has('delivery_address'))
                    <span class="text-danger">{{ $errors->first('delivery_address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.delivery_address_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('signed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="signed" value="0">
                    <input class="form-check-input" type="checkbox" name="signed" id="signed" value="1" {{ $ordersList->signed || old('signed', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="signed">{{ trans('cruds.ordersList.fields.signed') }}</label>
                </div>
                @if($errors->has('signed'))
                    <span class="text-danger">{{ $errors->first('signed') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ordersList.fields.signed_helper') }}</span>
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