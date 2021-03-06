@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.feature.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.features.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="make_id">{{ trans('cruds.feature.fields.make') }}</label>
                <select class="form-control select2 {{ $errors->has('make') ? 'is-invalid' : '' }}" name="make_id" id="make_id" required>
                    @foreach($makes as $id => $make)
                        <option value="{{ $id }}" {{ old('make_id') == $id ? 'selected' : '' }}>{{ $make }}</option>
                    @endforeach
                </select>
                @if($errors->has('make'))
                    <span class="text-danger">{{ $errors->first('make') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.feature.fields.make_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="modele_id">{{ trans('cruds.feature.fields.modele') }}</label>
                <select class="form-control select2 {{ $errors->has('modele') ? 'is-invalid' : '' }}" name="modele_id" id="modele_id" required>
                    @foreach($modeles as $id => $modele)
                        <option value="{{ $id }}" {{ old('modele_id') == $id ? 'selected' : '' }}>{{ $modele }}</option>
                    @endforeach
                </select>
                @if($errors->has('modele'))
                    <span class="text-danger">{{ $errors->first('modele') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.feature.fields.modele_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.feature.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                @if($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.feature.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.feature.fields.name') }}</label>
                <textarea class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name" required>{{ old('name') }}</textarea>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.feature.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.feature.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.feature.fields.description_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/features/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $feature->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection