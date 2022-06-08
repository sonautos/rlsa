@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.version.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.versions.update", [$version->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.version.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $version->description) }}" required>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.version.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="slug">{{ trans('cruds.version.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $version->slug) }}" required>
                @if($errors->has('slug'))
                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.version.fields.slug_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="motor">{{ trans('cruds.version.fields.motor') }}</label>
                <input class="form-control {{ $errors->has('motor') ? 'is-invalid' : '' }}" type="text" name="motor" id="motor" value="{{ old('motor', $version->motor) }}" required>
                @if($errors->has('motor'))
                    <span class="text-danger">{{ $errors->first('motor') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.version.fields.motor_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="equipment">{{ trans('cruds.version.fields.equipment') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('equipment') ? 'is-invalid' : '' }}" name="equipment" id="equipment">{!! old('equipment', $version->equipment) !!}</textarea>
                @if($errors->has('equipment'))
                    <span class="text-danger">{{ $errors->first('equipment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.version.fields.equipment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kw">{{ trans('cruds.version.fields.kw') }}</label>
                <input class="form-control {{ $errors->has('kw') ? 'is-invalid' : '' }}" type="number" name="kw" id="kw" value="{{ old('kw', $version->kw) }}" step="1">
                @if($errors->has('kw'))
                    <span class="text-danger">{{ $errors->first('kw') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.version.fields.kw_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ch">{{ trans('cruds.version.fields.ch') }}</label>
                <input class="form-control {{ $errors->has('ch') ? 'is-invalid' : '' }}" type="number" name="ch" id="ch" value="{{ old('ch', $version->ch) }}" step="1">
                @if($errors->has('ch'))
                    <span class="text-danger">{{ $errors->first('ch') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.version.fields.ch_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="co_2">{{ trans('cruds.version.fields.co_2') }}</label>
                <input class="form-control {{ $errors->has('co_2') ? 'is-invalid' : '' }}" type="number" name="co_2" id="co_2" value="{{ old('co_2', $version->co_2) }}" step="1">
                @if($errors->has('co_2'))
                    <span class="text-danger">{{ $errors->first('co_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.version.fields.co_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.version.fields.energy') }}</label>
                <select class="form-control {{ $errors->has('energy') ? 'is-invalid' : '' }}" name="energy" id="energy">
                    <option value disabled {{ old('energy', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Version::ENERGY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('energy', $version->energy) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('energy'))
                    <span class="text-danger">{{ $errors->first('energy') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.version.fields.energy_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.version.fields.gear') }}</label>
                @foreach(App\Models\Version::GEAR_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('gear') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="gear_{{ $key }}" name="gear" value="{{ $key }}" {{ old('gear', $version->gear) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="gear_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('gear'))
                    <span class="text-danger">{{ $errors->first('gear') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.version.fields.gear_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="conso">{{ trans('cruds.version.fields.conso') }}</label>
                <input class="form-control {{ $errors->has('conso') ? 'is-invalid' : '' }}" type="number" name="conso" id="conso" value="{{ old('conso', $version->conso) }}" step="0.01" max="100">
                @if($errors->has('conso'))
                    <span class="text-danger">{{ $errors->first('conso') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.version.fields.conso_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prix">{{ trans('cruds.version.fields.prix') }}</label>
                <input class="form-control {{ $errors->has('prix') ? 'is-invalid' : '' }}" type="number" name="prix" id="prix" value="{{ old('prix', $version->prix) }}" step="0.01">
                @if($errors->has('prix'))
                    <span class="text-danger">{{ $errors->first('prix') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.version.fields.prix_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.version.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.version.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="make_id">{{ trans('cruds.version.fields.make') }}</label>
                <select class="form-control select2 {{ $errors->has('make') ? 'is-invalid' : '' }}" name="make_id" id="make_id" required>
                    @foreach($makes as $id => $make)
                        <option value="{{ $id }}" {{ (old('make_id') ? old('make_id') : $version->make->id ?? '') == $id ? 'selected' : '' }}>{{ $make }}</option>
                    @endforeach
                </select>
                @if($errors->has('make'))
                    <span class="text-danger">{{ $errors->first('make') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.version.fields.make_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="modele_id">{{ trans('cruds.version.fields.modele') }}</label>
                <select class="form-control select2 {{ $errors->has('modele') ? 'is-invalid' : '' }}" name="modele_id" id="modele_id" required>
                    @foreach($modeles as $id => $modele)
                        <option value="{{ $id }}" {{ (old('modele_id') ? old('modele_id') : $version->modele->id ?? '') == $id ? 'selected' : '' }}>{{ $modele }}</option>
                    @endforeach
                </select>
                @if($errors->has('modele'))
                    <span class="text-danger">{{ $errors->first('modele') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.version.fields.modele_helper') }}</span>
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
                xhr.open('POST', '/admin/versions/ckmedia', true);
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
                data.append('crud_id', '{{ $version->id ?? 0 }}');
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

<script>
    var uploadedImageMap = {}
Dropzone.options.imageDropzone = {
    url: '{{ route('admin.versions.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="image[]" value="' + response.name + '">')
      uploadedImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImageMap[file.name]
      }
      $('form').find('input[name="image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($version) && $version->image)
      var files = {!! json_encode($version->image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="image[]" value="' + file.file_name + '">')
        }
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