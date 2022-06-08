@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.modele.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.modeles.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.modele.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.modele.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="slug">{{ trans('cruds.modele.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}">
                @if($errors->has('slug'))
                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.modele.fields.slug_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="make_id">{{ trans('cruds.modele.fields.make') }}</label>
                <select class="form-control select2 {{ $errors->has('make') ? 'is-invalid' : '' }}" name="make_id" id="make_id" required>
                    @foreach($makes as $id => $make)
                        <option value="{{ $id }}" {{ old('make_id') == $id ? 'selected' : '' }}>{{ $make }}</option>
                    @endforeach
                </select>
                @if($errors->has('make'))
                    <span class="text-danger">{{ $errors->first('make') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.modele.fields.make_helper') }}</span>
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