@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.entity.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.entities.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.entity.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alias">{{ trans('cruds.entity.fields.alias') }}</label>
                <input class="form-control {{ $errors->has('alias') ? 'is-invalid' : '' }}" type="text" name="alias" id="alias" value="{{ old('alias', '') }}">
                @if($errors->has('alias'))
                    <span class="text-danger">{{ $errors->first('alias') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.alias_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('supplier') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="supplier" id="supplier" value="1" required {{ old('supplier', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="supplier">{{ trans('cruds.entity.fields.supplier') }}</label>
                </div>
                @if($errors->has('supplier'))
                    <span class="text-danger">{{ $errors->first('supplier') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.supplier_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status">{{ trans('cruds.entity.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="number" name="status" id="status" value="{{ old('status', '') }}" step="1" required>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parent">{{ trans('cruds.entity.fields.parent') }}</label>
                <input class="form-control {{ $errors->has('parent') ? 'is-invalid' : '' }}" type="number" name="parent" id="parent" value="{{ old('parent', '') }}" step="1">
                @if($errors->has('parent'))
                    <span class="text-danger">{{ $errors->first('parent') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.parent_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="code_client">{{ trans('cruds.entity.fields.code_client') }}</label>
                <input class="form-control {{ $errors->has('code_client') ? 'is-invalid' : '' }}" type="text" name="code_client" id="code_client" value="{{ old('code_client', '') }}">
                @if($errors->has('code_client'))
                    <span class="text-danger">{{ $errors->first('code_client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.code_client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="code_supplier">{{ trans('cruds.entity.fields.code_supplier') }}</label>
                <input class="form-control {{ $errors->has('code_supplier') ? 'is-invalid' : '' }}" type="text" name="code_supplier" id="code_supplier" value="{{ old('code_supplier', '') }}">
                @if($errors->has('code_supplier'))
                    <span class="text-danger">{{ $errors->first('code_supplier') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.code_supplier_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.entity.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_2">{{ trans('cruds.entity.fields.address_2') }}</label>
                <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', '') }}">
                @if($errors->has('address_2'))
                    <span class="text-danger">{{ $errors->first('address_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.address_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="zip">{{ trans('cruds.entity.fields.zip') }}</label>
                <input class="form-control {{ $errors->has('zip') ? 'is-invalid' : '' }}" type="text" name="zip" id="zip" value="{{ old('zip', '') }}" required>
                @if($errors->has('zip'))
                    <span class="text-danger">{{ $errors->first('zip') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.zip_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.entity.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="state">{{ trans('cruds.entity.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', '') }}">
                @if($errors->has('state'))
                    <span class="text-danger">{{ $errors->first('state') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country">{{ trans('cruds.entity.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', '') }}">
                @if($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.entity.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude', '') }}">
                @if($errors->has('latitude'))
                    <span class="text-danger">{{ $errors->first('latitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.entity.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text" name="longitude" id="longitude" value="{{ old('longitude', '') }}">
                @if($errors->has('longitude'))
                    <span class="text-danger">{{ $errors->first('longitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url_place">{{ trans('cruds.entity.fields.url_place') }}</label>
                <input class="form-control {{ $errors->has('url_place') ? 'is-invalid' : '' }}" type="text" name="url_place" id="url_place" value="{{ old('url_place', '') }}">
                @if($errors->has('url_place'))
                    <span class="text-danger">{{ $errors->first('url_place') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.url_place_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.entity.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.entity.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="siren">{{ trans('cruds.entity.fields.siren') }}</label>
                <input class="form-control {{ $errors->has('siren') ? 'is-invalid' : '' }}" type="text" name="siren" id="siren" value="{{ old('siren', '') }}">
                @if($errors->has('siren'))
                    <span class="text-danger">{{ $errors->first('siren') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.siren_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="siret">{{ trans('cruds.entity.fields.siret') }}</label>
                <input class="form-control {{ $errors->has('siret') ? 'is-invalid' : '' }}" type="text" name="siret" id="siret" value="{{ old('siret', '') }}">
                @if($errors->has('siret'))
                    <span class="text-danger">{{ $errors->first('siret') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.siret_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ape">{{ trans('cruds.entity.fields.ape') }}</label>
                <input class="form-control {{ $errors->has('ape') ? 'is-invalid' : '' }}" type="text" name="ape" id="ape" value="{{ old('ape', '') }}">
                @if($errors->has('ape'))
                    <span class="text-danger">{{ $errors->first('ape') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.ape_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="vatnumber">{{ trans('cruds.entity.fields.vatnumber') }}</label>
                <input class="form-control {{ $errors->has('vatnumber') ? 'is-invalid' : '' }}" type="text" name="vatnumber" id="vatnumber" value="{{ old('vatnumber', '') }}" required>
                @if($errors->has('vatnumber'))
                    <span class="text-danger">{{ $errors->first('vatnumber') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.vatnumber_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="capital">{{ trans('cruds.entity.fields.capital') }}</label>
                <input class="form-control {{ $errors->has('capital') ? 'is-invalid' : '' }}" type="number" name="capital" id="capital" value="{{ old('capital', '') }}" step="0.01">
                @if($errors->has('capital'))
                    <span class="text-danger">{{ $errors->first('capital') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.capital_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note_private">{{ trans('cruds.entity.fields.note_private') }}</label>
                <textarea class="form-control {{ $errors->has('note_private') ? 'is-invalid' : '' }}" name="note_private" id="note_private">{{ old('note_private') }}</textarea>
                @if($errors->has('note_private'))
                    <span class="text-danger">{{ $errors->first('note_private') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.note_private_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note_public">{{ trans('cruds.entity.fields.note_public') }}</label>
                <textarea class="form-control {{ $errors->has('note_public') ? 'is-invalid' : '' }}" name="note_public" id="note_public">{{ old('note_public') }}</textarea>
                @if($errors->has('note_public'))
                    <span class="text-danger">{{ $errors->first('note_public') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.note_public_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ old('active', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">{{ trans('cruds.entity.fields.active') }}</label>
                </div>
                @if($errors->has('active'))
                    <span class="text-danger">{{ $errors->first('active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.entity.fields.active_helper') }}</span>
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