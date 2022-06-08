<div class="m-3">
    @can('shipp_line_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.shipp-lines.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.shippLine.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.shippLine.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-shippmentShippLines">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.seller') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.client') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.modele') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.vehicle') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.vin') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.color') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.plates') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.loading_place') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.delivery_place') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.cmr_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.price') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.paid') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.shippment') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.shippLine.fields.order') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shippLines as $key => $shippLine)
                            <tr data-entry-id="{{ $shippLine->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $shippLine->id ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->seller->name ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->client->name ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->modele ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->vehicle->vin ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->vin ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->color ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->plates ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->loading_place ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->delivery_place ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->cmr_date ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->status->name ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->price ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $shippLine->paid ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $shippLine->paid ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $shippLine->shippment->ref ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->user->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $shippLine->order->ref ?? '' }}
                                </td>
                                <td>
                                    @can('shipp_line_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.shipp-lines.show', $shippLine->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('shipp_line_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.shipp-lines.edit', $shippLine->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('shipp_line_delete')
                                        <form action="{{ route('admin.shipp-lines.destroy', $shippLine->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('shipp_line_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.shipp-lines.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 11, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-shippmentShippLines:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection