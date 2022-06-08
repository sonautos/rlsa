@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.codeModel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.code-models.update", [$codeModel->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.codeModel.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $codeModel->code) }}" required>
                @if($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.codeModel.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="make_id">{{ trans('cruds.codeModel.fields.make') }}</label>
                <select class="form-control select2 {{ $errors->has('make') ? 'is-invalid' : '' }}" name="make_id" id="make_id" required>
                    @foreach($makes as $id => $make)
                        <option value="{{ $id }}" {{ (old('make_id') ? old('make_id') : $codeModel->make->id ?? '') == $id ? 'selected' : '' }}>{{ $make }}</option>
                    @endforeach
                </select>
                @if($errors->has('make'))
                    <span class="text-danger">{{ $errors->first('make') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.codeModel.fields.make_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="modele_id">{{ trans('cruds.codeModel.fields.modele') }}</label>
                <select class="form-control select2 {{ $errors->has('modele') ? 'is-invalid' : '' }}" name="modele_id" id="modele_id" required>
                    @foreach($modeles as $id => $modele)
                        <option value="{{ $id }}" {{ (old('modele_id') ? old('modele_id') : $codeModel->modele->id ?? '') == $id ? 'selected' : '' }}>{{ $modele }}</option>
                    @endforeach
                </select>
                @if($errors->has('modele'))
                    <span class="text-danger">{{ $errors->first('modele') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.codeModel.fields.modele_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="version_id">{{ trans('cruds.codeModel.fields.version') }}</label>
                <select class="form-control select2 {{ $errors->has('version') ? 'is-invalid' : '' }}" name="version_id" id="version_id" required>
                    @foreach($versions as $id => $version)
                        <option value="{{ $id }}" {{ (old('version_id') ? old('version_id') : $codeModel->version->id ?? '') == $id ? 'selected' : '' }}>{{ $version }}</option>
                    @endforeach
                </select>
                @if($errors->has('version'))
                    <span class="text-danger">{{ $errors->first('version') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.codeModel.fields.version_helper') }}</span>
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