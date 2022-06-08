<!-- Modal -->
<div class="modal fade" id="shippModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h4>{{ trans('trans.user')}} {{trans('trans.in_charge')}} {{ $shippmentslist->user->firstname }} {{ $shippmentslist->user->name }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route("admin.shippmentslists.update", [$shippmentslist->id]) }}" enctype="multipart/form-data" id="formShippment">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="status_id">{{ trans('cruds.shippmentslist.fields.status') }}</label>
                    <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                        @foreach($statuses as $id => $status)
                            <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $shippmentslist->status->id ?? '') == $id ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.shippmentslist.fields.status_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="note_private">{{ trans('cruds.shippmentslist.fields.note_private') }}</label>
                    <textarea class="form-control {{ $errors->has('note_private') ? 'is-invalid' : '' }}" name="note_private" id="note_private">{{ old('note_private', $shippmentslist->note_private) }}</textarea>
                    @if($errors->has('note_private'))
                        <span class="text-danger">{{ $errors->first('note_private') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.shippmentslist.fields.note_private_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="note_public">{{ trans('cruds.shippmentslist.fields.note_public') }}</label>
                    <textarea class="form-control {{ $errors->has('note_public') ? 'is-invalid' : '' }}" name="note_public" id="note_public">{{ old('note_public', $shippmentslist->note_public) }}</textarea>
                    @if($errors->has('note_public'))
                        <span class="text-danger">{{ $errors->first('note_public') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.shippmentslist.fields.note_public_helper') }}</span>
                </div>
            </form>
          {{-- {{ $shippmentslist->entity }} --}}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" class="bg-gray-300 hover:bg-gray-500 hover:text-gray-500 p-2 rounded" data-dismiss="modal">{{ trans('trans.close') }}</button>
            <button type="button" onclick="$('#formShippment').submit()" class="bg-teal-300 hover:bg-teal-500 hover:text-gray-500 p-2 rounded" data-dismiss="modal">{{ trans('trans.save') }}</button>
        </div>
      </div>
    </div>
</div>
