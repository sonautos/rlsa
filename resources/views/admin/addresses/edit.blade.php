@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.address.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.addresses.update", [$address->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="societe_id">{{ trans('cruds.address.fields.societe') }}</label>
                <select class="form-control select2 {{ $errors->has('societe') ? 'is-invalid' : '' }}" name="societe_id" id="societe_id">
                    @foreach($societes as $id => $societe)
                        <option value="{{ $id }}" {{ (old('societe_id') ? old('societe_id') : $address->societe->id ?? '') == $id ? 'selected' : '' }}>{{ $societe }}</option>
                    @endforeach
                </select>
                @if($errors->has('societe'))
                    <span class="text-danger">{{ $errors->first('societe') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.societe_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="entity_id">{{ trans('cruds.address.fields.entity') }}</label>
                <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                    @foreach($entities as $id => $entity)
                        <option value="{{ $id }}" {{ (old('entity_id') ? old('entity_id') : $address->entity->id ?? '') == $id ? 'selected' : '' }}>{{ $entity }}</option>
                    @endforeach
                </select>
                @if($errors->has('entity'))
                    <span class="text-danger">{{ $errors->first('entity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="individual_id">{{ trans('cruds.address.fields.individual') }}</label>
                <select class="form-control select2 {{ $errors->has('individual') ? 'is-invalid' : '' }}" name="individual_id" id="individual_id">
                    @foreach($individuals as $id => $individual)
                        <option value="{{ $id }}" {{ (old('individual_id') ? old('individual_id') : $address->individual->id ?? '') == $id ? 'selected' : '' }}>{{ $individual }}</option>
                    @endforeach
                </select>
                @if($errors->has('individual'))
                    <span class="text-danger">{{ $errors->first('individual') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.individual_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fonction">{{ trans('cruds.address.fields.fonction') }}</label>
                <input class="form-control {{ $errors->has('fonction') ? 'is-invalid' : '' }}" type="text" name="fonction" id="fonction" value="{{ old('fonction', $address->fonction) }}">
                @if($errors->has('fonction'))
                    <span class="text-danger">{{ $errors->first('fonction') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.fonction_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.address.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $address->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.address.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $address->address) }}">
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_2">{{ trans('cruds.address.fields.address_2') }}</label>
                <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', $address->address_2) }}">
                @if($errors->has('address_2'))
                    <span class="text-danger">{{ $errors->first('address_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.address_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="zip">{{ trans('cruds.address.fields.zip') }}</label>
                <input class="form-control {{ $errors->has('zip') ? 'is-invalid' : '' }}" type="number" name="zip" id="zip" value="{{ old('zip', $address->zip) }}" step="1">
                @if($errors->has('zip'))
                    <span class="text-danger">{{ $errors->first('zip') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.zip_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.address.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $address->city) }}">
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="state">{{ trans('cruds.address.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', $address->state) }}">
                @if($errors->has('state'))
                    <span class="text-danger">{{ $errors->first('state') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country">{{ trans('cruds.address.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', $address->country) }}">
                @if($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.address.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $address->phone) }}">
                @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mobile">{{ trans('cruds.address.fields.mobile') }}</label>
                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $address->mobile) }}">
                @if($errors->has('mobile'))
                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.address.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $address->email) }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_create_id">{{ trans('cruds.address.fields.user_create') }}</label>
                <select class="form-control select2 {{ $errors->has('user_create') ? 'is-invalid' : '' }}" name="user_create_id" id="user_create_id" required>
                    @foreach($user_creates as $id => $user_create)
                        <option value="{{ $id }}" {{ (old('user_create_id') ? old('user_create_id') : $address->user_create->id ?? '') == $id ? 'selected' : '' }}>{{ $user_create }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_create'))
                    <span class="text-danger">{{ $errors->first('user_create') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.user_create_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_modif_id">{{ trans('cruds.address.fields.user_modif') }}</label>
                <select class="form-control select2 {{ $errors->has('user_modif') ? 'is-invalid' : '' }}" name="user_modif_id" id="user_modif_id" required>
                    @foreach($user_modifs as $id => $user_modif)
                        <option value="{{ $id }}" {{ (old('user_modif_id') ? old('user_modif_id') : $address->user_modif->id ?? '') == $id ? 'selected' : '' }}>{{ $user_modif }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_modif'))
                    <span class="text-danger">{{ $errors->first('user_modif') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.user_modif_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note_private">{{ trans('cruds.address.fields.note_private') }}</label>
                <textarea class="form-control {{ $errors->has('note_private') ? 'is-invalid' : '' }}" name="note_private" id="note_private">{{ old('note_private', $address->note_private) }}</textarea>
                @if($errors->has('note_private'))
                    <span class="text-danger">{{ $errors->first('note_private') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.note_private_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note_public">{{ trans('cruds.address.fields.note_public') }}</label>
                <textarea class="form-control {{ $errors->has('note_public') ? 'is-invalid' : '' }}" name="note_public" id="note_public">{{ old('note_public', $address->note_public) }}</textarea>
                @if($errors->has('note_public'))
                    <span class="text-danger">{{ $errors->first('note_public') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.note_public_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.address.fields.tags') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tags)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $address->tags->contains($id)) ? 'selected' : '' }}>{{ $tags }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.tags_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.address.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude', $address->latitude) }}">
                @if($errors->has('latitude'))
                    <span class="text-danger">{{ $errors->first('latitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.address.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text" name="longitude" id="longitude" value="{{ old('longitude', $address->longitude) }}">
                @if($errors->has('longitude'))
                    <span class="text-danger">{{ $errors->first('longitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url_place">{{ trans('cruds.address.fields.url_place') }}</label>
                <input class="form-control {{ $errors->has('url_place') ? 'is-invalid' : '' }}" type="text" name="url_place" id="url_place" value="{{ old('url_place', $address->url_place) }}">
                @if($errors->has('url_place'))
                    <span class="text-danger">{{ $errors->first('url_place') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.url_place_helper') }}</span>
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