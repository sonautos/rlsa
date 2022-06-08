@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.color.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.colors.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.color.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.color.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="code">{{ trans('cruds.color.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}">
                @if($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.color.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.color.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.color.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url_image">{{ trans('cruds.color.fields.url_image') }}</label>
                <input class="form-control {{ $errors->has('url_image') ? 'is-invalid' : '' }}" type="text" name="url_image" id="url_image" value="{{ old('url_image', '') }}">
                @if($errors->has('url_image'))
                    <span class="text-danger">{{ $errors->first('url_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.color.fields.url_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="make_id">{{ trans('cruds.color.fields.make') }}</label>
                <select class="form-control select2 {{ $errors->has('make') ? 'is-invalid' : '' }}" name="make_id" id="make_id">
                    @foreach($makes as $id => $make)
                        <option value="{{ $id }}" {{ old('make_id') == $id ? 'selected' : '' }}>{{ $make }}</option>
                    @endforeach
                </select>
                @if($errors->has('make'))
                    <span class="text-danger">{{ $errors->first('make') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.color.fields.make_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="modele_id">{{ trans('cruds.color.fields.modele') }}</label>
                <select class="form-control select2 {{ $errors->has('modele') ? 'is-invalid' : '' }}" name="modele_id" id="modele_id">
                    @foreach($modeles as $id => $modele)
                        <option value="{{ $id }}" {{ old('modele_id') == $id ? 'selected' : '' }}>{{ $modele }}</option>
                    @endforeach
                </select>
                @if($errors->has('modele'))
                    <span class="text-danger">{{ $errors->first('modele') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.color.fields.modele_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.colors.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($color) && $color->image)
      var file = {!! json_encode($color->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection