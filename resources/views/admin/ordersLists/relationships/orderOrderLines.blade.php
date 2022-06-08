<div class="m-3">
    @can('order_line_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.order-lines.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.orderLine.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.orderLine.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-orderOrderLines">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.orderLine.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderLine.fields.order') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderLine.fields.product') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderLine.fields.service') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderLine.fields.vehicle') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderLine.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderLine.fields.total_ht') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderLine.fields.total_tva') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderLine.fields.total_ttc') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderLine.fields.cost_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderLine.fields.comclient') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderLine.fields.status') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderLines as $key => $orderLine)
                            <tr data-entry-id="{{ $orderLine->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $orderLine->id ?? '' }}
                                </td>
                                <td>
                                    {{ $orderLine->order->ref ?? '' }}
                                </td>
                                <td>
                                    {{ $orderLine->product->name ?? '' }}
                                </td>
                                <td>
                                    {{ $orderLine->service->name ?? '' }}
                                </td>
                                <td>
                                    {{ $orderLine->vehicle->vin ?? '' }}
                                </td>
                                <td>
                                    {{ $orderLine->name ?? '' }}
                                </td>
                                <td>
                                    {{ $orderLine->total_ht ?? '' }}
                                </td>
                                <td>
                                    {{ $orderLine->total_tva ?? '' }}
                                </td>
                                <td>
                                    {{ $orderLine->total_ttc ?? '' }}
                                </td>
                                <td>
                                    {{ $orderLine->cost_price ?? '' }}
                                </td>
                                <td>
                                    {{ $orderLine->comclient ?? '' }}
                                </td>
                                <td>
                                    {{ $orderLine->status->name ?? '' }}
                                </td>
                                <td>
                                    @can('order_line_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.order-lines.show', $orderLine->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('order_line_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.order-lines.edit', $orderLine->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('order_line_delete')
                                        <form action="{{ route('admin.order-lines.destroy', $orderLine->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('order_line_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.order-lines.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-orderOrderLines:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection