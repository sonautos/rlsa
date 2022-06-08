<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-nameledby="exampleModalname" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 90%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-name="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <div class="">
                <table class="table table-sm table-responsive-md" style="font-size: 12px">
                    <thead>
                        <tr>
                            <th class="text-center">{{trans('trans.description')}}</th>
                            <th class="text-center">{{trans('vehicle.vin')}}</th>
                            <th class="text-center">{{trans('vehicle.plates')}}</th>
                            <th class="text-center">{{trans('vehicle.color')}}</th>
                            <th class="text-center">{{trans('trans.total_ht')}}</th>
                            <th class="text-center" >{{trans('trans.seller')}}</th>
                            <th class="text-center">{{trans('trans.Client')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ordersList->orderOrderLines as $line)
                        <form id="form" action="{{ route('admin.order.update-line', $ordersList) }}" method="POST">
                            @csrf
                            <input type="text" name="id[]" value="{{ $line->rowid }}" hidden>
                            <tr>
                                <td>
                                    <b><input class="form-control input-sm" type="text" name="description[]" value="{{ isset($line->name) ? $line->name : '' }}">
                                </td>
                                <td class="text-center"><input  class="form-control input-sm" type="text" name="vin[]" value="{{ isset($line->vehicle->vin) ? $line->vehicle->vin : '' }}"></td>
                                <td class="text-center"><input class="form-control input-sm" type="text" name="plates[]" value="{{ isset($line->vehicle->plates) ? $line->vehicle->plates : '' }}"></td>
                                <td class="text-center"><input class="form-control input-sm" type="text" name="color[]" value="{{ isset($line->vehicle->color) ? $line->vehicle->color : '' }}"></td>
                                <td class="text-center">
                                    <div class="input-group mb-3">
                                        <input class="form-control input-sm" type="text" name="total_ht[]" value="{{ (float)$line->total_ht }}">
                                        <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group mb-3">
                                        <input class="form-control input-sm" type="text" name="comseller[]" value="{{ isset($line->vehicle->comseller) ? to_number($line->comseller) : '0' }}">
                                        <div class="input-group-append">
                                        <span class="input-group-text">€</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group mb-3">
                                        <input class="form-control input-sm" type="text" name="comclient[]" value="{{ isset($line->comclient) ? to_number($line->comclient) : 0 }}">
                                        <div class="input-group-append">
                                        <span class="input-group-text">€</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </form>
                    </tbody>
                </table>
              </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" class="bg-gray-300 hover:bg-gray-500 hover:text-gray-500 p-2 rounded" data-dismiss="modal">{{ trans('trans.close') }}</button>
            <button type="button" onclick="$('#form').submit()" class="bg-teal-300 hover:bg-teal-500 hover:text-gray-500 p-2 rounded" data-dismiss="modal">{{ trans('trans.save') }}</button>
        </div>
      </div>
    </div>
</div>
