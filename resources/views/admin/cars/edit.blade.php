@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card col-10">
            <div class="card-header">
                {{ trans('global.edit') }} {{ trans('cruds.car.title_singular') }}
                <div class="text-center">
                    <h1>{{ $car->name }}</h1>
                    <div class="float-right">
                        <h6>{{ $car->import_key}}</h6>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("admin.cars.update", [$car->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card col">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="required" for="entity_id">{{ trans('cruds.car.fields.entity') }}</label>
                                            <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                                                @foreach($entities as $id => $entity)
                                                    <option value="{{ $id }}" {{ (old('entity_id') ? old('entity_id') : $car->entity->id ?? '') == $id ? 'selected' : '' }}>{{ $entity }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('entity'))
                                                <span class="text-danger">{{ $errors->first('entity') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.entity_helper') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="seller_id">{{ trans('cruds.car.fields.seller') }}</label>
                                            <select class="form-control select2 {{ $errors->has('seller') ? 'is-invalid' : '' }}" name="seller_id" id="seller_id">
                                                @foreach($sellers as $id => $seller)
                                                <option value="{{ $id }}" {{ (old('seller_id') ? old('seller_id') : $car->seller->id ?? '') == $id ? 'selected' : '' }}>{{ $seller }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('seller'))
                                                <span class="text-danger">{{ $errors->first('seller') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.seller_helper') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ trans('cruds.car.fields.country') }}</label>
                                            <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" id="user_input_autocomplete_address" value="{{ old('country', $car->country) }}">
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="country">{{ trans('cruds.car.fields.country') }}</label>
                                            <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', $car->country) }}">
                                            @if($errors->has('country'))
                                                <span class="text-danger">{{ $errors->first('country') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.country_helper') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="warehouse">{{ trans('cruds.car.fields.warehouse') }}</label>
                                            <input class="form-control {{ $errors->has('warehouse') ? 'is-invalid' : '' }}" type="text" name="warehouse" id="warehouse" value="{{ old('warehouse', $car->warehouse) }}">
                                            @if($errors->has('warehouse'))
                                                <span class="text-danger">{{ $errors->first('warehouse') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.warehouse_helper') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="qty">{{ trans('trans.stock') }}</label>
                                            <select class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" name="qty" id="qty">
                                                <option value="0" {{ (old('qty') ? old('qty') : $car->qty ?? '') == 0 ? 'selected' : '' }}>0</option>
                                                <option value="1" {{ (old('qty') ? old('qty') : $car->qty ?? '') == 1 ? 'selected' : '' }}>1</option>
                                            </select>
                                            @if($errors->has('qty'))
                                                <span class="text-danger">{{ $errors->first('qty') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.qty_helper') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="dispo">{{ trans('cruds.car.fields.dispo') }}</label>
                                            <input class="form-control date {{ $errors->has('dispo') ? 'is-invalid' : '' }}" type="text" name="dispo" id="dispo" value="{{ old('dispo', $car->dispo) }}">
                                            @if($errors->has('dispo'))
                                                <span class="text-danger">{{ $errors->first('dispo') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.dispo_helper') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="tags">{{ trans('cruds.car.fields.tags') }}</label>
                                            <div style="padding-bottom: 4px">
                                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                            </div>
                                            <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                                                @foreach($tags as $id => $tags)
                                                    <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $car->tags->contains($id)) ? 'selected' : '' }}>{{ $tags }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('tags'))
                                                <span class="text-danger">{{ $errors->first('tags') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.tags_helper') }}</span>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-4 text-center">
                                                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                                                    <input type="hidden" name="active" value="0">
                                                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ $car->active || old('active', 0) === 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="active">{{ trans('cruds.car.fields.active') }}</label>
                                                </div>
                                                @if($errors->has('active'))
                                                    <span class="text-danger">{{ $errors->first('active') }}</span>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.car.fields.active_helper') }}</span>
                                            </div>

                                            <div class="form-group col-lg-4 text-center">
                                                <div class="form-check {{ $errors->has('draft') ? 'is-invalid' : '' }}">
                                                    <input type="hidden" name="draft" value="0">
                                                    <input class="form-check-input" type="checkbox" name="draft" id="draft" value="1" {{ $car->draft || old('draft', 0) === 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="draft">{{ trans('cruds.car.fields.draft') }}</label>
                                                </div>
                                                @if($errors->has('draft'))
                                                    <span class="text-danger">{{ $errors->first('draft') }}</span>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.car.fields.draft_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card col">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="price_new">{{ trans('cruds.car.fields.price_new') }}</label>
                                        <input class="form-control {{ $errors->has('price_new') ? 'is-invalid' : '' }}" type="number" name="price_new" id="price_new" value="{{ old('price_new', $car->price_new) }}" step="0.01">
                                        @if($errors->has('price_new'))
                                            <span class="text-danger">{{ $errors->first('price_new') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.car.fields.price_new_helper') }}</span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="frevo">{{ trans('cruds.car.fields.frevo') }}</label>
                                        <input class="form-control {{ $errors->has('frevo') ? 'is-invalid' : '' }}" type="number" name="frevo" id="frevo" value="{{ old('frevo', $car->frevo) }}" step="0.01">
                                        @if($errors->has('frevo'))
                                            <span class="text-danger">{{ $errors->first('frevo') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.car.fields.frevo_helper') }}</span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="real_frevo">{{ trans('cruds.car.fields.real_frevo') }}</label>
                                        <input class="form-control {{ $errors->has('real_frevo') ? 'is-invalid' : '' }}" type="number" name="real_frevo" id="real_frevo" value="{{ old('real_frevo', $car->real_frevo) }}" step="0.01">
                                        @if($errors->has('real_frevo'))
                                            <span class="text-danger">{{ $errors->first('real_frevo') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.car.fields.real_frevo_helper') }}</span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="link_frevo">{{ trans('cruds.car.fields.link_frevo') }}</label>
                                        <input class="form-control {{ $errors->has('link_frevo') ? 'is-invalid' : '' }}" type="text" name="link_frevo" id="link_frevo" value="{{ old('link_frevo', $car->link_frevo) }}">
                                        @if($errors->has('link_frevo'))
                                            <span class="text-danger">{{ $errors->first('link_frevo') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.car.fields.link_frevo_helper') }}</span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="discount">{{ trans('cruds.car.fields.discount') }}</label>
                                        <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount" id="discount" value="{{ old('discount', $car->discount) }}" step="0.01">
                                        @if($errors->has('discount'))
                                            <span class="text-danger">{{ $errors->first('discount') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.car.fields.discount_helper') }}</span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="price_ht">{{ trans('cruds.car.fields.price_ht') }}</label>
                                        <input class="form-control {{ $errors->has('price_ht') ? 'is-invalid' : '' }}" type="number" name="price_ht" id="price_ht" value="{{ old('price_ht', $car->price_ht) }}" step="0.01">
                                        @if($errors->has('price_ht'))
                                            <span class="text-danger">{{ $errors->first('price_ht') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.car.fields.price_ht_helper') }}</span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="price_ttc">{{ trans('cruds.car.fields.price_ttc') }}</label>
                                        <input class="form-control {{ $errors->has('price_ttc') ? 'is-invalid' : '' }}" type="number" name="price_ttc" id="price_ttc" value="{{ old('price_ttc', $car->price_ttc) }}" step="0.01">
                                        @if($errors->has('price_ttc'))
                                            <span class="text-danger">{{ $errors->first('price_ttc') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.car.fields.price_ttc_helper') }}</span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="tax">{{ trans('cruds.car.fields.tax') }}</label>
                                        <input class="form-control {{ $errors->has('tax') ? 'is-invalid' : '' }}" type="number" name="tax" id="tax" value="{{ old('tax', $car->tax) }}" step="0.01">
                                        @if($errors->has('tax'))
                                            <span class="text-danger">{{ $errors->first('tax') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.car.fields.tax_helper') }}</span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="last_price_update">{{ trans('cruds.car.fields.last_price_update') }}</label>
                                        <input class="form-control datetime {{ $errors->has('last_price_update') ? 'is-invalid' : '' }}" type="text" name="last_price_update" id="last_price_update" value="{{ old('last_price_update', $car->last_price_update) }}">
                                        @if($errors->has('last_price_update'))
                                            <span class="text-danger">{{ $errors->first('last_price_update') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.car.fields.last_price_update_helper') }}</span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="cost_price">{{ trans('cruds.car.fields.cost_price') }}</label>
                                        <input class="form-control {{ $errors->has('cost_price') ? 'is-invalid' : '' }}" type="number" name="cost_price" id="cost_price" value="{{ old('cost_price', $car->cost_price) }}" step="0.01">
                                        @if($errors->has('cost_price'))
                                            <span class="text-danger">{{ $errors->first('cost_price') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.car.fields.cost_price_helper') }}</span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="form-check {{ $errors->has('impuesto') ? 'is-invalid' : '' }}">
                                            <input type="hidden" name="impuesto" value="0">
                                            <input class="form-check-input" type="checkbox" name="impuesto" id="impuesto" value="1" {{ $car->impuesto || old('impuesto', 0) === 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="impuesto">{{ trans('cruds.car.fields.impuesto') }}</label>
                                        </div>
                                        @if($errors->has('impuesto'))
                                            <span class="text-danger">{{ $errors->first('impuesto') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.car.fields.impuesto_helper') }}</span>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="comseller">{{ trans('cruds.car.fields.comseller') }}</label>
                                        <input class="form-control {{ $errors->has('comseller') ? 'is-invalid' : '' }}" type="number" name="comseller" id="comseller" value="{{ old('comseller', $car->comseller) }}" step="0.01">
                                        @if($errors->has('comseller'))
                                            <span class="text-danger">{{ $errors->first('comseller') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.car.fields.comseller_helper') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow-xl p-3 mt-3">
                                <div class="card shadow p-3">
                                    <div class="form-group col-lg-10 mx-auto">
                                        <label class="required" for="name">{{ trans('cruds.car.fields.name') }}</label>
                                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $car->name) }}" required>
                                        @if($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.car.fields.name_helper') }}</span>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-4">
                                            <label for="code_model_id">{{ trans('cruds.car.fields.code_model') }}</label>
                                            <select class="form-control select2 {{ $errors->has('code_model') ? 'is-invalid' : '' }}" name="code_model_id" id="code_model_id">
                                                @foreach($code_models as $id => $code_model)
                                                    <option value="{{ $id }}" {{ old('code_model_id') == $id ? 'selected' : '' }}>{{ $code_model }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('code_model'))
                                                <span class="text-danger">{{ $errors->first('code_model') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.code_model_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label class="required" for="make_id">{{ trans('cruds.version.fields.make') }}</label>
                                            <select class="form-control select2 {{ $errors->has('make') ? 'is-invalid' : '' }}" name="make" id="make" required>
                                                @foreach($makes as $id => $make)
                                                    <option value="{{ $make }}" {{ (old('make') ? old('make') : $car->make ?? '') == $make ? 'selected' : '' }}>{{ $make }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('make'))
                                                <span class="text-danger">{{ $errors->first('make') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.version.fields.make_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-5">
                                            <label class="required"  for="modele">{{ trans('cruds.version.fields.modele') }}</label>
                                            <select name="modele" id="modele" class="form-control select2 {{ $errors->has('modele') ? 'is-invalid' : '' }}">
                                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                                                @foreach($modeles as $id => $modele)
                                                    <option value="{{ $modele }}" {{ (old('modele') ? old('modele') : $car->modele ?? '') == $modele ? 'selected' : '' }}>{{ $modele }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('modele'))
                                                <span class="text-danger">{{ $errors->first('modele') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.version.fields.modele_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-8 mx-auto">
                                            <label class="required pl-4"  for="version_id">{{ trans('cruds.car.fields.version') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <a class="p-2 text-green-500 hover:bg-green-600 hover:text-white rounded" type="button" href="{{ route('admin.versions.create')}}" target="_blank">+</a>
                                                </div>
                                                <select name="version_id" id="version" class="form-control select2 {{ $errors->has('version') ? 'is-invalid' : '' }}">
                                                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                                                    @foreach($versions as $version)
                                                        <option value="{{ $version->id }}" {{ (old('version') ? old('version') : $car->version->id ?? '') == $version->id ? 'selected' : '' }}>{{ $version->description.' '.$version->motor }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('version'))
                                                    <span class="text-danger">{{ $errors->first('version') }}</span>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.car.fields.version_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-5 mx-auto">
                                            <label for="description">{{ trans('cruds.car.fields.description') }}</label>
                                            <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }} " type="text" name="description" id="description" value="{{ old('description', $car->description) }}" >
                                            @if($errors->has('description'))
                                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.description_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-5 mx-auto">
                                            <label for="motor">{{ trans('cruds.car.fields.motor') }}</label>
                                            <input class="form-control {{ $errors->has('motor') ? 'is-invalid' : '' }} " type="text" name="motor" id="motor" value="{{ old('motor', $car->motor) }}" >
                                            @if($errors->has('motor'))
                                                <span class="text-danger">{{ $errors->first('motor') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.motor_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-5 mx-auto">
                                            <label for="ch">{{ trans('cruds.car.fields.ch') }}</label>
                                            <input class="form-control {{ $errors->has('ch') ? 'is-invalid' : '' }} required" type="number" name="ch" id="ch" value="{{ old('ch', $car->ch) }}" step="1">
                                            @if($errors->has('ch'))
                                                <span class="text-danger">{{ $errors->first('ch') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.ch_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-5 mx-auto">
                                            <label for="co_2">{{ trans('cruds.car.fields.co_2') }}</label>
                                            <input class="form-control {{ $errors->has('co_2') ? 'is-invalid' : '' }} required" type="number" name="co_2" id="co_2" value="{{ old('co_2', $car->co_2) }}" step="1">
                                            @if($errors->has('co_2'))
                                                <span class="text-danger">{{ $errors->first('co_2') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.co_2_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-5 mx-auto">
                                            <label for="energy">{{ trans('cruds.car.fields.energy') }}</label>
                                            <input class="form-control {{ $errors->has('energy') ? 'is-invalid' : '' }} required" type="text" name="energy" id="energy" value="{{ old('energy', $car->energy) }}">
                                            @if($errors->has('energy'))
                                                <span class="text-danger">{{ $errors->first('energy') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.energy_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-5 mx-auto">
                                            <label for="gear">{{ trans('cruds.car.fields.gear') }}</label>
                                            <input class="form-control {{ $errors->has('gear') ? 'is-invalid' : '' }}" type="text" name="gear" id="gear" value="{{ old('gear', $car->gear) }}">
                                            @if($errors->has('gear'))
                                                <span class="text-danger">{{ $errors->first('gear') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.gear_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-5 mx-auto">
                                            <label for="conso">{{ trans('cruds.car.fields.conso') }}</label>
                                            <input class="form-control {{ $errors->has('conso') ? 'is-invalid' : '' }}" type="number" name="conso" id="conso" value="{{ old('conso', $car->conso) }}" step="0.01" max="100">
                                            @if($errors->has('conso'))
                                                <span class="text-danger">{{ $errors->first('conso') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.conso_helper') }}</span>
                                        </div>
                                        {{-- <div class="form-group col-lg-5 mx-auto">
                                            <label for="price_new">{{ trans('cruds.car.fields.price_new') }}</label>
                                            <input class="form-control {{ $errors->has('price_new') ? 'is-invalid' : '' }}" type="number" name="price_new" id="price_new" value="{{ old('price_new', $car->price_new) }}" step="0.01">
                                            @if($errors->has('price_new'))
                                                <span class="text-danger">{{ $errors->first('price_new') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.price_new_helper') }}</span>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="card shadow p-3">
                                    <div class="row">
                                        <div class="form-group col-lg-10 mx-auto">
                                            <label for="categories">{{ trans('cruds.car.fields.categorie') }}</label>
                                            <div style="padding-bottom: 4px">
                                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                            </div>
                                            <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                                                @foreach($categories as $id => $categorie)
                                                    <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $car->categories->contains($id)) ? 'selected' : '' }}>{{ $categorie }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('categories'))
                                                <span class="text-danger">{{ $errors->first('categories') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.categorie_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label class="required" for="vin">{{ trans('cruds.car.fields.vin') }}</label>
                                            <input class="form-control {{ $errors->has('vin') ? 'is-invalid' : '' }}" type="text" name="vin" id="vin" value="{{ old('vin', $car->vin) }}" required>
                                            @if($errors->has('vin'))
                                                <span class="text-danger">{{ $errors->first('vin') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.vin_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="plates">{{ trans('cruds.car.fields.plates') }}</label>
                                            <input class="form-control {{ $errors->has('plates') ? 'is-invalid' : '' }}" type="text" name="plates" id="plates" value="{{ old('plates', $car->plates) }}">
                                            @if($errors->has('plates'))
                                                <span class="text-danger">{{ $errors->first('plates') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.plates_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="idv">{{ trans('cruds.car.fields.idv') }}</label>
                                            <input class="form-control {{ $errors->has('idv') ? 'is-invalid' : '' }}" type="text" name="idv" id="idv" value="{{ old('idv', $car->idv) }}">
                                            @if($errors->has('idv'))
                                                <span class="text-danger">{{ $errors->first('idv') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.idv_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="mec">{{ trans('cruds.car.fields.mec') }}</label>
                                            <input class="form-control date {{ $errors->has('mec') ? 'is-invalid' : '' }}" type="text" name="mec" id="mec" value="{{ old('mec', $car->mec) }}">
                                            @if($errors->has('mec'))
                                                <span class="text-danger">{{ $errors->first('mec') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.mec_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="kms">{{ trans('cruds.car.fields.kms') }}</label>
                                            <input class="form-control {{ $errors->has('kms') ? 'is-invalid' : '' }}" type="number" name="kms" id="kms" value="{{ old('kms', $car->kms) }}" step="1">
                                            @if($errors->has('kms'))
                                                <span class="text-danger">{{ $errors->first('kms') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.kms_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="color">{{ trans('cruds.car.fields.color') }}</label>
                                            <input class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}" type="text" name="color" id="color" value="{{ old('color', $car->color) }}">
                                            @if($errors->has('color'))
                                                <span class="text-danger">{{ $errors->first('color') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.color_helper') }}</span>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="interior">{{ trans('cruds.car.fields.interior') }}</label>
                                            <input class="form-control {{ $errors->has('interior') ? 'is-invalid' : '' }}" type="text" name="interior" id="interior" value="{{ old('interior', $car->interior) }}">
                                            @if($errors->has('interior'))
                                                <span class="text-danger">{{ $errors->first('interior') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.car.fields.interior_helper') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg p-3">
                        <div class="form-group">
                            <label for="serie">{{ trans('cruds.car.fields.serie') }}</label>
                            <textarea class="form-control {{ $errors->has('serie') ? 'is-invalid' : '' }}" name="serie" id="equipment">{!! old('serie', $car->serie) !!}</textarea>
                            @if($errors->has('serie'))
                                <span class="text-danger">{{ $errors->first('serie') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.car.fields.serie_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="feature">{{ trans('cruds.car.fields.feature') }}</label>
                            <textarea class="form-control {{ $errors->has('feature') ? 'is-invalid' : '' }}" name="feature" id="feature">{!! old('feature', $car->feature) !!}</textarea>
                            @if($errors->has('feature'))
                                <span class="text-danger">{{ $errors->first('feature') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.car.fields.feature_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="private_note">{{ trans('cruds.car.fields.private_note') }}</label>
                            <textarea class="form-control {{ $errors->has('private_note') ? 'is-invalid' : '' }}" type="text" name="private_note" id="private_note">{{ old('private_note', $car->private_note) }}</textarea>
                            @if($errors->has('private_note'))
                                <span class="text-danger">{{ $errors->first('private_note') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.car.fields.private_note_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="image">{{ trans('cruds.car.fields.image') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.car.fields.image_helper') }}</span>
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
</div>


@endsection

@section('scripts')
<script>
    var uploadedImageMap = {}
Dropzone.options.imageDropzone = {
    url: '{{ route('admin.cars.storeMedia') }}',
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
@if(isset($car) && $car->image)
      var files = {!! json_encode($car->image) !!}
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
                xhr.open('POST', '/admin/cars/ckmedia', true);
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
                data.append('crud_id', '{{ $car->id ?? 0 }}');
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
