<!-- Modal -->
<div class="modal fade" id="editPrices" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body text-center">
                <form id="totalPrices" action="{{route('admin.shipp.prices-update', ['id' => $shippmentslist->id])}}" method="POST">
                    @csrf
                    <input class="" name="car_number" value="{{ count($shippmentslist->shippmentShippLines) }}" hidden>
                    <div class="col-md-8 mx-auto">
                        <div class="input-group text-center">
                            {{ trans('trans.numberOf')}} {{ trans('trans.vehicles')}} : {{ count($shippmentslist->shippmentShippLines) }}
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">€</span>
                            </div>
                                <input type="number" class="form-control" name="total_prices" value="{{ $shippmentslist->shippmentShippLines->sum('price') }}">
                            <div class="input-group-append">
                                <span class="input-group-text">H.T</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" class="bg-gray-300 hover:bg-gray-500 hover:text-gray-500 p-2 rounded" data-dismiss="modal">{{ trans('trans.close') }}</button>
                <button type="button" onclick="$('#totalPrices').submit()" class="bg-teal-300 hover:bg-teal-500 hover:text-gray-500 p-2 rounded" data-dismiss="modal">{{ trans('trans.save') }}</button>
            </div>
        </div>
    </div>
</div>
