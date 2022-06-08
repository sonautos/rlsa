@foreach ($shippmentslist->shippmentShippLines as $line)
    <!-- Modal -->
    <div class="modal fade" id="deletelineModal{{ $line->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body bg-gray-700 rounded">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form id="deleteForm{{$line->id}}" action="{{ route('admin.shipp.line-destroy', ['id' => $line->id]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <div class="text-white bg-gray-700 mb-3 rounded">
                            <h5 class="card-title text-center mb-3">Vous êtes sur le point de supprimer le véhicule <strong>{{ $line->vin }}</strong></h5>
                            <p class="card-text">
                                <a class="btn btn-danger btn-lg btn-block" href="#" role="button" onclick="$('#deleteForm{{$line->id}}').submit()">{{trans('trans.confirm')}}</a>
                            </p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endforeach
