@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.individual.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.individuals.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="societe_id">{{ trans('cruds.individual.fields.societe') }}</label>
                <select class="form-control select2 {{ $errors->has('societe') ? 'is-invalid' : '' }}" name="societe_id" id="societe_id">
                    @foreach($societes as $id => $societe)
                        <option value="{{ $id }}" {{ old('societe_id') == $id ? 'selected' : '' }}>{{ $societe }}</option>
                    @endforeach
                </select>
                @if($errors->has('societe'))
                    <span class="text-danger">{{ $errors->first('societe') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.societe_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="entity_id">{{ trans('cruds.individual.fields.entity') }}</label>
                <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                    @foreach($entities as $id => $entity)
                        <option value="{{ $id }}" {{ old('entity_id') == $id ? 'selected' : '' }}>{{ $entity }}</option>
                    @endforeach
                </select>
                @if($errors->has('entity'))
                    <span class="text-danger">{{ $errors->first('entity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.individual.fields.civility') }}</label>
                @foreach(App\Models\Individual::CIVILITY_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('civility') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="civility_{{ $key }}" name="civility" value="{{ $key }}" {{ old('civility', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="civility_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('civility'))
                    <span class="text-danger">{{ $errors->first('civility') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.civility_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="firstname">{{ trans('cruds.individual.fields.firstname') }}</label>
                <input class="form-control {{ $errors->has('firstname') ? 'is-invalid' : '' }}" type="text" name="firstname" id="firstname" value="{{ old('firstname', '') }}">
                @if($errors->has('firstname'))
                    <span class="text-danger">{{ $errors->first('firstname') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.firstname_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lastname">{{ trans('cruds.individual.fields.lastname') }}</label>
                <input class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" type="text" name="lastname" id="lastname" value="{{ old('lastname', '') }}" required>
                @if($errors->has('lastname'))
                    <span class="text-danger">{{ $errors->first('lastname') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.lastname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.individual.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}">
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_2">{{ trans('cruds.individual.fields.address_2') }}</label>
                <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', '') }}">
                @if($errors->has('address_2'))
                    <span class="text-danger">{{ $errors->first('address_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.address_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="zip">{{ trans('cruds.individual.fields.zip') }}</label>
                <input class="form-control {{ $errors->has('zip') ? 'is-invalid' : '' }}" type="number" name="zip" id="zip" value="{{ old('zip', '') }}" step="1">
                @if($errors->has('zip'))
                    <span class="text-danger">{{ $errors->first('zip') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.zip_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.individual.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}">
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="state">{{ trans('cruds.individual.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', '') }}">
                @if($errors->has('state'))
                    <span class="text-danger">{{ $errors->first('state') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country">{{ trans('cruds.individual.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', '') }}">
                @if($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="poste">{{ trans('cruds.individual.fields.poste') }}</label>
                <input class="form-control {{ $errors->has('poste') ? 'is-invalid' : '' }}" type="text" name="poste" id="poste" value="{{ old('poste', '') }}">
                @if($errors->has('poste'))
                    <span class="text-danger">{{ $errors->first('poste') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.poste_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.individual.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mobile">{{ trans('cruds.individual.fields.mobile') }}</label>
                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}">
                @if($errors->has('mobile'))
                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.individual.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_create_id">{{ trans('cruds.individual.fields.user_create') }}</label>
                <select class="form-control select2 {{ $errors->has('user_create') ? 'is-invalid' : '' }}" name="user_create_id" id="user_create_id" required>
                    @foreach($user_creates as $id => $user_create)
                        <option value="{{ $id }}" {{ old('user_create_id') == $id ? 'selected' : '' }}>{{ $user_create }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_create'))
                    <span class="text-danger">{{ $errors->first('user_create') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.user_create_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_modif_id">{{ trans('cruds.individual.fields.user_modif') }}</label>
                <select class="form-control select2 {{ $errors->has('user_modif') ? 'is-invalid' : '' }}" name="user_modif_id" id="user_modif_id" required>
                    @foreach($user_modifs as $id => $user_modif)
                        <option value="{{ $id }}" {{ old('user_modif_id') == $id ? 'selected' : '' }}>{{ $user_modif }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_modif'))
                    <span class="text-danger">{{ $errors->first('user_modif') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.user_modif_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note_private">{{ trans('cruds.individual.fields.note_private') }}</label>
                <textarea class="form-control {{ $errors->has('note_private') ? 'is-invalid' : '' }}" name="note_private" id="note_private">{{ old('note_private') }}</textarea>
                @if($errors->has('note_private'))
                    <span class="text-danger">{{ $errors->first('note_private') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.note_private_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note_public">{{ trans('cruds.individual.fields.note_public') }}</label>
                <textarea class="form-control {{ $errors->has('note_public') ? 'is-invalid' : '' }}" name="note_public" id="note_public">{{ old('note_public') }}</textarea>
                @if($errors->has('note_public'))
                    <span class="text-danger">{{ $errors->first('note_public') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.note_public_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.individual.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.individual.fields.tags') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tags)
                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tags }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.tags_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.individual.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude', '') }}">
                @if($errors->has('latitude'))
                    <span class="text-danger">{{ $errors->first('latitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.individual.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text" name="longitude" id="longitude" value="{{ old('longitude', '') }}">
                @if($errors->has('longitude'))
                    <span class="text-danger">{{ $errors->first('longitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url_place">{{ trans('cruds.individual.fields.url_place') }}</label>
                <input class="form-control {{ $errors->has('url_place') ? 'is-invalid' : '' }}" type="text" name="url_place" id="url_place" value="{{ old('url_place', '') }}">
                @if($errors->has('url_place'))
                    <span class="text-danger">{{ $errors->first('url_place') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.individual.fields.url_place_helper') }}</span>
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
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.individuals.storeMedia') }}',
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
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($individual) && $individual->photo)
      var file = {!! json_encode($individual->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
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