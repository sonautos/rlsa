
<table class="table table-sm table-responsive" id="dataTable">
    <div class="p-3 text-right">
        <a class="text-white bg-green-600 hover:bg-green-200 hover:text-black p-2 rounded">Excel</a>
    </div>
    <thead class="thead-white text-center">
        <tr>
            <th></th>
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
        <form id="form" action="{{route('shippment.store')}}" method="POST">
            @csrf
            <tr>
                <td><input type="text" name="orderdet_id[]" id="" value="{{ $line->rowid }}" hidden></td>
                <td><input type="button" class="p-2 text-red-500 hover:bg-red-600 hover:text-white rounded" value="-" onclick="removeLine(this);"></td>
                <td><input type="text" class="form-control" name="model[]" value="{{ $line->product->extra->make }} {{ $line->product->extra->model }}" readonly></td>
                <td><input type="text" class="form-control" name="vin[]" value="{{ $line->product->ref }}" readonly></td>
                <td><input type="text" class="form-control" name="color[]" value="{{ $line->product->extra->color }}" readonly></td>
                <td><input type="text" class="form-control" name="plates[]" value="{{ $line->product->extra->plates }}" readonly></td>
                <td><input type="text" class="form-control" name="seller[]" value="{{ $line->order->company->label }}" readonly></td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <a class="p-2 text-green-500 hover:bg-green-600 hover:text-white rounded" type="button" href="{{ route('warehouse.create')}}" target="_blank">+</a>
                        </div>
                        <select class="custom-select" name="warehouse[]" id="warehouse">
                            @if (isset($line->product->warehouse))
                            <option value="{{ $line->product->warehouse->address }} {{ $line->product->warehouse->town }} {{ $line->product->warehouse->country->label }}">
                                {{ $line->product->warehouse->ref }}{{ $line->product->warehouse->address }} {{ $line->product->warehouse->town }} {{ $line->product->warehouse->country->label }}
                            </option>
                            @else
                            <option value="">{{ trans('trans.select')}}</option>
                            @endif
                            @foreach ($line->order->company->warehouses as $warehouse)
                                <option value="{{ $warehouse->address }} {{ $warehouse->town }} {{ $warehouse->country->label }}">
                                    {{ $warehouse->ref }} {{ $warehouse->address }} {{ $warehouse->town }} {{ $warehouse->country->label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td><input type="text" class="form-control" name="client[]" value="{{ $line->order->client->nom }}" readonly></td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <a class="p-2 text-green-500 hover:bg-green-600 hover:text-white rounded" type="button" href="{{ route('contacts.create', ['client' => $line->order->fk_soc] )}}" target="_blank">+</a>
                        </div>
                        <select class="custom-select" name="delivery_address[]" id="delivery-address">
                            <option value="">{{ trans('trans.select')}}</option>
                            @foreach ($line->order->client->socpeople as $contact)
                                <option value="{{ $contact->address }} {{ $contact->town }} {{ isset($contact->dept->nom) ? $contact->dept->nom : '' }} {{ isset($contact->country->label) ? $contact->country->label : '' }}">
                                    {{ $contact->lastname }} {{ $contact->address }} {{ $contact->town }} {{ isset($contact->dept->nom) ? $contact->dept->nom : '' }} {{ isset($contact->country->label) ? $contact->country->label : '' }}
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

@section('js')
<script>
    function add_fields() {
        document.getElementById("dataTable").insertRow(-1).innerHTML = '<td><input type="button" class="p-2 text-red-500 hover:bg-red-600 hover:text-white rounded" value="-" onclick="removeLine(this);"><tr><td><input type="text" class="form-control" class="form-control" name="model[]" placeholder="{{ trans("trans.enter")}} {{ trans("vehicle.model")}} "></td><td><input type="text" class="form-control" class="form-control" name="vin[]" placeholder="{{ trans("trans.enter")}} {{ trans("vehicle.vin")}} "></td><td><input type="text" class="form-control" class="form-control" name="color[]" placeholder="{{ trans("trans.enter")}} {{ trans("vehicle.color")}} "></td><td><input type="text" class="form-control" class="form-control" name="plates[]" placeholder="{{ trans("trans.enter")}} {{ trans("vehicle.color")}} "></td><td><select class="custom-select" class="form-control" name="seller[]" id="seller"><option value="">{{ trans("trans.select")}}</option>@foreach ($sellers as $seller)<option value="{{ $seller->label }}">{{ $seller->label }}</option>@endforeach</select></td><td><input class="form-control" name="warehouse[]" id="warehouse[]" placeholder="{{ trans("trans.enter")}} {{ trans("trans.loading-place")}}"></td><td><select class="custom-select" class="form-control" name="client[]" id="client"><option value="">{{ trans("trans.select")}}</option>@foreach ($societes as $societe)<option value="{{ $societe->nom }}">{{ $societe->nom }}</option>@endforeach</select></td><td><input class="form-control" name="delivery_address[]" id="delivery-address" placeholder="{{ trans("trans.enter")}} {{ trans("trans.delivery-address")}}"></td></tr>';
    }
    function removeLine(lineItem) {
        var row = lineItem.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

</script>
@stop
