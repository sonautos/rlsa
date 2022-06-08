@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.shippmentslist.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.shippmentslists.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="ref">{{ trans('cruds.shippmentslist.fields.ref') }}</label>
                <input class="form-control {{ $errors->has('ref') ? 'is-invalid' : '' }}" type="text" name="ref" id="ref" value="{{ old('ref', '') }}" required>
                @if($errors->has('ref'))
                    <span class="text-danger">{{ $errors->first('ref') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippmentslist.fields.ref_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="entity_id">{{ trans('cruds.shippmentslist.fields.entity') }}</label>
                <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                    @foreach($entities as $id => $entity)
                        <option value="{{ $id }}" {{ old('entity_id') == $id ? 'selected' : '' }}>{{ $entity }}</option>
                    @endforeach
                </select>
                @if($errors->has('entity'))
                    <span class="text-danger">{{ $errors->first('entity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippmentslist.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.shippmentslist.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippmentslist.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.shippmentslist.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippmentslist.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note_private">{{ trans('cruds.shippmentslist.fields.note_private') }}</label>
                <textarea class="form-control {{ $errors->has('note_private') ? 'is-invalid' : '' }}" name="note_private" id="note_private">{{ old('note_private') }}</textarea>
                @if($errors->has('note_private'))
                    <span class="text-danger">{{ $errors->first('note_private') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippmentslist.fields.note_private_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note_public">{{ trans('cruds.shippmentslist.fields.note_public') }}</label>
                <textarea class="form-control {{ $errors->has('note_public') ? 'is-invalid' : '' }}" name="note_public" id="note_public">{{ old('note_public') }}</textarea>
                @if($errors->has('note_public'))
                    <span class="text-danger">{{ $errors->first('note_public') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippmentslist.fields.note_public_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_delivery">{{ trans('cruds.shippmentslist.fields.date_delivery') }}</label>
                <input class="form-control date {{ $errors->has('date_delivery') ? 'is-invalid' : '' }}" type="text" name="date_delivery" id="date_delivery" value="{{ old('date_delivery') }}" required>
                @if($errors->has('date_delivery'))
                    <span class="text-danger">{{ $errors->first('date_delivery') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shippmentslist.fields.date_delivery_helper') }}</span>
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