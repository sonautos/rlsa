@extends('layouts.admin')
@section('content')

<div class="card">

    @if (count($errors) > 0)
    <div class = "bg-danger text-black shadow text-center rounded-bottom">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <div class="container-fluid">
        <div class="fade-in">
            <div class="card">
                <form method="POST" action="{{ route("admin.shippmentslists.store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="card bg-gray-100 text-gray-600 text-justify col-md-4 mx-auto shadow-xl p-4 text-center">
                                        <div class="form-group">
                                            <label class="required" for="entity_id">{{ trans('cruds.shippmentslist.fields.entity') }}</label>
                                            <select class="form-control select2 {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity_id" id="entity_id" required>
                                                @foreach($entities as $id => $entity)
                                                    <option value="{{ $id }}" {{ old('entity_id') == $id ? 'selected' : '' }}>{{ $entity }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('entity'))
                                                <span class="text-danger">{{ $errors->first('entity') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.shippmentslist.fields.entity_helper') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="user_id">{{ trans('cruds.shippmentslist.fields.user') }}</label>
                                            <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                                                @foreach($users as $id => $user)
                                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('user'))
                                                <span class="text-danger">{{ $errors->first('user') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.shippmentslist.fields.user_helper') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="date_delivery">{{ trans('cruds.shippmentslist.fields.date_delivery') }}</label>
                                            <input class="form-control date {{ $errors->has('date_delivery') ? 'is-invalid' : '' }}" type="text" name="date_delivery" id="date_delivery" value="{{ old('date_delivery') }}" required>
                                            @if($errors->has('date_delivery'))
                                                <span class="text-danger">{{ $errors->first('date_delivery') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.shippmentslist.fields.date_delivery_helper') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow p-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="note_private">{{ trans('cruds.shippmentslist.fields.note_private') }}</label>
                                                <textarea class="form-control {{ $errors->has('note_private') ? 'is-invalid' : '' }}" name="note_private" id="note_private">{{ old('note_private') }}</textarea>
                                                @if($errors->has('note_private'))
                                                    <span class="text-danger">{{ $errors->first('note_private') }}</span>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.shippmentslist.fields.note_private_helper') }}</span>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="note_public">{{ trans('cruds.shippmentslist.fields.note_public') }}</label>
                                                <textarea class="form-control {{ $errors->has('note_public') ? 'is-invalid' : '' }}" name="note_public" id="note_public">{{ old('note_public') }}</textarea>
                                                @if($errors->has('note_public'))
                                                    <span class="text-danger">{{ $errors->first('note_public') }}</span>
                                                @endif
                                                <span class="help-block">{{ trans('cruds.shippmentslist.fields.note_public_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="card shadow">
                            <table class="table table-sm table-responsive" id="dataTable">
                                <div class="p-3 text-right">
                                    <a class="text-white bg-green-600 hover:bg-green-200 hover:text-black p-2 rounded">Excel</a>
                                </div>
                                <thead class="thead-white text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('trans.description')}}</th>
                                        <th>{{ trans('vehicle.vin')}}</th>
                                        <th>{{ trans('vehicle.color')}}</th>
                                        <th>{{ trans('vehicle.plates')}}</th>
                                        <th>{{ trans('trans.seller')}}</th>
                                        <th>{{ trans('exp.loadingplace')}}</th>
                                        <th>{{ trans('trans.Client')}}</th>
                                        <th>{{ trans('exp.destination')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($lines as $line)
                                    <input type="text" name="orderLine[]" id="" value="{{ $line->id }}" hidden>
                                        <tr>
                                            <td><input type="button" class="p-2 text-red-500 hover:bg-red-600 hover:text-white rounded" value="-" onclick="removeLine(this);"></td>
                                            <td><input type="text" class="form-control" name="model[]" value="{{ $line->name }}" hidden>{{ $line->name }}</td>
                                            <td><input type="text" class="form-control" name="vin[]" value="{{ $line->vehicle->vin }}" hidden>{{ $line->vehicle->vin }}</td>
                                            <td><input type="text" class="form-control" name="color[]" value="{{ $line->vehicle->color }}" hidden>{{ $line->vehicle->color }}</td>
                                            <td><input type="text" class="form-control" name="plates[]" value="{{ $line->vehicle->plates }}" hidden>{{ $line->vehicle->plates }}</td>
                                            <td><input type="text" class="form-control" name="seller[]" value="{{ $line->order->seller->id }}" hidden>{{ $line->order->seller->name }}</td>
                                            <td>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <a class="p-2 text-green-500 hover:bg-green-600 hover:text-white rounded" type="button" href="{{ route('admin.addresses.create', ['company_id' => $line->order->seller->id] )}}" target="_blank">+</a>
                                                    </div>
                                                    <select class="custom-select" name="warehouse[]" id="warehouse">
                                                        <option value="">{{ trans('trans.select')}}</option>
                                                        @foreach ($addresses->where('societe_id', $line->order->seller->id ) as $warehouse)
                                                            <option value="{{ $warehouse->name }} {{ $warehouse->address }} {{ $warehouse->city }} {{ $warehouse->country}}">
                                                                {{ $warehouse->name }} {{ $warehouse->address }} {{ $warehouse->city }} {{ $warehouse->country}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td><input type="text" class="form-control" name="client[]" value="{{ $line->order->client->id }}" hidden>{{ $line->order->client->name }}</td>
                                            <td>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <a class="p-2 text-green-500 hover:bg-green-600 hover:text-white rounded" type="button" href="{{ route('admin.addresses.create', ['company_id' => $line->order->client->id] )}}" target="_blank">+</a>
                                                    </div>
                                                    <select class="custom-select" name="delivery_address[]" id="delivery-address">
                                                        <option value="">{{ trans('trans.select')}}</option>
                                                        @foreach ($addresses->where('societe_id', $line->order->client->id ) as $contact)
                                                            <option value="{{ $contact->name }} {{ $contact->address }} {{ $contact->city }} {{ $contact->country }}">
                                                                {{ $contact->name }} {{ $contact->address }} {{ $contact->city }} {{ $contact->country }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="set-form text-right pb-2">
                                <input type="button" id="more_fields" onclick="add_fields();" value=" + " class="p-2 mr-3 text-green-500 bg-hover:bg-green-600 hover:text-white rounded"/>
                            </div>
                        </div>
                        <div class="btn btn-group text-center">
                            <button class="btn btn-outline-success" type="submit" onclick="$('#form').submit()">{{trans('trans.valid')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function add_fields() {
        document.getElementById("dataTable").insertRow(-1).innerHTML = '<tr><td><input type="button" class="p-2 text-red-500 hover:bg-red-600 hover:text-white rounded" value="-" onclick="removeLine(this);">'+
        '<td><input type="text" class="form-control" class="form-control" name="model[]" placeholder="{{ trans("trans.enter")}} {{ trans("vehicle.model")}} "></td>'+
        '<td><input type="text" class="form-control" class="form-control" name="vin[]" placeholder="{{ trans("trans.enter")}} {{ trans("vehicle.vin")}} "></td>'+
        '<td><input type="text" class="form-control" class="form-control" name="color[]" placeholder="{{ trans("trans.enter")}} {{ trans("vehicle.color")}} "></td>'+
        '<td><input type="text" class="form-control" class="form-control" name="plates[]" placeholder="{{ trans("trans.enter")}} {{ trans("vehicle.color")}} "></td>'+
        '<td>'+
            '<div class="form-group">'+
                '<select class="form-control" name="seller[]" id="seller">'+
                    '<option value="">{{ trans("trans.select")}}</option>'+
                    '@foreach ($sellers->sortBy("name") as $id => $seller)'+
                    '<option value="{{ $id }}">{{ $seller }}'+
                    '</option>'+
                    '@endforeach'+
                '</select>'+
            '</div>'+
        '</td>'+
        '<td>'+
            '<input class="form-control" name="warehouse[]" id="warehouse[]" placeholder="{{ trans("trans.enter")}} {{ trans("trans.loading-place")}}"></td>'+
        '<td>'+
            '<select class="custom-select" class="form-control" name="client[]" id="client"><option value="">{{ trans("trans.select")}}</option>@foreach ($clients->sortBy("name") as $id => $client)<option value="{{ $id }}">{{ $client }}</option>@endforeach</select>'+
        '</td>'+
        '<td><input class="form-control" name="delivery_address[]" id="delivery-address" placeholder="{{ trans("trans.enter")}} {{ trans("trans.delivery-address")}}"></td>'+
    '</tr>';
    }
    function removeLine(lineItem) {
        var row = lineItem.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>
@endsection
