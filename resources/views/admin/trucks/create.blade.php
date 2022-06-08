@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.truck.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.trucks.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="supplier_id">{{ trans('cruds.truck.fields.supplier') }}</label>
                <select class="form-control select2 {{ $errors->has('supplier') ? 'is-invalid' : '' }}" name="supplier_id" id="supplier_id">
                    @foreach($suppliers as $id => $supplier)
                        <option value="{{ $id }}" {{ old('supplier_id') == $id ? 'selected' : '' }}>{{ $supplier }}</option>
                    @endforeach
                </select>
                @if($errors->has('supplier'))
                    <span class="text-danger">{{ $errors->first('supplier') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.truck.fields.supplier_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="plates">{{ trans('cruds.truck.fields.plates') }}</label>
                <input class="form-control {{ $errors->has('plates') ? 'is-invalid' : '' }}" type="text" name="plates" id="plates" value="{{ old('plates', '') }}">
                @if($errors->has('plates'))
                    <span class="text-danger">{{ $errors->first('plates') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.truck.fields.plates_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="chauffeur">{{ trans('cruds.truck.fields.chauffeur') }}</label>
                <input class="form-control {{ $errors->has('chauffeur') ? 'is-invalid' : '' }}" type="text" name="chauffeur" id="chauffeur" value="{{ old('chauffeur', '') }}">
                @if($errors->has('chauffeur'))
                    <span class="text-danger">{{ $errors->first('chauffeur') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.truck.fields.chauffeur_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.truck.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.truck.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_load">{{ trans('cruds.truck.fields.date_load') }}</label>
                <input class="form-control {{ $errors->has('date_load') ? 'is-invalid' : '' }}" type="text" name="date_load" id="date_load" value="{{ old('date_load', '') }}">
                @if($errors->has('date_load'))
                    <span class="text-danger">{{ $errors->first('date_load') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.truck.fields.date_load_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_cmr">{{ trans('cruds.truck.fields.date_cmr') }}</label>
                <input class="form-control date {{ $errors->has('date_cmr') ? 'is-invalid' : '' }}" type="text" name="date_cmr" id="date_cmr" value="{{ old('date_cmr') }}">
                @if($errors->has('date_cmr'))
                    <span class="text-danger">{{ $errors->first('date_cmr') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.truck.fields.date_cmr_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.truck.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="number" name="status" id="status" value="{{ old('status', '0') }}" step="1">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.truck.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('paid') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="paid" value="0">
                    <input class="form-check-input" type="checkbox" name="paid" id="paid" value="1" {{ old('paid', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="paid">{{ trans('cruds.truck.fields.paid') }}</label>
                </div>
                @if($errors->has('paid'))
                    <span class="text-danger">{{ $errors->first('paid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.truck.fields.paid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.truck.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.truck.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shippment_id">{{ trans('cruds.truck.fields.shippment') }}</label>
                <select class="form-control select2 {{ $errors->has('shippment') ? 'is-invalid' : '' }}" name="shippment_id" id="shippment_id">
                    @foreach($shippments as $id => $shippment)
                        <option value="{{ $id }}" {{ old('shippment_id') == $id ? 'selected' : '' }}>{{ $shippment }}</option>
                    @endforeach
                </select>
                @if($errors->has('shippment'))
                    <span class="text-danger">{{ $errors->first('shippment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.truck.fields.shippment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cmr">{{ trans('cruds.truck.fields.cmr') }}</label>
                <div class="needsclick dropzone {{ $errors->has('cmr') ? 'is-invalid' : '' }}" id="cmr-dropzone">
                </div>
                @if($errors->has('cmr'))
                    <span class="text-danger">{{ $errors->first('cmr') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.truck.fields.cmr_helper') }}</span>
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
    Dropzone.options.cmrDropzone = {
    url: '{{ route('admin.trucks.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="cmr"]').remove()
      $('form').append('<input type="hidden" name="cmr" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="cmr"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
        @if(isset($truck) && $truck->cmr)
            var file = {!! json_encode($truck->cmr) !!}
                this.options.addedfile.call(this, file)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="cmr" value="' + file.file_name + '">')
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
