@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card col-10">
            <div class="card-header">
                {{ trans('global.create') }} {{ trans('cruds.address.title_singular') }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route("admin.addresses.store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card bg-light shadow-lg p-3 text-center rounded" id="card-corner">
                        <div class="row" hidden>
                            <div class="form-group col-lg-3">
                                <label class="required" for="user_create_id">{{ trans('cruds.address.fields.user_create') }}</label>
                                <select class="form-control select2 {{ $errors->has('user_create') ? 'is-invalid' : '' }}" name="user_create_id" id="user_create_id" required>
                                    @foreach($user_creates as $id => $user_create)
                                        <option value="{{ $id }}" {{ Auth::user()->id == $id ? 'selected' : '' }}>{{ $user_create }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('user_create'))
                                    <span class="text-danger">{{ $errors->first('user_create') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.address.fields.user_create_helper') }}</span>
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="required" for="user_modif_id">{{ trans('cruds.address.fields.user_modif') }}</label>
                                <select class="form-control select2 {{ $errors->has('user_modif') ? 'is-invalid' : '' }}" name="user_modif_id" id="user_modif_id" required>
                                    @foreach($user_modifs as $id => $user_modif)
                                        {{-- <option value="{{ $id }}" {{ old('user_modif_id') == $id ? 'selected' : '' }}>{{ $user_modif }}</option> --}}
                                        <option value="{{ $id }}" {{ Auth::user()->id == $id ? 'selected' : '' }}>{{ $user_modif }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('user_modif'))
                                    <span class="text-danger">{{ $errors->first('user_modif') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.address.fields.user_modif_helper') }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="societe_id">{{ trans('cruds.address.fields.societe') }}</label>
                                <select class="form-control select2 {{ $errors->has('societe') ? 'is-invalid' : '' }}" name="societe_id" id="societe_id">
                                    @foreach($societes as $id => $societe)
                                        <option value="{{ $id }}"
                                            {{ isset($companyId) && $companyId->id == $id ? 'selected' : '' }}
                                            {{ old('societe_id') == $id ? 'selected' : '' }}
                                        >{{ $societe }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('societe'))
                                    <span class="text-danger">{{ $errors->first('societe') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.address.fields.societe_helper') }}</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="required" for="entity_id">{{ trans('cruds.address.fields.entity') }}</label>
                                <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                                    @foreach($entities as $id => $entity)
                                        <option value="{{ $id }}" {{ 'RLSA' == $entity ? 'selected' : '' }}>{{ $entity }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('entity'))
                                    <span class="text-danger">{{ $errors->first('entity') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.address.fields.entity_helper') }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="individual_id">{{ trans('cruds.address.fields.individual') }}</label>
                                <select class="form-control select2 {{ $errors->has('individual') ? 'is-invalid' : '' }}" name="individual_id" id="individual_id">
                                    @foreach($individuals as $id => $individual)
                                        <option value="{{ $id }}" {{ old('individual_id') == $id ? 'selected' : '' }}>{{ $individual }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('individual'))
                                    <span class="text-danger">{{ $errors->first('individual') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.address.fields.individual_helper') }}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fonction">{{ trans('cruds.address.fields.fonction') }}</label>
                                <input class="form-control {{ $errors->has('fonction') ? 'is-invalid' : '' }}" type="text" name="fonction" id="fonction" value="{{ old('fonction', '') }}">
                                @if($errors->has('fonction'))
                                    <span class="text-danger">{{ $errors->first('fonction') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.address.fields.fonction_helper') }}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">{{ trans('cruds.address.fields.name') }}</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.address.fields.name_helper') }}</span>
                            </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="phone">{{ trans('cruds.address.fields.phone') }}</label>
                                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                                @if($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.address.fields.phone_helper') }}</span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="mobile">{{ trans('cruds.address.fields.mobile') }}</label>
                                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}">
                                @if($errors->has('mobile'))
                                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.address.fields.mobile_helper') }}</span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="email">{{ trans('cruds.address.fields.email') }}</label>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.address.fields.email_helper') }}</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tags">{{ trans('cruds.address.fields.tags') }}</label>
                                <div class="float-right">
                                    <span class="btn btn-info btn-xs select-all rounded">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all rounded">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                                    @foreach($tags as $id => $tags)
                                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tags }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('tags'))
                                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.address.fields.tags_helper') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow bg-light p-2 rounded" id="card-corner">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-7 align-self-center">
                                    <div class="form-group">
                                        <label>{{ trans('cruds.address.fields.address') }}</label>
                                        <input class="form-control" id="user_input_autocomplete_address" placeholder="Your address...">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ trans('cruds.address.fields.address_2') }}</label>
                                        <input class="form-control" name="address_2" placeholder="Your address...">
                                    </div>
                                </div>

                                <div class="card col-lg-5 shadow bg-dark text-center">
                                    <div class="row">
                                        <div class="form-group col-lg-2" >
                                            <label>Number</label>
                                            <input class="form-control" id="street_number" name="street_number" >
                                        </div>
                                        <div class="form-group col-lg-10">
                                            <label>Street</label>
                                            <input class="form-control" id="route" name="street" >
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-3">
                                            <label>{{ trans('cruds.address.fields.zip') }}</label>
                                            <input class="form-control" id="postal_code" name="zip" type="number" >
                                        </div>

                                        <div class="form-group col-lg-9">
                                            <label>{{ trans('cruds.address.fields.city') }}</label>
                                            <input class="form-control" id="locality" name="city" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label>State</label>
                                            <input class="form-control" id="administrative_area_level_2" name="state" >
                                        </div>

                                        <div class="form-group col-lg-6" id="countrydiv">
                                            <label>Country</label>
                                            <input class="form-control" id="country" name="country" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div hidden>
                                <input id="latitude" name="latitude" placeholder="latitude">
                                <input id="longitude" name="longitude" placeholder="longitude">
                                <input id="url" name="url_place" placeholder="url">
                            </div>
                        </div>
                    </div>

                    <div class="card bg-light shadow-lg p-3 rounded" id="card-corner">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="note_private">{{ trans('cruds.address.fields.note_private') }}</label>
                                <textarea class="form-control {{ $errors->has('note_private') ? 'is-invalid' : '' }}" name="note_private" id="note_private">{{ old('note_private') }}</textarea>
                                @if($errors->has('note_private'))
                                    <span class="text-danger">{{ $errors->first('note_private') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.address.fields.note_private_helper') }}</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="note_public">{{ trans('cruds.address.fields.note_public') }}</label>
                                <textarea class="form-control {{ $errors->has('note_public') ? 'is-invalid' : '' }}" name="note_public" id="note_public">{{ old('note_public') }}</textarea>
                                @if($errors->has('note_public'))
                                    <span class="text-danger">{{ $errors->first('note_public') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.address.fields.note_public_helper') }}</span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
