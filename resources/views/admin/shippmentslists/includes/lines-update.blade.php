@foreach ($shippmentslist->shippmentShippLines as $line)
    <!-- Modal -->
    <div class="modal fade" id="editlineModal{{ $line->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @if (isset($line->order))
                <div class="text-center">
                    <h3>{{$line->order->ref}}</h3>
                </div>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="lineForm{{$line->id}}" method="POST" action="{{ route("admin.shipp-lines.update", [$line->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <ul class="list-group">
                        <input type="text" name="status_id" id="status_id" value="{{ $line->status_id }}" hidden>
                        <input type="text" name="shippment_id" id="shippment_id" value="{{ $line->shippment_id }}" hidden>
                        <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" hidden>
                        <li><input type="text" name="id" value="{{$line->id}}" hidden></li>
                        <li><input type="text" name="modele" class="list-group-item col-md-10 mx-auto text-center" value="{{ $line->modele }}" placeholder="{{ trans('trans.enter') }} {{ trans('trans.modele') }}"></li>
                        <li><input type="text" name="vin" class="list-group-item col-md-10 mx-auto text-center" value="{{ $line->vin }}" placeholder="{{ trans('trans.enter') }} {{ trans('trans.vin') }}"></li>
                        <li><input type="text" name="color" class="list-group-item col-md-10 mx-auto text-center" value="{{ $line->color }}" placeholder="{{ trans('trans.enter') }} {{ trans('trans.color') }}"></li>
                        <li><input type="text" name="plates" class="list-group-item col-md-10 mx-auto text-center" value="{{ $line->plates }}" placeholder="{{ trans('trans.enter') }} {{ trans('trans.plates') }}"></li>
                        <li>{{ trans('cruds.shippLine.fields.loading_place') }}</li>
                        <li>
                            {{ $line->seller->name }}
                            <input type="text" name="seller_id" id="" value="{{ $line->seller_id }}" hidden>
                        </li>
                        <li>
                            @if (isset($line->order))
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a class="p-2 text-green-500 hover:bg-green-600 hover:text-white rounded" type="button" href="{{ route('admin.addresses.create')}}" target="_blank">+</a>
                                    </div>
                                    <select class="custom-select" name="loading_place" id="loading_place">
                                    @foreach ($addresses->where('societe_id', $line->seller->id) as $loading_place)
                                        <option value="{{ $loading_place->address }} {{ $loading_place->city }} {{ $loading_place->country }}"
                                            {{ (isset($line->loading_place) && $line->loading_place == ($loading_place->address.' '.$loading_place->city.' '.$loading_place->country) ) ? 'selected' : '' }}>
                                            {{ $loading_place->name }}{{ $loading_place->address }} {{ $loading_place->city }} {{ $loading_place->country }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            @else
                                <input type="text" name="loading_place" id="loading_place" class="form-control" value="{{ $line->loading_place }}">
                            @endif
                        </li>
                        <li>{{ trans('cruds.shippLine.fields.delivery_place') }}</li>
                        <li>
                            {{ $line->client->name }}
                            <input type="text" name="seller_id" id="" value="{{ $line->client_id }}" hidden>
                        </li>
                        <li>
                            @if (isset($line->order))
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a class="p-2 text-green-500 hover:bg-green-600 hover:text-white rounded" type="button" href="{{ route('admin.addresses.create')}}" target="_blank">+</a>
                                    </div>
                                    <select class="custom-select" name="delivery_place" id="delivery_place">
                                    @foreach ($addresses->where('societe_id', $line->client->id) as $delivery_place)
                                        <option value="{{ $delivery_place->address }} {{ $delivery_place->town }} {{ $delivery_place->country }}"
                                            {{ (isset($line->delivery_place) && $line->delivery_place == ($delivery_place->address.' '.$delivery_place->city.' '.$delivery_place->country) ) ? 'selected' : '' }}>
                                            {{ $delivery_place->name }}{{ $delivery_place->address }} {{ $delivery_place->city }} {{ $delivery_place->country }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            @else
                                <input type="text" name="delivery_place" id="delivery_place" class="form-control" value="{{ $line->delivery_place }}">
                            @endif
                        </li>
                        <li>
                            <div class="input-group col-md-6 mx-auto">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">€</span>
                                </div>
                                    <input type="number" class="form-control" name="price" value="{{ isset($line->price) ? $line->price :  old('price') }}">
                                <div class="input-group-append">
                                  <span class="input-group-text">H.T</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" class="bg-gray-300 hover:bg-gray-500 hover:text-gray-500 p-2 rounded" data-dismiss="modal">{{ trans('trans.close') }}</button>
                <button type="button" onclick="$('#lineForm{{$line->id}}').submit()" class="bg-teal-300 hover:bg-teal-500 hover:text-gray-500 p-2 rounded" data-dismiss="modal">{{ trans('trans.save') }}</button>
            </div>
        </div>
        </div>
    </div>
@endforeach
