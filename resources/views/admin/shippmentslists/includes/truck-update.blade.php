<!-- Modal -->
<div class="modal fade" id="truckModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="formTruck" action="{{route('admin.shipp.truck-update', ['shippment_id' => $shippmentslist->id])}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <ul class="list-group">
                            <li class="list-group-item">{{ trans('trans.supplier')}} :
                                <div class="form-group">
                                    <select class="form-control select2 {{ $errors->has('supplier') ? 'is-invalid' : '' }}" name="supplier_id" id="supplier_id">
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ (old('supplier_id') ? old('supplier_id') : $shippmentslist->shippmentTrucks->supplier->id ?? '') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('supplier'))
                                        <span class="text-danger">{{ $errors->first('supplier') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.truck.fields.supplier_helper') }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">{{ trans('trans.date_load')}} :
                                <div class="form-group">
                                    <input class="form-control date {{ $errors->has('date_load') ? 'is-invalid' : '' }}" type="text" name="date_load" id="date_load" value="{{ old('date_load', to_date($shippmentslist->shippmentTrucks->date_load)) }}">
                                    @if($errors->has('date_load'))
                                        <span class="text-danger">{{ $errors->first('date_load') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.truck.fields.date_load') }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">{{ trans('trans.date_cmr')}} :
                                <div class="form-group">
                                    <input class="form-control date {{ $errors->has('date_cmr') ? 'is-invalid' : '' }}" type="text" name="date_cmr" id="date_cmr" value="{{ old('date_cmr', $shippmentslist->shippmentTrucks->date_cmr) }}">
                                    @if($errors->has('date_cmr'))
                                        <span class="text-danger">{{ $errors->first('date_cmr') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.truck.fields.date_cmr_helper') }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul>
                            <li class="list-group-item">{{ trans('trans.plates')}} :
                                <div class="form-group">
                                    <input class="form-control {{ $errors->has('plates') ? 'is-invalid' : '' }}" type="text" name="plates" id="plates" value="{{ old('plates', $shippmentslist->shippmentTrucks->plates) }}">
                                    @if($errors->has('plates'))
                                        <span class="text-danger">{{ $errors->first('plates') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.truck.fields.plates_helper') }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">{{ trans('trans.chauffeur')}} :
                                <div class="form-group">
                                    <input class="form-control {{ $errors->has('chauffeur') ? 'is-invalid' : '' }}" type="text" name="chauffeur" id="chauffeur" value="{{ old('chauffeur', $shippmentslist->shippmentTrucks->chauffeur) }}">
                                    @if($errors->has('chauffeur'))
                                        <span class="text-danger">{{ $errors->first('chauffeur') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.truck.fields.chauffeur_helper') }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">{{ trans('trans.costprice') }} :
                                <div class="form-group">
                                    <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $shippmentslist->shippmentTrucks->price) }}" step="0.01">
                                    @if($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.truck.fields.price_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <div class="form-check {{ $errors->has('paid') ? 'is-invalid' : '' }}">
                                        <input type="hidden" name="paid" value="0">
                                        <input class="form-check-input" type="checkbox" name="paid" id="paid" value="1" {{ $shippmentslist->shippmentTrucks->paid || old('paid', 0) === 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="paid">{{ trans('cruds.truck.fields.paid') }}</label>
                                    </div>
                                    @if($errors->has('paid'))
                                        <span class="text-danger">{{ $errors->first('paid') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.truck.fields.paid_helper') }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
            {{-- @include('shippments.documents.cmr') --}}
        </div>
        <div class="modal-footer">
            <button type="button" onclick="$('#formTruck').submit()" class="bg-green-300 hover:bg-green-500 hover:text-gray-500 p-2 rounded" data-dismiss="modal">{{ trans('trans.save') }}</button>
            <button type="button" class="btn btn-secondary" class="bg-gray-300 hover:bg-gray-500 hover:text-gray-500 p-2 rounded" data-dismiss="modal">{{ trans('trans.close') }}</button>
        </div>
      </div>
    </div>
</div>
