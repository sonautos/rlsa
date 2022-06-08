@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tagContact.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tag-contacts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="tag">{{ trans('cruds.tagContact.fields.tag') }}</label>
                <input class="form-control {{ $errors->has('tag') ? 'is-invalid' : '' }}" type="text" name="tag" id="tag" value="{{ old('tag', '') }}" required>
                @if($errors->has('tag'))
                    <span class="text-danger">{{ $errors->first('tag') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tagContact.fields.tag_helper') }}</span>
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