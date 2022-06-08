<!-- Modal -->
<div class="modal fade" id="entityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body bg-success text-light">
            <form id="form" action="{{route('admin.shipp.entity-update', ['id' => $shippmentslist->id])}}" method="POST">
              @csrf
              <div class="">
                  <label for="entity">{{ trans('trans.Societe')}} {{ trans('trans.who_invoice')}} : </label>
                  <select wire:model="entity" name="entity" id="entity" class="custom-select border shadow p-2 bg-white" selected>
                    @foreach($entities as $entity)
                        <option value="{{ $entity->id }}"
                            {{ $shippmentslist->entity->id == $entity->id ? 'selected' : '' }}
                            >{{ $entity->name }}
                        </option>
                    @endforeach
                </select>
              </div>
            </form>
          {{-- {{ $shippmentslist->entity }} --}}
        </div>
        <div class="modal-footer bg-success">
            <button type="button" class="btn btn-secondary" class="bg-gray-300 hover:bg-gray-500 hover:text-gray-500 p-2 rounded" data-dismiss="modal">{{ trans('trans.close') }}</button>
            <button type="button" onclick="$('#form').submit()" class="bg-teal-300 hover:bg-teal-500 hover:text-gray-500 p-2 rounded" data-dismiss="modal">{{ trans('trans.save') }}</button>
        </div>
      </div>
    </div>
</div>
