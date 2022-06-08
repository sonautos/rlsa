@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('trans.bank') }}
        </div>
    
        <div class="card-body">
            <form method="POST" action="{{ route("admin.banks.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="entity_id">{{ trans('trans.entity') }}</label>
                        <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id">
                            @foreach($entities as $id => $entity)
                                <option value="{{ $id }}" {{ old('entity_id') == $id || $entity_id == $id ? 'selected' : '' }}>{{ $entity }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('entity'))
                            <span class="text-danger">{{ $errors->first('entity') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.address.fields.entity_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="company_id">{{ trans('trans.company') }}</label>
                        <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id">
                            @foreach($companies as $id => $company)
                                <option value="{{ $id }}" {{ old('company_id') == $id || $company_id == $id ? 'selected' : '' }}>{{ $company }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('company'))
                            <span class="text-danger">{{ $errors->first('company') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.company.fields.name') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="individual_id">{{ trans('trans.individual') }}</label>
                        <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="individual_id" id="individual_id">
                            @foreach($individuals as $id => $individual)
                                <option value="{{ $id }}" {{ old('individual_id') == $id || $individual_id == $id ? 'selected' : '' }}>{{ $individual }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('individual'))
                            <span class="text-danger">{{ $errors->first('individual') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.address.fields.individual_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4 mx-auto">
                        <label class="required" for="name">{{ trans('trans.name-of-bank') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.bank.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 mx-auto">
                        <label class="required" for="iban">{{ trans('trans.iban-of-bank') }}</label>
                        <input class="form-control {{ $errors->has('iban') ? 'is-invalid' : '' }}" type="text" name="iban" id="iban" value="{{ old('iban', '') }}" required>
                        @if($errors->has('iban'))
                            <span class="text-danger">{{ $errors->first('iban') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.bank.fields.iban_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4 mx-auto">
                        <label class="required" for="swift">{{ trans('trans.swift-of-bank') }}</label>
                        <input class="form-control {{ $errors->has('swift') ? 'is-invalid' : '' }}" type="text" name="swift" id="swift" value="{{ old('swift', '') }}" required>
                        @if($errors->has('swift'))
                            <span class="text-danger">{{ $errors->first('swift') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.bank.fields.swift_helper') }}</span>
                    </div>
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

</script>
@endsection