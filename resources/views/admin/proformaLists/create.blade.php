@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="container-fluid">
        @if (session()->has('message'))
          <div class="bg-gray-300 border-t-4 border-gray-500 rounded-b text-red-900 px-4 py-3 shadow-md my-3" role="alert">
              <div class="flex">
                  <div class="col-md-6 mx-auto">
                      <p class="text-sm text-center">{{ session('message') }}</p>
                  </div>
              </div>
          </div>
        @endif

        <div class="card">
            <form method="POST" id="orderForm" action="{{ route("admin.proforma-lists.store") }}" enctype="multipart/form-data">
                @csrf

                <div class="card-header">{{ trans('trans.Order')}} : <strong>PROV#{{ $prof_ref }}</strong>
                    <div class="form-group col-lg-3 float-right">
                        <label class="required" for="entity_id">{{ trans('cruds.ordersList.fields.entity') }}</label>
                        <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                            @foreach($entities as $id => $entity)
                                <option value="{{ $id }}" {{ (old('entity_id') ? old('entity_id') : $ent->id ?? '') == $id ? 'selected' : '' }} >{{ $entity }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('entity'))
                            <span class="text-danger">{{ $errors->first('entity') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.ordersList.fields.entity_helper') }}</span>
                    </div>
                    <div class="form-group col-lg-3 float-right">
                        <label class="required" for="author_id">{{ trans('cruds.ordersList.fields.author') }}</label>
                        <select class="form-control select2 {{ $errors->has('author') ? 'is-invalid' : '' }}" name="author_id" id="author_id" required>
                            @foreach($authors as $id => $author)
                                <option value="{{ $id }}" {{ $user->id == $id ? 'selected' : '' }}>{{ $author }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('author'))
                            <span class="text-danger">{{ $errors->first('author') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.ordersList.fields.author_helper') }}</span>
                    </div>
                </div>
                <input type="text" name="prof_ref" id="prof_ref" value="{{ $prof_ref }}" hidden>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="required" for="seller_id">{{ trans('cruds.ordersList.fields.seller') }}</label>
                                <select class="form-control select2 {{ $errors->has('seller') ? 'is-invalid' : '' }}" name="seller_id" id="seller_id" required>
                                    @foreach($sellers as $id => $seller)
                                        <option value="{{ $id }}" {{ (old('seller_id') ? old('seller_id') : $sel->id ?? '') == $id ? 'selected' : '' }}>{{ $seller }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('seller'))
                                    <span class="text-danger">{{ $errors->first('seller') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.ordersList.fields.seller_helper') }}</span>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="required" for="client_id">{{ trans('cruds.ordersList.fields.client') }}</label>
                                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                                    @foreach($clients as $id => $client)
                                        <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $cli->id ?? '') == $id ? 'selected' : '' }}>{{ $client }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('client'))
                                    <span class="text-danger">{{ $errors->first('client') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.ordersList.fields.client_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="delivery_address_id">{{ trans('cruds.ordersList.fields.delivery_address') }}</label>
                                <select class="form-control select2 {{ $errors->has('delivery_address') ? 'is-invalid' : '' }}" name="delivery_address_id" id="delivery_address_id">
                                    @foreach($delivery_addresses as $id => $delivery_address)
                                        <option value="{{ $id }}" {{ old('delivery_address_id') == $id ? 'selected' : '' }}>{{ $delivery_address }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('delivery_address'))
                                    <span class="text-danger">{{ $errors->first('delivery_address') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.ordersList.fields.delivery_address_helper') }}</span>
                            </div>
                        </div>

                        <!-- /.col-->
                        <div class="col-lg-3">
                            <div class="pb-1">
                                <strong>{{ trans('cruds.ordersList.fields.ref') }} : PROV#{{ $prof_ref }}</strong>
                                <input class="{{ $errors->has('ref') ? 'is-invalid' : '' }}" type="text" name="ref" id="ref" value="{{ $prof_ref }}" hidden>
                            </div>
                            <div class="">
                                <label class="required" for="date_created">{{ trans('trans.Date')}}</label><b style="color: red"> *</b> :
                                <input class="{{ $errors->has('date_created') ? 'is-invalid' : '' }}" type="date" name="date_created" id="date_created" value="{{ $date }}" required>
                                @if($errors->has('date_created'))
                                    <span class="text-danger">{{ $errors->first('date_created') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.ordersList.fields.date_created_helper') }}</span>
                            </div>
                            <div class="">
                                <label class="required" for="date_livraison">{{ trans('cruds.ordersList.fields.date_livraison') }}</label><b style="color: red"> *</b> :
                                <input class="{{ $errors->has('date_livraison') ? 'is-invalid' : '' }}" type="date" name="date_livraison" id="date_livraison" required>
                                @if($errors->has('date_livraison'))
                                    <span class="text-danger">{{ $errors->first('date_livraison') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.ordersList.fields.date_livraison_helper') }}</span>
                            </div>
                            <div class="">
                                <label for="cond_reglement_id">{{ trans('cruds.ordersList.fields.cond_reglement') }} :</label>
                                <select class="{{ $errors->has('cond_reglement') ? 'is-invalid' : '' }}" name="cond_reglement_id" id="cond_reglement_id">
                                    @foreach($cond_reglements as $id => $cond_reglement)
                                        <option value="{{ $id }}" {{ old('cond_reglement_id') == $id ? 'selected' : '' }}>{{ $cond_reglement }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('cond_reglement'))
                                    <span class="text-danger">{{ $errors->first('cond_reglement') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.ordersList.fields.cond_reglement_helper') }}</span>
                            </div>
                            <div class="">
                                <label for="mode_reglement_id">{{ trans('cruds.ordersList.fields.mode_reglement') }} :</label>
                                <select class=" {{ $errors->has('mode_reglement') ? 'is-invalid' : '' }}" name="mode_reglement_id" id="mode_reglement_id">
                                    @foreach($mode_reglements as $id => $mode_reglement)
                                        <option value="{{ $id }}" {{ old('mode_reglement_id') == $id ? 'selected' : '' }}>{{ $mode_reglement }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('mode_reglement'))
                                    <span class="text-danger">{{ $errors->first('mode_reglement') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.ordersList.fields.mode_reglement_helper') }}</span>
                            </div>
                            <div class="">
                                <label for="shipping_method_id">{{ trans('cruds.ordersList.fields.shipping_method') }}</label>
                                <select class="{{ $errors->has('shipping_method') ? 'is-invalid' : '' }}" name="shipping_method_id" id="shipping_method_id">
                                    @foreach($shipping_methods as $id => $shipping_method)
                                        <option value="{{ $id }}" {{ old('shipping_method_id') == $id ? 'selected' : '' }}>{{ $shipping_method }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('shipping_method'))
                                    <span class="text-danger">{{ $errors->first('shipping_method') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.ordersList.fields.shipping_method_helper') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group pb-3" role="group">
                        <button class="btn btn-outline-dark" type="button" data-toggle="collapse" data-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample2">{{ trans('cruds.ordersList.fields.note_private') }}</button>
                        <button class="btn btn-outline-dark" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">{{ trans('cruds.ordersList.fields.note_public') }}</button>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                <div class="card card-body">
                                    {{ trans('cruds.ordersList.fields.note_private') }}
                                    <textarea class="form-control {{ $errors->has('note_private') ? 'is-invalid' : '' }}" name="note_private" id="note_private">{{ old('note_private') }}</textarea>
                                    @if($errors->has('note_private'))
                                        <span class="text-danger">{{ $errors->first('note_private') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.ordersList.fields.note_private_helper') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                <div class="card card-body">
                                    {{ trans('cruds.ordersList.fields.note_public') }}
                                    <textarea class="form-control {{ $errors->has('note_public') ? 'is-invalid' : '' }}" name="note_public" id="note_public">{{ old('note_public') }}</textarea>
                                    @if($errors->has('note_public'))
                                        <span class="text-danger">{{ $errors->first('note_public') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.ordersList.fields.note_public_helper') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-sm" id="dataTable">
                        <thead>
                            <tr>
                                <th class="">#</th>
                                <th>{{trans('trans.description')}}</th>
                                <th class="text-center">{{trans('vehicle.vin')}}</th>
                                <th class="text-center">{{ trans('vehicle.color')}}</th>
                                <th class="text-center">{{ trans('vehicle.mec')}}</th>
                                <th class="text-center">{{ trans('vehicle.kms')}}</th>
                                <th class="text-center">{{ trans('vehicle.co2')}}</th>
                                <th class="text-center">{{ trans('trans.total')}} <br>
                                    {{trans('trans.inEuro') }} <b style="color: red">*</b>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($orderlines))
                            @foreach ($orderlines as $ol)
                            <input type="text" name="comclient" id="" value="{{ $ol->comclient }}" hidden>
                            <tr>
                                <td><input type="button" class="p-2 text-red-500 hover:bg-red-600 hover:text-white rounded" value="-" onclick="removeLine(this);"></td>
                                <td class="">
                                    <strong><input type="text" name="vhid[]" value="{{ $ol->vehicle->id }}" hidden>{{ $ol->vehicle->name }}</strong>
                                    <br>
                                    @if (isset($ol->vehicle->idv)) {{ $ol->vehicle->idv}} - @endif @if (isset($ol->vehicle->plates)) {{ $ol->vehicle->plates }}@endif <br>
                                    @if (isset($ol->vehicle->feature)) {{ trans('trans-optionscompl')}} : {{ $ol->vehicle->feature }}@endif
                                </td>
                                <td class="text-center">{{ $ol->vehicle->vin }}</td>
                                <td class="text-center">{{ $ol->vehicle->color }}</td>
                                <td class="text-center">{{ $ol->vehicle->mec }}</td>
                                <td class="text-center">{{ $ol->vehicle->kms }}</td>
                                <td class="text-center">{{ $ol->vehicle->co_2 }}</td>
                                <td class="text-center"><input class="text-center bg-success vh_price" type="number" id="" name="vh_price[]" value="{{ $ol->total_ht }}"></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        </table>
                        <div class="set-form text-right py-2"><input type="button" id="more_fields" onclick="add_fields();" value=" + " class="p-2 mr-3 text-green-500 bg-hover:bg-green-600 hover:text-white rounded"/></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <hr>
                            <div class="row py-3">
                                <div class="col-md-6 float-left">
                                    <strong>{{ trans('trans.total')}}</strong>
                                </div>
                                <div class="input-group col-md-6 text-right">
                                    <input class="price_ht form-control text-center" type="text" name="price_ht" id="price_ht" value="{{ isset($orderlines) ? $orderlines->sum('total_ht') : ''}}" readonly>
                                    <div class="input-group-append">
                                      <span class="input-group-text" id="basic-addon2">€ H.T</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- <div class="col-md-4 mx-auto text-center pb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  {{ trans('trans.submit') }}
                </button>
            </div> --}}
            <div class="col-md-4 mx-auto text-center pb-3">
                <button type="submit" class="btn btn-success" onclick="document.getElementById('orderForm').submit();">{{ trans('trans.submit') }}</button>
            </div>
        </div>
    </div>
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.proformaList.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.proforma-lists.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="ref">{{ trans('cruds.proformaList.fields.ref') }}</label>
                <input class="form-control {{ $errors->has('ref') ? 'is-invalid' : '' }}" type="text" name="ref" id="ref" value="{{ old('ref', '') }}" required>
                @if($errors->has('ref'))
                    <span class="text-danger">{{ $errors->first('ref') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.ref_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="entity_id">{{ trans('cruds.proformaList.fields.entity') }}</label>
                <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                    @foreach($entities as $id => $entity)
                        <option value="{{ $id }}" {{ old('entity_id') == $id ? 'selected' : '' }}>{{ $entity }}</option>
                    @endforeach
                </select>
                @if($errors->has('entity'))
                    <span class="text-danger">{{ $errors->first('entity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="seller_id">{{ trans('cruds.proformaList.fields.seller') }}</label>
                <select class="form-control select2 {{ $errors->has('seller') ? 'is-invalid' : '' }}" name="seller_id" id="seller_id" required>
                    @foreach($sellers as $id => $seller)
                        <option value="{{ $id }}" {{ old('seller_id') == $id ? 'selected' : '' }}>{{ $seller }}</option>
                    @endforeach
                </select>
                @if($errors->has('seller'))
                    <span class="text-danger">{{ $errors->first('seller') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.seller_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.proformaList.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="task_id">{{ trans('cruds.proformaList.fields.task') }}</label>
                <select class="form-control select2 {{ $errors->has('task') ? 'is-invalid' : '' }}" name="task_id" id="task_id">
                    @foreach($tasks as $id => $task)
                        <option value="{{ $id }}" {{ old('task_id') == $id ? 'selected' : '' }}>{{ $task }}</option>
                    @endforeach
                </select>
                @if($errors->has('task'))
                    <span class="text-danger">{{ $errors->first('task') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.task_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_created">{{ trans('cruds.proformaList.fields.date_created') }}</label>
                <input class="form-control date {{ $errors->has('date_created') ? 'is-invalid' : '' }}" type="text" name="date_created" id="date_created" value="{{ old('date_created') }}" required>
                @if($errors->has('date_created'))
                    <span class="text-danger">{{ $errors->first('date_created') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.date_created_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_valid">{{ trans('cruds.proformaList.fields.date_valid') }}</label>
                <input class="form-control date {{ $errors->has('date_valid') ? 'is-invalid' : '' }}" type="text" name="date_valid" id="date_valid" value="{{ old('date_valid') }}">
                @if($errors->has('date_valid'))
                    <span class="text-danger">{{ $errors->first('date_valid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.date_valid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="author_id">{{ trans('cruds.proformaList.fields.author') }}</label>
                <select class="form-control select2 {{ $errors->has('author') ? 'is-invalid' : '' }}" name="author_id" id="author_id" required>
                    @foreach($authors as $id => $author)
                        <option value="{{ $id }}" {{ old('author_id') == $id ? 'selected' : '' }}>{{ $author }}</option>
                    @endforeach
                </select>
                @if($errors->has('author'))
                    <span class="text-danger">{{ $errors->first('author') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.author_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="valid_id">{{ trans('cruds.proformaList.fields.valid') }}</label>
                <select class="form-control select2 {{ $errors->has('valid') ? 'is-invalid' : '' }}" name="valid_id" id="valid_id">
                    @foreach($valids as $id => $valid)
                        <option value="{{ $id }}" {{ old('valid_id') == $id ? 'selected' : '' }}>{{ $valid }}</option>
                    @endforeach
                </select>
                @if($errors->has('valid'))
                    <span class="text-danger">{{ $errors->first('valid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.valid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_updated_id">{{ trans('cruds.proformaList.fields.user_updated') }}</label>
                <select class="form-control select2 {{ $errors->has('user_updated') ? 'is-invalid' : '' }}" name="user_updated_id" id="user_updated_id">
                    @foreach($user_updateds as $id => $user_updated)
                        <option value="{{ $id }}" {{ old('user_updated_id') == $id ? 'selected' : '' }}>{{ $user_updated }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_updated'))
                    <span class="text-danger">{{ $errors->first('user_updated') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.user_updated_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.proformaList.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_ht">{{ trans('cruds.proformaList.fields.total_ht') }}</label>
                <input class="form-control {{ $errors->has('total_ht') ? 'is-invalid' : '' }}" type="number" name="total_ht" id="total_ht" value="{{ old('total_ht', '') }}" step="0.01">
                @if($errors->has('total_ht'))
                    <span class="text-danger">{{ $errors->first('total_ht') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.total_ht_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tva">{{ trans('cruds.proformaList.fields.tva') }}</label>
                <input class="form-control {{ $errors->has('tva') ? 'is-invalid' : '' }}" type="number" name="tva" id="tva" value="{{ old('tva', '0') }}" step="0.01">
                @if($errors->has('tva'))
                    <span class="text-danger">{{ $errors->first('tva') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.tva_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_ttc">{{ trans('cruds.proformaList.fields.total_ttc') }}</label>
                <input class="form-control {{ $errors->has('total_ttc') ? 'is-invalid' : '' }}" type="number" name="total_ttc" id="total_ttc" value="{{ old('total_ttc', '') }}" step="0.01">
                @if($errors->has('total_ttc'))
                    <span class="text-danger">{{ $errors->first('total_ttc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.total_ttc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remise">{{ trans('cruds.proformaList.fields.remise') }}</label>
                <input class="form-control {{ $errors->has('remise') ? 'is-invalid' : '' }}" type="number" name="remise" id="remise" value="{{ old('remise', '') }}" step="0.01">
                @if($errors->has('remise'))
                    <span class="text-danger">{{ $errors->first('remise') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.remise_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remise_percent">{{ trans('cruds.proformaList.fields.remise_percent') }}</label>
                <input class="form-control {{ $errors->has('remise_percent') ? 'is-invalid' : '' }}" type="number" name="remise_percent" id="remise_percent" value="{{ old('remise_percent', '0') }}" step="0.01">
                @if($errors->has('remise_percent'))
                    <span class="text-danger">{{ $errors->first('remise_percent') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.remise_percent_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cond_reglement_id">{{ trans('cruds.proformaList.fields.cond_reglement') }}</label>
                <select class="form-control select2 {{ $errors->has('cond_reglement') ? 'is-invalid' : '' }}" name="cond_reglement_id" id="cond_reglement_id">
                    @foreach($cond_reglements as $id => $cond_reglement)
                        <option value="{{ $id }}" {{ old('cond_reglement_id') == $id ? 'selected' : '' }}>{{ $cond_reglement }}</option>
                    @endforeach
                </select>
                @if($errors->has('cond_reglement'))
                    <span class="text-danger">{{ $errors->first('cond_reglement') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.cond_reglement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mode_reglement_id">{{ trans('cruds.proformaList.fields.mode_reglement') }}</label>
                <select class="form-control select2 {{ $errors->has('mode_reglement') ? 'is-invalid' : '' }}" name="mode_reglement_id" id="mode_reglement_id">
                    @foreach($mode_reglements as $id => $mode_reglement)
                        <option value="{{ $id }}" {{ old('mode_reglement_id') == $id ? 'selected' : '' }}>{{ $mode_reglement }}</option>
                    @endforeach
                </select>
                @if($errors->has('mode_reglement'))
                    <span class="text-danger">{{ $errors->first('mode_reglement') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.mode_reglement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note_private">{{ trans('cruds.proformaList.fields.note_private') }}</label>
                <textarea class="form-control {{ $errors->has('note_private') ? 'is-invalid' : '' }}" name="note_private" id="note_private">{{ old('note_private') }}</textarea>
                @if($errors->has('note_private'))
                    <span class="text-danger">{{ $errors->first('note_private') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.note_private_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note_public">{{ trans('cruds.proformaList.fields.note_public') }}</label>
                <textarea class="form-control {{ $errors->has('note_public') ? 'is-invalid' : '' }}" name="note_public" id="note_public">{{ old('note_public') }}</textarea>
                @if($errors->has('note_public'))
                    <span class="text-danger">{{ $errors->first('note_public') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.note_public_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_livraison">{{ trans('cruds.proformaList.fields.date_livraison') }}</label>
                <input class="form-control date {{ $errors->has('date_livraison') ? 'is-invalid' : '' }}" type="text" name="date_livraison" id="date_livraison" value="{{ old('date_livraison') }}">
                @if($errors->has('date_livraison'))
                    <span class="text-danger">{{ $errors->first('date_livraison') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.date_livraison_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shipping_method_id">{{ trans('cruds.proformaList.fields.shipping_method') }}</label>
                <select class="form-control select2 {{ $errors->has('shipping_method') ? 'is-invalid' : '' }}" name="shipping_method_id" id="shipping_method_id">
                    @foreach($shipping_methods as $id => $shipping_method)
                        <option value="{{ $id }}" {{ old('shipping_method_id') == $id ? 'selected' : '' }}>{{ $shipping_method }}</option>
                    @endforeach
                </select>
                @if($errors->has('shipping_method'))
                    <span class="text-danger">{{ $errors->first('shipping_method') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.shipping_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="delivery_address_id">{{ trans('cruds.proformaList.fields.delivery_address') }}</label>
                <select class="form-control select2 {{ $errors->has('delivery_address') ? 'is-invalid' : '' }}" name="delivery_address_id" id="delivery_address_id">
                    @foreach($delivery_addresses as $id => $delivery_address)
                        <option value="{{ $id }}" {{ old('delivery_address_id') == $id ? 'selected' : '' }}>{{ $delivery_address }}</option>
                    @endforeach
                </select>
                @if($errors->has('delivery_address'))
                    <span class="text-danger">{{ $errors->first('delivery_address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.delivery_address_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('paid') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="paid" value="0">
                    <input class="form-check-input" type="checkbox" name="paid" id="paid" value="1" {{ old('paid', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="paid">{{ trans('cruds.proformaList.fields.paid') }}</label>
                </div>
                @if($errors->has('paid'))
                    <span class="text-danger">{{ $errors->first('paid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.proformaList.fields.paid_helper') }}</span>
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
        function add_fields() {
            document.getElementById("dataTable").insertRow(-1).innerHTML =
            `<tr>
                <td><input type="button" class="p-2 text-red-500 hover:bg-red-600 hover:text-white rounded" value="-" onclick="removeLine(this);"></td>
                <div class="input-group mb-3">
                <input type="text" placeholder="Searching ..." class="form-control input-search">
                </div>
                <div class="search"></div>
            </tr>`;
        }
        function removeLine(lineItem) {
            var row = lineItem.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
        const api = '/ac_vehicle';
        const input = document.querySelector('.input-search');
        const search = document.querySelector('.search');
        const container = document.querySelector('.container');
        const vehicles = [];

        fetch(api)
            .then(response => response.json())
            .then(blob => vehicles.push(...blob));

        function Searching(word) {
            return vehicles.filter(vehicle => {
                const regex = new RegExp(word,'gi')
                return vehicle.name.match(regex) || vehicle.vin.match(regex);
            });
        }

        function EnableArray() {
            const matches = Searching(this.value);
            const html = matches.map(match => {
                return ` <p class="p-2 d-flex flex-column border-bottom">
                            <span><small>${match.name}</small>
                            <span><small>${match.vin}</small></span>
                            <span><small>${match.plates}</small></span>
                            </p>
                            <hr>
                        `;
            }).join('');
            search.innerHTML = html;
        }

        input.addEventListener('click',EnableArray);
        input.addEventListener('keyup',EnableArray);

        container.addEventListener('click',function() {
            search.innerHTML = ''
        });
    </script>
    <script>
        $('body').on('change', '.vh_price', function() {
            var total=0;
            $(".vh_price").each(function(){
                quantity = parseInt($(this).val());
                if (!isNaN(quantity)) {
                    total += quantity;
                }
            });
            $('.price_ht').val(total);
        });
    </script>
@endsection
