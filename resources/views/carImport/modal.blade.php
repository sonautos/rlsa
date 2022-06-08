<div class="modal fade" id="csvImportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="max-width: 75%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">@lang('global.app_csvImport')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="importForm" method="POST" action="{{ route('admin.cars.parseCsvImport') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center">
                        <div class="form-group">
                            <a class="btn btn-outline-dark" data-toggle="collapse" href="#collapseMMV" role="button" aria-expanded="false" aria-controls="collapseMMV">
                                {{ trans('vehicle.mmv-select') }}
                            </a>
                            <div class="collapse" id="collapseMMV">
                                {{-- Marque-modele --}}
                                    <div class="card col-lg-11 mx-auto">
                                        {{-- Code Modele --}}
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <select class="form-control select2 {{ $errors->has('make') ? 'is-invalid' : '' }}" name="make" id="make" required>
                                                        <option value="">{{ trans('global.pleaseSelect') }} {{ trans('cruds.version.fields.make') }}</option>
                                                        @foreach($makes as $make)
                                                            <option value="{{ $make->id }}" {{ old('make') == $make->id ? 'selected' : '' }}>{{ $make->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('make'))
                                                        <span class="text-danger">{{ $errors->first('make') }}</span>
                                                    @endif
                                                    <span class="help-block">{{ trans('cruds.version.fields.make_helper') }}</span>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <select name="modele" id="modele" class="form-control select2 {{ $errors->has('modele') ? 'is-invalid' : '' }}">
                                                        <option value="">{{ trans('global.pleaseSelect') }} {{ trans('cruds.version.fields.modele') }}</option>
                                                        @foreach($modeles as $modele)
                                                            <option value="{{ $modele->id }}" {{ old('make') == $modele->id ? 'selected' : '' }}>{{ $modele->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('modele'))
                                                        <span class="text-danger">{{ $errors->first('modele') }}</span>
                                                    @endif
                                                    <span class="help-block">{{ trans('cruds.version.fields.modele_helper') }}</span>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <a class="p-2 text-green-500 hover:bg-green-600 hover:text-white rounded" type="button" href="{{ route('admin.versions.create')}}" target="_blank">+</a>
                                                        </div>
                                                        <select name="version_id" id="version" class="form-control select2 {{ $errors->has('version') ? 'is-invalid' : '' }}">
                                                            <option value="">{{ trans('global.pleaseSelect') }} {{ trans('cruds.car.fields.version') }}</option>
                                                        </select>
                                                        @if($errors->has('version'))
                                                            <span class="text-danger">{{ $errors->first('version') }}</span>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.car.fields.version_helper') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- Fin  --}}
                            </div>
                        </div>

                        <div class="form-group">
                            <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                                <option value="">{{ trans('global.pleaseSelect') }} {{ trans('cruds.car.fields.entity') }}</option>
                                @foreach($entities as $entity)
                                    <option value="{{ $entity->id }}" {{ old('entity_id') == $entity->id ? 'selected' : '' }}>{{ $entity->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('entity'))
                                <span class="text-danger">{{ $errors->first('entity') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.car.fields.entity_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <select class="form-control select2 {{ $errors->has('seller') ? 'is-invalid' : '' }}" name="seller_id" id="seller_id">
                                <option value="">{{ trans('global.pleaseSelect') }} {{ trans('cruds.car.fields.seller') }}</option>
                                @foreach($companies->where('supplier', 1)->sortBy('name') as $seller)
                                    <option value="{{ $seller->id }}" {{ old('seller_id') == $seller->id ? 'selected' : '' }}>{{ $seller->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('seller'))
                                <span class="text-danger">{{ $errors->first('seller') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.car.fields.seller_helper') }}</span>
                        </div>

                        <div class="form-group col-md-6 mx-auto">
                            <label for="dispo">{{ trans('cruds.car.fields.dispo') }}</label>
                            <input class="form-control {{ $errors->has('dispo') ? 'is-invalid' : '' }}" type="date" name="dispo" id="dispo" value="{{ old('dispo') }}">
                            @if($errors->has('dispo'))
                                <span class="text-danger">{{ $errors->first('dispo') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.car.fields.dispo_helper') }}</span>
                        </div>

                        <div class="form-group col-md-6 mx-auto">
                            <label for="comseller">{{ trans('cruds.car.fields.comseller') }}</label>
                            <input class="form-control {{ $errors->has('comseller') ? 'is-invalid' : '' }}" type="number" name="comseller" id="comseller" value="{{ old('comseller', '') }}" step="0.01">
                            @if($errors->has('comseller'))
                                <span class="text-danger">{{ $errors->first('comseller') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.car.fields.comseller_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="checkbox" name="increasePrice" checked> @lang('global.increasePrice')
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('csv_file') ? ' has-error' : '' }}">
                            <div class="{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                <label for="csv_file" class="col-md-4 control-label">@lang('global.app_csv_file_to_import')</label>

                                <div class="col-md-6">
                                    <input id="csv_file" type="file" class="form-control-file" name="csv_file" required>

                                    @if($errors->has('csv_file'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('csv_file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="header" checked> @lang('global.app_file_contains_header_row')
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="qty" checked> @lang('global.stock')
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-2">
                                <div class="col-lg-8 col-lg-offset-4">
                                    {{-- <button type="submit" class="btn btn-outline-success">
                                        {{ trans('trans.parse') }}
                                    </button> --}}
                                    <a href="#" class="btn btn-outline-success" onclick="document.getElementById('importForm').submit();"> submit </a>
                                </div>
                            </div>
                        </div>



                        {{-- <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="header" checked> @lang('global.app_file_contains_header_row')
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('global.app_parse_csv')
                                </button>
                            </div>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
