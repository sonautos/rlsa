@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.company.title_singular') }}
        </div>

        <form method="POST" action="{{ route("admin.companies.store") }}" enctype="multipart/form-data">
            @csrf
            @csrf
            <div class="card shadow p-2">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="entity_id">{{ trans('cruds.company.fields.entity') }}</label>
                            <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id">
                                @foreach($entities as $id => $entity)
                                    <option value="{{ $id }}" {{ (old('entity_id') ? old('entity_id') : $company->entity->id ?? '') == $id ? 'selected' : '' }}>{{ $entity }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('entity'))
                                <span class="text-danger">{{ $errors->first('entity') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.entity_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3 mx-auto">
                            <label class="required" for="status">{{ trans('cruds.company.fields.status') }}</label>
                            <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                                <option value="1">{{ trans('trans.Prospect') }}</option>
                                <option value="2">{{ trans('trans.Client') }}</option>
                            </select>
                            @if($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="parent">{{ trans('cruds.company.fields.parent') }}</label>
                            <input class="form-control {{ $errors->has('parent') ? 'is-invalid' : '' }}" type="number" name="parent" id="parent" step="1">
                            @if($errors->has('parent'))
                                <span class="text-danger">{{ $errors->first('parent') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.parent_helper') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label class="required" for="name">{{ trans('cruds.company.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" required>
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="alias">{{ trans('cruds.company.fields.alias') }}</label>
                            <input class="form-control {{ $errors->has('alias') ? 'is-invalid' : '' }}" type="text" name="alias" id="alias">
                            @if($errors->has('alias'))
                                <span class="text-danger">{{ $errors->first('alias') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.alias_helper') }}</span>
                        </div>
                        <div class="form-group col-md-2 text-center">
                            <label for="supplier">{{ trans('cruds.company.fields.supplier') }}</label>
                            <div class="form-check {{ $errors->has('supplier') ? 'is-invalid' : '' }}">
                                <input class="form-check-input" type="checkbox" name="supplier" id="supplier" value="1">
                            </div>
                            @if($errors->has('supplier'))
                                <span class="text-danger">{{ $errors->first('supplier') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.supplier_helper') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3 mx-auto">
                            <label for="code_client">{{ trans('cruds.company.fields.code_client') }}</label>
                            <input class="form-control {{ $errors->has('code_client') ? 'is-invalid' : '' }}" type="text" name="code_client" id="code_client">
                            @if($errors->has('code_client'))
                                <span class="text-danger">{{ $errors->first('code_client') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.code_client_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3 mx-auto">
                            <label for="code_supplier">{{ trans('cruds.company.fields.code_supplier') }}</label>
                            <input class="form-control {{ $errors->has('code_supplier') ? 'is-invalid' : '' }}" type="text" name="code_supplier" id="code_supplier">
                            @if($errors->has('code_supplier'))
                                <span class="text-danger">{{ $errors->first('code_supplier') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.code_supplier_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3 mx-auto">
                            <label for="siren">{{ trans('cruds.company.fields.siren') }}</label>
                            <input class="form-control {{ $errors->has('siren') ? 'is-invalid' : '' }}" type="text" name="siren" id="siren">
                            @if($errors->has('siren'))
                                <span class="text-danger">{{ $errors->first('siren') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.siren_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3 mx-auto">
                            <label for="siret">{{ trans('cruds.company.fields.siret') }}</label>
                            <input class="form-control {{ $errors->has('siret') ? 'is-invalid' : '' }}" type="text" name="siret" id="siret">
                            @if($errors->has('siret'))
                                <span class="text-danger">{{ $errors->first('siret') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.siret_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3 mx-auto">
                            <label for="ape">{{ trans('cruds.company.fields.ape') }}</label>
                            <input class="form-control {{ $errors->has('ape') ? 'is-invalid' : '' }}" type="text" name="ape" id="ape">
                            @if($errors->has('ape'))
                                <span class="text-danger">{{ $errors->first('ape') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.ape_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3 mx-auto">
                            <label class="required" for="vatnumber">{{ trans('cruds.company.fields.vatnumber') }}</label>
                            <input class="form-control {{ $errors->has('vatnumber') ? 'is-invalid' : '' }}" type="text" name="vatnumber" id="vatnumber" required>
                            @if($errors->has('vatnumber'))
                                <span class="text-danger">{{ $errors->first('vatnumber') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.vatnumber_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3 mx-auto">
                            <label for="capital">{{ trans('cruds.company.fields.capital') }}</label>
                            <input class="form-control {{ $errors->has('capital') ? 'is-invalid' : '' }}" type="number" name="capital" id="capital" step="0.01">
                            @if($errors->has('capital'))
                                <span class="text-danger">{{ $errors->first('capital') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.capital_helper') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow p-2">
                <div class="card-header">
                    {{ trans('trans.Address') }}
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Address</label>
                        <input class="form-control" id="user_input_autocomplete_address" placeholder="Your address...">
                    </div>
                    <div class="form-group">
                        <label>addressbis</label>
                        <input class="form-control" name="address_2" placeholder="Your address...">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            <label>Number</label>
                            <input class="form-control" id="street_number" name="street_number">
                        </div>
                        <div class="form-group col-md-10">
                            <label>Street</label>
                            <input class="form-control" id="route" name="street">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Postcode</label>
                            <input class="form-control" id="postal_code" name="zip" >
                        </div>

                        <div class="form-group col-md-9">
                            <label>City</label>
                            <input class="form-control" id="locality" name="city" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>State</label>
                            <input class="form-control" id="administrative_area_level_2" name="state" >
                        </div>

                        <div class="form-group col-md-6" id="countrydiv">
                            <label>Country</label>
                            <input class="form-control" id="country" name="country" >
                        </div>
                    </div>

                    <div hidden>
                        <input id="latitude" name="latitude" placeholder="latitude">
                        <input id="longitude" name="longitude" placeholder="longitude">
                        <input id="url" name="url_place" placeholder="url">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="phone">{{ trans('cruds.company.fields.phone') }}</label>
                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone">
                            @if($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group  col-md-6">
                            <label class="required" for="email">{{ trans('cruds.company.fields.email') }}</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" required>
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.email_helper') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="form-group">
                    <label for="note_private">{{ trans('cruds.company.fields.note_private') }}</label>
                    <textarea class="form-control {{ $errors->has('note_private') ? 'is-invalid' : '' }}" name="note_private" id="note_private">{{ old('note_private') }}</textarea>
                    @if($errors->has('note_private'))
                        <span class="text-danger">{{ $errors->first('note_private') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.company.fields.note_private_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="note_public">{{ trans('cruds.company.fields.note_public') }}</label>
                    <textarea class="form-control {{ $errors->has('note_public') ? 'is-invalid' : '' }}" name="note_public" id="note_public">{{ old('note_public') }}</textarea>
                    @if($errors->has('note_public'))
                        <span class="text-danger">{{ $errors->first('note_public') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.company.fields.note_public_helper') }}</span>
                </div>
                <div class="form-group">
                    <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                        <input type="hidden" name="active" value="0">
                        <input class="form-check-input" type="checkbox" name="active" id="active">
                        <label class="form-check-label" for="active">{{ trans('cruds.company.fields.active') }}</label>
                    </div>
                    @if($errors->has('active'))
                        <span class="text-danger">{{ $errors->first('active') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.company.fields.active_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="photo">{{ trans('cruds.company.fields.photo') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                    </div>
                    @if($errors->has('photo'))
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.company.fields.photo_helper') }}</span>
                </div>
            </div>

                <div class="form-group">
                    <label for="tags">{{ trans('cruds.company.fields.tags') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                        @foreach($tags as $id => $tags)
                            <option value="{{ $id }}">{{ $tags }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('tags'))
                        <span class="text-danger">{{ $errors->first('tags') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.company.fields.tags_helper') }}</span>
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
@endsection

@section('scripts')

<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.companies.storeMedia') }}',
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
@if(isset($company) && $company->photo)
      var file = {!! json_encode($company->photo) !!}
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
